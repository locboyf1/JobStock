<?php

namespace App\Jobs;

use App\Models\JobPost;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CensorContentJobPost implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $jobPostId;

    public function __construct($id)
    {
        $this->jobPostId = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $jobPost = JobPost::find($this->jobPostId);
        if ($jobPost == null) {
            Log::error('Job ID '.$this->jobPostId.', Lỗi: Không tìm thấy job post');

            return;
        }

        $content = '';

        foreach ($jobPost->content as $item) {
            $row_content = is_array($item['row_content']) ? implode(', ', $item['row_content']) : $item['row_content'];
            $content .= $item['title'].': '.$item['description'].', '.$row_content.'; ';
        }

        $tags = '';

        foreach ($jobPost->tags as $tag) {
            $tags .= $tag->name.', ';
        }
        $rule = 'Bạn là một hệ thống kiểm duyệt tin tuyển dụng tự động (API).'
        .'Nhiệm vụ: Phân tích tin đăng xem có vi phạm quy tắc (lừa đảo, cờ bạc, đồi trụy, phân biệt đối xử) không.'
        .'Yêu cầu output: Chỉ trả về duy nhất một chuỗi JSON hợp lệ, không có markdown, không giải thích thêm.'
        .'Cấu trúc JSON bắt buộc:'
        .'{
            "safe": boolean, // true nếu tin hợp lệ, false nếu vi phạm
            "reason": stringOrNull // null nếu safe=true. Nếu safe=false, ghi lý do ngắn gọn bằng tiếng Việt (dưới 1000 ký tự) để gửi lý do từ chối qua mail cho user.
        }.'
        .'Và sau đây là nội dung cần kiểm duyệt:';
        $texts = 'mã đăng tuyển: '.$jobPost->id.', '.'tiêu đề: '.$jobPost->title.', lương tối thiểu: '.$jobPost->salary_min.' triệu VNĐ, lương tối đa: '.$jobPost->salary_max.' triệu VNĐ, mô tả: '.$jobPost->description.', kinh nghiệm yêu cầu: '.($jobPost->experience ? $jobPost->experience.' năm' : 'Không yêu cầu kinh nghiệm').', nội dung: '.$content.', tags: '.$tags.', mã công ty: '.$jobPost->company_id.', tên công ty: '.$jobPost->company->title.', công việc: '.$jobPost->jobCompany->title.', nhóm công việc: '.$jobPost->jobCompany->job_group->title.', loại hình làm việc: '.$jobPost->jobType->title.', ';

        try {
            $respone = Http::withHeaders(
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.config('services.apikey.groq'),
                ])->timeout(60)->withOptions(['verify' => false])->post('https://api.groq.com/openai/v1/chat/completions',
                    [
                        'model' => 'llama-3.3-70b-versatile',
                        'response_format' => ['type' => 'json_object'],
                        'messages' => [
                            [
                                'role' => 'user',
                                'content' => $rule.$texts,
                            ],
                        ],
                    ]);

            $contentResponse = json_decode(trim($respone['choices'][0]['message']['content']));
            $safeBoolean = filter_var($contentResponse->safe, FILTER_VALIDATE_BOOLEAN);
            $reason = $contentResponse->reason;

            if ($safeBoolean) {
                $jobPost->update([
                    'is_confirmed' => true,
                    'reason' => null,
                ]);
            } else {
                $jobPost->update([
                    'is_confirmed' => null,
                    'reason' => $reason,
                ]);
            }
        } catch (Exception $e) {
            Log::error('Job ID '.$jobPost->id.', Lỗi: '.$e->getMessage() + $contentResponse);

            return;
        }

    }
}

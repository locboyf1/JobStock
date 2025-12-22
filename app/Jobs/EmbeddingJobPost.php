<?php

namespace App\Jobs;

use App\Models\JobPost;
use App\Utilities\functions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class EmbeddingJobPost implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $id_job_post;

    public function __construct($id)
    {
        $this->id_job_post = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $jobPost = JobPost::find($this->id_job_post);

        if (! $jobPost) {
            Log::error('Job ID '.$this->id_job_post.', Lỗi: Không tìm thấy job post');

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

        $texts = 'mã đăng tuyển: '.$jobPost->id.', '.'tiêu đề: '.$jobPost->title.', lương tối thiểu: '.$jobPost->salary_min.' triệu VNĐ, lương tối đa: '.$jobPost->salary_max.' triệu VNĐ, mô tả: '.$jobPost->description.', kinh nghiệm yêu cầu: '.($jobPost->experience ? $jobPost->experience.' năm' : 'Không yêu cầu kinh nghiệm').', nội dung: '.$content.', tags: '.$tags.', mã công ty: '.$jobPost->company_id.', tên công ty: '.$jobPost->company->title.', công việc: '.$jobPost->jobCompany->title.', nhóm công việc: '.$jobPost->jobCompany->job_group->title.', loại hình làm việc: '.$jobPost->jobType->title.', ';

        try {
            $vector = functions::embedByCohere($texts);
        } catch (\Exception $e) {
            Log::error('Job ID '.$jobPost->id.', Lỗi: '.$e->getMessage());

            return;
        }

        if ($vector) {
            $jobPost->vector = $vector;
            $jobPost->save();
            Log::info('Đã embed thành công Job ID: '.$jobPost->id);
        } else {
            Log::error('Job ID '.$jobPost->id.', Lỗi: API trả về thành công nhưng không có embeddings');
        }
    }
}

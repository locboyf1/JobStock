<?php

namespace App\Services;

use App\Utilities\functions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ChatbotService
{
    protected $rules;

    public function __construct()
    {
        $rulesPath = config('chatbot.RULES_PATH');

        if (Storage::exists($rulesPath)) {
            $this->rules = Storage::get($rulesPath);
        } else {
            $this->rules = '';
        }
    }

    public function sendMessage(string $message, array $history)
    {
        $jobPostService = app(JobPostService::class);

        $embedMessage = functions::embedByCohere($message);
        $jobSearch = $jobPostService->getJobPostsSimilar($embedMessage, 15);

        $jobContent = '';

        if ($jobSearch->isNotEmpty()) {
            $jobContent = 'Dưới đây là các tin tuyển dụng lọc ra được từ hệ thống';
            foreach ($jobSearch as $job) {
                $jobContent .= 'id: '.$job->id.', tiêu đề: '.$job->title.', công ty: '.$job->company->title.', tags: '.$job->tags->pluck('name')->implode(', ');
                $jobContent .= ', địa chỉ công ty: '.$job->company->address.', mô tả về công ty: '.$job->company->description.', số lượng tuyển dụng: '.$job->quantity.', lương tối thiểu: '.$job->salary_min.' triệu VNĐ,  Lương tối đa: '.($job->salary_max ? $job->salary_max.' triệu VNĐ' : 'không có');
                $jobContent .= ', thời gian đăng: '.$job->created_at->format('d/m/Y H:i:s').', thời gian hết hạn: '.$job->expired_time->format('d/m/Y H:i:s');
                $jobContent .= ', loại hình làm việc:'.$job->jobType->name;
                $jobContent .= ', công việc: '.$job->jobCompany->title.', thuộc nhóm công việc: '.$job->jobCompany->job_group->title;
            }
        } else {
            $jobContent = 'Không tìm thấy tin tuyển dụng phù hợp trong hệ thống';
        }

        try {
            $messages = array_merge([['role' => 'system', 'content' => $this->rules."\n".$jobContent]], $history);
            $response = Http::withToken(env('GEMINI_API_KEY'))
                ->timeout(30)
                ->withOptions(['verify' => false])
                ->post('https://generativelanguage.googleapis.com/v1beta/openai/chat/completions', [
                    'model' => 'gemini-2.5-flash',
                    'reasoning_effort' => 'low',
                    'messages' => $messages,
                ]);

            if ($response->successful()) {
                return $response->json()['choices'][0]['message']['content'];
            }

            Log::error('Lỗi khi gửi tin nhắn ChatBot: '.$response->body());

            return 'Xin lỗi, chúng tôi đang gặp sự cố.';
        } catch (\Exception $e) {
            Log::error('Lỗi khi gửi tin nhắn ChatBot: '.$e->getMessage());

            return 'Có lỗi về kết nối với ChatBot.';
        }
    }
}

<?php

namespace App\Services;

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

    public function sendMessage(array $history)
    {
        try {
            $messages = array_merge([['role' => 'system', 'content' => $this->rules]], $history);

            $response = Http::withToken(env('GEMINI_API_KEY'))
                ->timeout(30)
                ->withOptions(['verify' => false])
                ->post('https://generativelanguage.googleapis.com/v1beta/openai/chat/completions', [
                    'model' => 'gemini-2.5-pro',
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

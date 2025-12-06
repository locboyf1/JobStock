<?php

namespace App\Livewire;

use App\Services\ChatbotService;
use Livewire\Component;

class Chatbot extends Component
{
    public $isOpen = false;

    public $message = [];

    public $history = [];

    public function sendMessage(ChatbotService $chatbotService)
    {
        $this->validate(
            [
                'message' => 'required|string|max:500',
            ],
            [
                'message.required' => 'Vui lòng nhập tin nhắn',
                'message.max' => 'Tin nhắn không được vượt quá 500 ký tự',
            ]
        );

        $this->history[] = [
            'role' => 'user',
            'content' => $this->message,
        ];

        $currentHistory = $this->history;

        $response = $chatbotService->sendMessage($currentHistory);

        $this->history[] = [
            'role' => 'assistant',
            'content' => $response,
        ];

        $this->message = '';
    }

    public function chatWindow()
    {
        $this->isOpen = ! $this->isOpen;
    }

    public function render()
    {

        return view('livewire.chatbot');
    }
}

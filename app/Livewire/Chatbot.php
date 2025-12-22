<?php

namespace App\Livewire;

use App\Services\ChatbotService;
use Livewire\Component;

class Chatbot extends Component
{
    public $isOpen = false;

    public $message = [];

    public $history = [];

    public function __construct()
    {
        $this->history = session()->get('history', []);
    }

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
        $history = $this->history;

        $history[] = [
            'role' => 'user',
            'content' => $this->message,
        ];

        $mess = $this->message;
        $this->message = '';

        $response = $chatbotService->sendMessage($mess[0], $history);

        $history[] = [
            'role' => 'assistant',
            'content' => $response,
        ];
        session()->put('history', $history);
        $this->history = $history;
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

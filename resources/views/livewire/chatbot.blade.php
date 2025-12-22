<div>
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}?v=1.2">
    <div class="chatbot-wrapper">
        @if ($isOpen)
            <div class="chatbot-window">
                <!-- Header -->
                <div class="chatbot-header">
                    <div class="chatbot-header-info">
                        <div class="chatbot-header-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" style="color: white !important;">
                                <path d="M12 8V4H8" />
                                <rect width="16" height="12" x="4" y="8" rx="2" />
                                <path d="M2 14h2" />
                                <path d="M20 14h2" />
                                <path d="M15 13v2" />
                                <path d="M9 13v2" />
                            </svg>
                        </div>
                        <div class="chatbot-header-title">
                            <h3>Trợ lý Ảo | JobStock</h3>
                            <p>Luôn sẵn sàng hỗ trợ</p>
                        </div>
                    </div>
                    <button wire:click="chatWindow" class="chatbot-close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="chatbot-body">
                    @if (empty($history))
                        <div class="chatbot-empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"
                                style="margin-bottom: 12px !important; opacity: 0.5 !important;">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                            </svg>
                            <p style="margin: 0 !important; font-size: 14px !important;">Xin chào! Tôi có thể giúp gì
                                cho bạn?</p>
                        </div>
                    @endif

                    @foreach ($history as $msg)
                        <div class="chatbot-message {{ $msg['role'] === 'user' ? 'user' : 'assistant' }}">
                            @if ($msg['role'] !== 'user')
                                <div class="chatbot-message-avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" style="color: white !important;">
                                        <path d="M12 8V4H8" />
                                        <rect width="16" height="12" x="4" y="8" rx="2" />
                                        <path d="M2 14h2" />
                                        <path d="M20 14h2" />
                                        <path d="M15 13v2" />
                                        <path d="M9 13v2" />
                                    </svg>
                                </div>
                            @endif
                            <div class="chatbot-message-content">
                                {!! $msg['content'] !!}
                            </div>
                        </div>
                    @endforeach
                    <div wire:loading.flex wire:target="sendMessage" class="chatbot-typing">
                        <div class="chatbot-typing-bubble">
                            <div class="chatbot-dots">
                                <span class="chatbot-dot"></span>
                                <span class="chatbot-dot"></span>
                                <span class="chatbot-dot"></span>
                            </div>
                            <span class="chatbot-typing-text">Đang trả lời...</span>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="chatbot-footer">
                    <form wire:submit.prevent="sendMessage" class="chatbot-form">
                        <input type="text" wire:model="message" class="chatbot-input" placeholder="Nhập tin nhắn..."
                            wire:loading.attr="disabled">
                        <button type="submit" class="chatbot-send-btn" wire:loading.attr="disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" style="margin-left: 2px !important;">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Toggle Button -->
        <div class="chatbot-toggle-wrapper">
            @if (!$isOpen)
                <button wire:click="chatWindow" class="chatbot-toggle-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <div class="chatbot-notification-dot"></div>
                </button>
            @endif
        </div>
    </div>
</div>

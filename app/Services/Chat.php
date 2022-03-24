<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Repos\Chat as ChatRepo;

class Chat
{
    private ChatRepo $chatRepo;

    public function __construct(ChatRepo $chat)
    {
        $this->chatRepo = $chat;
    }

    public function getChats(int $userId): Collection
    {
        return $this->chatRepo->getAllByUserId($userId);
    }

    public function getMessages(int $chatId)
    {
        return $this->chatRepo->getAllMessages($chatId);
    }

    public function sendMessage($content, $to)
    {

    }
}

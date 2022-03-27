<?php

namespace App\Services;

use App\Models\Message;
use App\Repos\MessageRepo;
use Illuminate\Support\Collection;
use App\Repos\Chat as ChatRepo;

class Chat
{
    private ChatRepo $chatRepo;

    private MessageRepo $messageRepo;

    public function __construct(ChatRepo $chat, MessageRepo $messageRepo)
    {
        $this->chatRepo = $chat;
        $this->messageRepo = $messageRepo;
    }

    public function getChats(int $userId): Collection
    {
        return $this->chatRepo->getAllByUserId($userId);
    }

    public function getMessages(int $chatId)
    {
        return $this->chatRepo->getAllMessages($chatId);
    }

    public function sendMessage($from, $to, $payload): Message
    {
        $message = [
            "sender_id" => $from,
            "receiver_id" => $to,
            "chat_id" => $payload["chat_id"],
            "message_text" => $payload["message"],
            "created_at" => now()
        ];
        $newMessage = $this->messageRepo->create($message);

        return $this->messageRepo->getMessageById($newMessage->id);
    }
}

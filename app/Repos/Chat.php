<?php

namespace App\Repos;

use App\Models\Chat as ChatModel;
use App\Models\Message;

class Chat
{
    const USER_RELATIONSHIP = 'id,avatar,name';

    public function getAllByUserId(int $userId)
    {
        return ChatModel::with('sender:' . self::USER_RELATIONSHIP)
            ->with('receiver:' . self::USER_RELATIONSHIP)
            ->with('lastMessage')
            ->has('sender')
            ->has('receiver')
            ->has('lastMessage')
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->get();
    }

    public function getChat($chatId)
    {
        return ChatModel::with('sender:' . self::USER_RELATIONSHIP)
            ->with('receiver:' . self::USER_RELATIONSHIP)
            ->where('chat_id', $chatId)->first();
    }

    public function getAllMessages(int $chatId)
    {
        return Message::with('sender:' . self::USER_RELATIONSHIP)
            ->with('receiver:' . self::USER_RELATIONSHIP)
            ->where('chat_id', $chatId)
            ->get();
    }

    public function findExistedChat($sender, $receiver)
    {
        return ChatModel::where('sender_id', $sender)
            ->where('receiver_id', $receiver)
            ->orWhere(function ($query) use ($receiver, $sender) {
                $query->where('sender_id', $receiver)
                    ->where('receiver_id', $sender);
            })
            ->first();
    }

    public function create($payload)
    {
        return ChatModel::create($payload);
    }

    public function update()
    {

    }
}

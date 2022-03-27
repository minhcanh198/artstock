<?php

namespace App\Repos;

use App\Models\Chat as ChatModel;
use App\Models\Message;

class Chat
{
    const userRelations = 'id,avatar,name';

    public function getAllByUserId(int $userId)
    {
        return ChatModel::with('sender:' . self::userRelations)
            ->with('receiver:' . self::userRelations)
            ->with('lastMessage')
            ->has('sender')
            ->has('receiver')
            ->has('lastMessage')
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->get();
    }

    public function getAllMessages(int $chatId)
    {
        return Message::with('sender:' . self::userRelations)
            ->with('receiver:' . self::userRelations)
            ->where('chat_id', $chatId)
            ->get();
    }


    public function create()
    {
        return ChatModel::create([
            ''
        ]);
    }

    public function update()
    {

    }
}

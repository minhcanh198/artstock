<?php

namespace App\Repos;

use App\Models\Message;

class MessageRepo
{
    private Message $model;

    const userRelations = 'id,avatar,name';

    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    public function create(array $message): Message
    {
        return $this->model->create($message);
    }

    public function getMessageById(int $messageId)
    {
        return Message::with('sender:' . self::userRelations)
            ->with('receiver:' . self::userRelations)
            ->where('message_id', $messageId)
            ->first();
    }
}

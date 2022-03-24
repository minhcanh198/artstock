<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    protected $guarded = array();
    protected $table = "chat";
    public $timestamps = false;

    protected $fillable = ['sender_id', 'receiver_id', 'sender_delete', 'receiver_delete', 'created_at'];

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id', 'chat_id');
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class, 'chat_id', 'chat_id')->orderBy('message_id', 'desc')->take(1);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}

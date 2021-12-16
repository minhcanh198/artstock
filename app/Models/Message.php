<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	protected $guarded = array();
    public $timestamps = false;
    protected $table = "message";
    
    protected $fillable = ['chat_id','sender_id','receiver_id','message_text','message_file','sender_delete', 'file_type','receiver_delete','created_at']; 

}

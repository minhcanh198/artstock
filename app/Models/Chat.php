<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {

	protected $guarded = array();
	protected $table = "chat";
	public $timestamps = false;

    protected $fillable = ['sender_id','receiver_id','sender_delete','receiver_delete','created_at'];
}

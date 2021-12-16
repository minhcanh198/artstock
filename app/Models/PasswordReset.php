<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model {

	protected $guarded = array();
	public $timestamps = false;

	protected $table = 'password_resets';
}

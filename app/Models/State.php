<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'state';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

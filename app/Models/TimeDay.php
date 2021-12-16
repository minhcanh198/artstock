<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeDay extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'time_day';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripReason extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'trip_reason';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'cities';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

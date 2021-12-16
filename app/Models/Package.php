<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'package';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

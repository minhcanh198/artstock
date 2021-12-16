<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Continents extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'continents';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }
}

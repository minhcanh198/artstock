<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelOfDirection extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'level_of_direction';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

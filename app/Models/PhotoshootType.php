<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoshootType extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'photoshoot_type';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

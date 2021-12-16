<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferredStylePhoto extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'preferred_style_photo';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

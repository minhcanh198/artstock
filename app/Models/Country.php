<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'country';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewCountries extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'new_countries';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }
}

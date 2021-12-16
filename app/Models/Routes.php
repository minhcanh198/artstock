<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'routes';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

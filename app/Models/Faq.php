<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'faq';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

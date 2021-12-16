<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicType extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'music_types';

	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }

}

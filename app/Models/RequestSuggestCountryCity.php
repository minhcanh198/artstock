<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestSuggestCountryCity extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'request_suggest_country_city';

    protected $fillable = [
        'country',
        'city',
        'email',
        'first_name',
        'last_name',
        'planned_date'
    ];


	// public function images() {
	// 	return $this->hasMany('App\Models\Images')->where('status','active');
	// }
}

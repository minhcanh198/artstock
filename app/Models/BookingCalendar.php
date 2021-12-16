<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCalendar extends Model {

	protected $guarded = array();
    public $timestamps = false;
    
    public $table= 'booking_calendar';

}

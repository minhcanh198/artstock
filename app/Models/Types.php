<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'types';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'types_id';

    protected $fillable = [
                'types_id', 'type_name'
    ];
   

	public function users() {
        return $this->hasMany('App\Models\User');
    }


}

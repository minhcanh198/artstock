<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerFiles extends Model {

	protected $guarded = array();
    public $timestamps = false;
    protected $table = "customer_files";
    
    protected $fillable = ['customer_file_name','file_type','referenceNo','CreatedDate']; 

}
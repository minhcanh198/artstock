<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
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
    protected $table = 'payments';
    protected $primaryKey = 'idPayment';

    protected $fillable = [
                'idPayment', 'RequestReferenceNo', 'FirstName', 'LastName', 'Email', 'Phone', 'TotalAmount', 'TransactionId', 'PaymentStaus', 'PaymentMethod', 'CreatedDate', 'idCustomer', 'AdminPercentage'
    ];


}
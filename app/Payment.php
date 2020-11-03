<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'merchant_request_id',
        'checkout_request_id',
        'phone_number',
        'amount'
    ];
}

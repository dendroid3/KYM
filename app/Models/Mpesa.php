<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mpesa extends Model
{
    protected $fillable = [
        'checkout_request_id',
        'status',
        'amount',
        'paying_phone_number',
        'transaction_date'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentOrder extends Model
{

    protected $casts = [
        'order_product_id' => 'integer',
        'type' => 'integer',
    ];

    protected $guarded = [];  
}
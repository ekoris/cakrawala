<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductCredit extends Model
{

    protected $casts = [
        'order_id' => 'integer',
        'type' => 'integer',
    ];

    protected $guarded = [];  
}
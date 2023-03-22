<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'qty' => 'integer',
        'total_order' => 'integer',
        'payment_id' => 'integer',
        'status' => 'integer',
        'payment_type' => 'integer',
        'validate_by' => 'integer',
    ];

    protected $guarded = [];  

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validate()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HistoryTransaction extends Model
{
    protected $casts = [
        'transaction_id' => 'integer',
        'account_id' => 'integer',
        'total' => 'integer',
        'status' => 'integer',
        'type' => 'integer',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
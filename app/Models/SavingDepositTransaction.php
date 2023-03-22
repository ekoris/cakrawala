<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SavingDepositTransaction extends Model
{
    protected $casts = [
        'saving_deposit_id' => 'integer',
        'total' => 'integer',
        'status' => 'integer',
        'confirm_by' => 'integer',
    ];

    protected $guarded = [];  

    public function savingDeposit()
    {
        return $this->belongsTo(SavingDeposit::class);
    }

    public function confirmBy()
    {
        return $this->belongsTo(User::class,'confirm_by');
    }

}
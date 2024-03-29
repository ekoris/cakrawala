<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SavingDeposit extends Model
{
    protected $casts = [
        'account_id' => 'integer',
        'type' => 'integer',
        'total_balance' => 'integer',
        'last_update_by' => 'integer',
        'user_id' => 'integer',
    ];
    
    protected $guarded = [];  

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function lastUpdateUser()
    {
        return $this->belongsTo(User::class,'last_update_by');
    }

    public function savingDepositTransactions()
    {
        return $this->hasMany(SavingDepositTransaction::class,'saving_deposit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
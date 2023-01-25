<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SavingDeposit extends Model
{
    protected $guarded = [];  

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function lastUpdateUser()
    {
        return $this->belongsTo(User::class,'last_updated_by');
    }

    public function savingDepositTransactions()
    {
        return $this->hasMany(SavingDepositTransaction::class);
    }

}
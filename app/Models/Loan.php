<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Loan extends Model
{
    protected $guarded = [];  

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function collateral()
    {
        return $this->belongsTo(Collateral::class);
    }

    public function loanListFinancings()
    {
        return $this->hasMany(LoanListFinancing::class);
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Loan extends Model
{

    protected $casts = [
        'account_id' => 'integer',
        'type' => 'integer',
        'total_loan' => 'integer',
        'tenors' => 'integer',
        'tenor_type' => 'integer',
        'collateral_id' => 'integer',
        'user_id' => 'integer',
        'status' => 'integer',
    ];

    protected $guarded = [];  

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function collateral()
    {
        return $this->belongsTo(Collateral::class);
    }

    public function loanListFinancings()
    {
        return $this->hasMany(LoanListFinancing::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'user_id','id');
    }

}
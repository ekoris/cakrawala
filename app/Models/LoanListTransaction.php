<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LoanListTransaction extends Model
{    

    protected $casts = [
        'loan_list_financing_id' => 'integer',
        'user_id' => 'integer',
        'total' => 'integer',
        'approver_id' => 'integer',
        'status' => 'integer',
    ];

    protected $guarded = [];  
    
    public function loanListFinancing()
    {
        return $this->belongsTo(LoanListFinancing::class,'loan_list_financing_id');
    }

    public function approverBy()
    {
        return $this->belongsTo(User::class,'approver_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    

}
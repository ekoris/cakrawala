<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LoanListFinancing extends Model
{


    protected $casts = [
        'loan_id' => 'integer',
        'total_installment' => 'integer',
        'status' => 'integer',
    ];

    protected $guarded = [];  

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

}
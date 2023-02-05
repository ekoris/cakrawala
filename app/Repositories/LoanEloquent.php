<?php

namespace App\Repositories;

use App\Http\Constants\HistoryTransactionStatus;
use App\Http\Constants\LoanMainStatus;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\SavingDeposit;
use App\Models\SavingDepositTransaction;
use Illuminate\Support\Facades\DB;

class LoanEloquent {

    public function fetch($params =[])
    {
        $query = Customer::addSelect('users.*',
                DB::raw("(SELECT id from loans where user_id = users.id and type = 1 and status = 2) as pinjaman_1"),
                DB::raw("(SELECT id from loans where user_id = users.id and type = 2 and status = 2) as pinjaman_2"),
                DB::raw("(SELECT id from loans where user_id = users.id and type = 3 and status = 2) as pinjaman_3"),
        )->latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }
    
    public function fetchLoanNew($params = [])
    {
        $query = Loan::where('status', LoanMainStatus::NEW)->latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }
  
}
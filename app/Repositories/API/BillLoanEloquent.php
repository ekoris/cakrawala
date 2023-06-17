<?php

namespace App\Repositories\API;

use App\Http\Constants\LoanStatus;
use App\Models\HistoryTransaction;
use App\Http\Constants\LoanType;
use App\Http\Constants\SavingType;
use App\Models\Loan;

class BillLoanEloquent {

    public function fetch($params = [])
    {
        $loan = Loan::where('user_id', logged_in_user()->id)->where('status', 2)->first();
        if (!$loan) {
            return [];
        }

        foreach ($loan->loanListFinancings as $key => $value) {
            if ($key == 0) {
                $curent = array_merge([
                    'jenis' => LoanType::label($loan->type)
                ], $value->toArray());
            }else{
                $list[] = $value;
            }            
        }

        return [
            'current' => $curent,
            'list' => $list
        ];
    }

}
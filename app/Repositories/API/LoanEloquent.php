<?php

namespace App\Repositories\API;

use App\Http\Constants\LoanStatus;
use App\Http\Constants\LoanType;
use App\Http\Constants\SavingType;
use App\Http\Constants\TypeAccount;
use App\Models\Loan;
use App\Models\LoanListFinancing;
use DateInterval;
use DatePeriod;
use DateTime;

class LoanEloquent {

    public function store($data)
    {
        $loan = Loan::create(array_merge($data,[
            'user_id' => logged_in_user()->id
        ]));

        switch ($data['tenor_type']) {
            case '1':
                $step = '+1 day';
                $range = '+'.$data['tenors'].' day';
                break;

            case '2':
                $step = '+1 month';
                $range = '+'.$data['tenors'].' month';
                break;

            case '3':
                $step = '+1 month';
                $range = '+'.($data['tenors'] * 12).' month';
                break;
            
            default:
                $step = '+1 day';
                $range = '+'.$data['tenors'].' day';
                break;
        }
        $start    = date('Y-m-d', strtotime($step));
        $end      =  date('Y-m-d', strtotime($range, strtotime($start)));
        $totalMonthLoan = count($this->dateRange( $start, $end, $step));
        $totalLoanFinancing = $loan->total_loan / $totalMonthLoan;
        foreach ($this->dateRange( $start, $end, $step) as $value) {
            LoanListFinancing::create([
                'loan_id' => $loan->id,
                'total_installment' => $totalLoanFinancing,
                'due_date' => $value,
                'status' => LoanStatus::NOT_PAID
            ]);
        }

        return $loan;
    }

    private function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
        $dates = [];
        $current = strtotime( $first );
        $last = strtotime( $last );
    
        while( $current <= $last ) {
    
            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }
    
        return $dates;
    }

    public function listLoan($data = [])
    {
        $loans = Loan::whereHas('account', function($q){
            $q->where('user_id', logged_in_user()->id)->where('type_account', TypeAccount::LOAN);
        })->get();

        $data = [];
        foreach ($loans as $key => $value) {
            $data[] = [
                    'id' => $value->id,
                    'account_id' => $value->account_id,
                    'account_name' => $value->account->name,
                    'account_user_id' => $value->account->user_id,
                    'account_user_name' => $value->account->user->name,
                    'type_loan' => $value->type,
                    'type_loan_label' => LoanType::label($value->type),
                    'collateral_id' => $value->collateral->id,
                    'collateral_label' => $value->collateral->name,
                    'loan_list_financings' => $value->loanListFinancings
                ];
        }

        return $data;
    }

    public function loanType($type)
    {
        $loan = Loan::whereHas('account', function($q) use($type){
            $q->where('user_id', logged_in_user()->id);
        })->where('type', $type)->get();

        $data = [];
        foreach ($loan as $key => $value) {
            $data[] = [
                    'id' => $value->id,
                    'account_id' => $value->account_id,
                    'account_name' => $value->account->name,
                    'account_user_id' => $value->account->user_id,
                    'account_user_name' => $value->account->user->name,
                    'type_loan' => $value->type,
                    'type_loan_label' => LoanType::label($value->type),
                    'collateral_id' => $value->collateral->id,
                    'collateral_label' => $value->collateral->name,
                    'loan_list_financings' => $value->loanListFinancings
                ];
        }

        return $data;
    }

    public function findLoan($loanId)
    {
        $loan = Loan::find($loanId);

        if ($loan) {
            return [
                'id' => $loan->id,
                'account_id' => $loan->account_id,
                'account_name' => $loan->account->name,
                'account_user_id' => $loan->account->user_id,
                'account_user_name' => $loan->account->user->name,
                'type_loan' => $loan->type,
                'type_loan_label' => LoanType::label($loan->type),
                'collateral_id' => $loan->collateral->id,
                'collateral_label' => $loan->collateral->name,
                'loan_list_financings' => $loan->loanListFinancings
            ];
        }

        return [];
    }

    public function findListLoanFinancing($loanId)
    {
        return  LoanListFinancing::where('loan_id', $loanId)->get();
    }

}
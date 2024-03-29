<?php

namespace App\Repositories\API;

use App\Http\Constants\LoanMainStatus;
use App\Http\Constants\LoanStatus;
use App\Http\Constants\LoanTransactionStatus;
use App\Http\Constants\LoanType;
use App\Http\Constants\SavingType;
use App\Http\Constants\TypeAccount;
use App\Models\Account;
use App\Models\Loan;
use App\Models\LoanListFinancing;
use App\Models\LoanListTransaction;
use DateInterval;
use DatePeriod;
use DateTime;

class LoanEloquent {

    public function store($data)
    {
        $account = Account::where('user_id', logged_in_user()->id)->where('type_account', TypeAccount::LOAN)->first();

        if (!$account) {
            return '';
        }

        $loan = Loan::create(array_merge($data, [
            'user_id' => logged_in_user()->id,
            'status' => LoanMainStatus::NEW,
            'account_id' => $account->id
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
        $totalLoanFinancing = ($loan->total_loan + ($loan->total_loan * 0.04)) / $totalMonthLoan;
        foreach ($this->dateRange( $start, $end, $step) as $value) {
            $loanT = LoanListFinancing::create([
                'loan_id' => $loan->id,
                'total_installment' => $totalLoanFinancing,
                'due_date' => $value,
                'status' => LoanStatus::NOT_PAID
            ]);

            LoanListTransaction::create([
                'loan_list_financing_id' => $loanT->id,
                'total' => $totalLoanFinancing,
                'user_id' => logged_in_user()->id,
                'status' => LoanTransactionStatus::PENDING
            ]);
        }

        return $loan;
    }

    public function storeBillPayment($data)
    {
        return LoanListTransaction::create([
            'loan_list_financing_id' => $data['loan_list_financing_id'],
            'total' => $data['total'],
            'user_id' => logged_in_user()->id,
            'status' => LoanTransactionStatus::PENDING
        ]);
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

    public function listLoan($params = [])
    {
        $loans = Loan::where('user_id', logged_in_user()->id);

        if (isset($params['status'])) {
            $loans->where('status', $params['status']);
        }

        $loans = $loans->get();
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
        })->where('type', $type)->first();

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

        return null;
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
<?php

namespace App\Repositories;

use App\Http\Constants\HistoryTransactionStatus;
use App\Http\Constants\LoanMainStatus;
use App\Http\Constants\LoanStatus;
use App\Http\Constants\LoanTransactionStatus;
use App\Http\Constants\TypeHistoryTransaction;
use App\Models\Customer;
use App\Models\HistoryTransaction;
use App\Models\Loan;
use App\Models\LoanListFinancing;
use App\Models\LoanListTransaction;
use App\Models\SavingDeposit;
use App\Models\SavingDepositTransaction;
use Illuminate\Support\Facades\DB;

class LoanEloquent {

    public function fetch($params =[])
    {
        $query = Customer::addSelect('users.*',
                DB::raw("(SELECT id from loans where user_id = users.id and type = 1 and status in (1,2)  limit 1 ) as pinjaman_1"),
                DB::raw("(SELECT id from loans where user_id = users.id and type = 2 and status in (1,2)  limit 1 ) as pinjaman_2"),
                DB::raw("(SELECT id from loans where user_id = users.id and type = 3 and status in (1,2)  limit 1 ) as pinjaman_3"),
        )->latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function find($id)
    {
        return Loan::find($id);
    }

    public function findLoanExist($userId, $type)
    {
        return Loan::where('user_id', $userId)->whereIn('status', [2])->where('type', $type)->get();
    }
    
    public function fetchLoanNew($params = [])
    {
        $query = Loan::whereHas('account', function($q){
            $q->whereNotNull('market_id');
        })->where('status', LoanMainStatus::NEW)->latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function submit($id, $status)
    {
        return Loan::where('id', $id)->update([
            'status' => $status
        ]);
    }

    public function detailLoan($id)
    {
        return Loan::addSelect(

                \DB::raw(' loans.*, 
                    ( select sum(total_installment) from loan_list_financings where loan_id = loans.id and status = 1 ) as total_unpaid,
                    ( select sum(total_installment) from loan_list_financings where loan_id = loans.id and status = 2 ) as total_paid ')
            )
            ->with('account')
            ->where('id', $id)
            ->first();
    }

    public function listLoanFinancing($params = [], $loanId)
    {
        $query = LoanListFinancing::query()->where('loan_id', $loanId);

        return $query->paginate(15);
    }

    public function listLoanTransaction($params, $loanId)
    {
        $query = LoanListTransaction::query()->whereHas('LoanListFinancing', function($q) use($loanId){
            $q->where('loan_id', $loanId);
        });

        return $query->paginate(15);
    }

    public function submitTransaction($transactionId, $status)
    {
        $loanListTransaction = LoanListTransaction::find($transactionId);

        if ($status == 2) {
            LoanListTransaction::where('id', $loanListTransaction->id)->update([
                'status' => 2,
                'approver_id' => logged_in_user()->id
            ]);

            LoanListFinancing::where('id', $loanListTransaction->loan_list_financing_id)->update([
                'status' => LoanStatus::PAID
            ]);

            HistoryTransaction::create([
                'transaction_id' => $loanListTransaction->id,
                'transaction_table' => 'loan_list_transactions',
                'user_id' => $loanListTransaction->user_id,
                'total' => $loanListTransaction->total,
                'type_transaction' => $loanListTransaction->loanListFinancing->loan->type,
                'type' => TypeHistoryTransaction::OUT
            ]);
    
        }else{
            LoanListTransaction::where('id', $loanListTransaction->id)->update([
                'status' => 3,
                'approver_id' => logged_in_user()->id
            ]);

            if ($loanListTransaction->loanListFinancing->status != LoanStatus::PAID) {
                LoanListFinancing::where('id', $loanListTransaction->loan_list_financing_id)->update([
                    'status' => LoanStatus::NOT_PAID
                ]);
            }
        }

        $this->finisLoan($loanListTransaction->loanListFinancing->loan_id);

    }

    public function newTransaction($params = [])
    {
        $query = LoanListTransaction::query()->where('status', LoanTransactionStatus::PENDING);

        return $query->paginate(15);
    }

    public function findTransaction($id)
    {
        return LoanListTransaction::find($id);
    }

    public function loanFinancingNotPaid($loanId)
    {
        return LoanListFinancing::where('loan_id', $loanId)->where('status', LoanStatus::NOT_PAID)->get();
    }

    public function updateTransaction($transactionId, $listLoanNew, $status)
    {
        $loanListTransaction = LoanListTransaction::find($transactionId);
        if ($status == 1) {
            LoanListTransaction::where('id', $loanListTransaction->id)->update([
                'status' => 2,
                'approver_id' => logged_in_user()->id
            ]);

            LoanListFinancing::where('id', $listLoanNew)->update([
                'status' => LoanStatus::PAID
            ]);
        }else{
            LoanListTransaction::where('id', $loanListTransaction->id)->update([
                'status' => 3,
                'approver_id' => logged_in_user()->id
            ]);

            if ($loanListTransaction->loanListFinancing->status != LoanStatus::PAID) {
                LoanListFinancing::where('id', $listLoanNew)->update([
                    'status' => LoanStatus::NOT_PAID
                ]);
            }

        }
        
        $loanListTransaction->update([
            'loan_list_financing_id' => $listLoanNew
        ]);
        $this->finisLoan($loanListTransaction->loanListFinancing->loan_id);
    }

    public function finisLoan($loanId)
    {
        $cekLoanPaid = LoanListFinancing::where('loan_id', $loanId)->where('status', LoanStatus::PAID)->get();
        $cekAllLoan = LoanListFinancing::where('loan_id', $loanId)->get();
        if ($cekLoanPaid == $cekAllLoan) {
            Loan::where('id', $loanId)->update([
                'status' => LoanMainStatus::DONE
            ]);
        }
    }

    public function listLoansHistory($params, $userId, $type)
    {
        $query = Loan::where('user_id', $userId)->where('type', $type);

        return $query->paginate(15);
    }
  
}
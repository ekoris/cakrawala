<?php

namespace App\Repositories;

use App\Http\Constants\HistoryTransactionStatus;
use App\Http\Constants\LoanMainStatus;
use App\Http\Constants\LoanTransactionStatus;
use App\Http\Constants\StatusOrder;
use App\Models\AccountBank;
use App\Models\Loan;
use App\Models\LoanListTransaction;
use App\Models\OrderProduct;
use App\Models\SavingDepositTransaction;

class HomeEloquent {

    public function navigation()
    {
        return [
            'new_order' => $this->newOrder(),
            'new_saving' => $this->newSaving(),
            'new_loan' => $this->newLoan(),
            'new_loan_transaction' => $this->newLoanTransaction()
        ];
    }

    private function newOrder()
    {
        return OrderProduct::latest()->whereIn('status',[
            StatusOrder::PENDING,
            StatusOrder::WAITING_CONFIRMATION
        ])->get()->count();
    }

    private function newSaving()
    {
        return SavingDepositTransaction::with('savingDeposit')
            ->where('status', HistoryTransactionStatus::PENDING)
            ->latest()
            ->get()
            ->count();
    }

    private function newLoan()
    {
        return Loan::where('status', LoanMainStatus::NEW)->latest()
            ->get()
            ->count();
    }

    private function newLoanTransaction()
    {
        return LoanListTransaction::query()->where('status', LoanTransactionStatus::PENDING)
            ->get()
            ->count();
    }

}
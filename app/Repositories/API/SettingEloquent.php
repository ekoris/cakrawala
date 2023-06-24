<?php

namespace App\Repositories\API;

use App\Http\Constants\StatusAccount;
use App\Models\Account;
use App\Models\Loan;

class SettingEloquent {

    public function pageSaving()
    {
        $cekAccount = Account::where('user_id', logged_in_user()->id)->where('type_account', 1)->first();
        if ($cekAccount) {
            if ($cekAccount->status == StatusAccount::PENDING) {
                return 3;
            }else{                
                return 1;
            }
        }else{
            return 2;
        }
    }

    public function pageLoan()
    {
        $cekAccount = Account::where('user_id', logged_in_user()->id)->where('type_account', 2)->first();
        if ($cekAccount) {
            if ($cekAccount->status == StatusAccount::PENDING) {
                return 3;
            }else{
                $cekLoan = Loan::where('user_id', logged_in_user()->id)
                    ->where(function($q){
                        $q->where('status', 2)->orWhereHas('loanListFinancings', function($q){
                           $q->where('status', '!=', 2); 
                        });
                    })->first();
                if ($cekLoan) {
                    return 4;
                }else{
                    return 1;
                }
            }
        }else{
            return 2;
        }
    }

}
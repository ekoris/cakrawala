<?php

namespace App\Repositories\API;

use App\Models\HistoryTransaction;
use App\Http\Constants\LoanType;
use App\Http\Constants\SavingType;

class HistoryTransactionEloquent {

    public function fetch($params = [])
    {
        $history =  HistoryTransaction::where('user_id', logged_in_user()->id)->get();
        $data = [];
        foreach ($history as $key => $value) {
            $data[] = [
                'name' => $value->user->name,
                'type_transaction' => $value->transaction_table == 'saving_deposit_transactions' ? SavingType::label($value->type_transaction) : LoanType::label($value->type_transaction),
                'total' => $value->total,
                'created_at' => $value->created_at,
                'type' => $value->type
            ];
        }

        return $data;
    }

}
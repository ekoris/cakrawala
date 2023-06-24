<?php

namespace App\Repositories\API;

use App\Models\HistoryTransaction;
use App\Http\Constants\LoanType;
use App\Http\Constants\SavingType;

class HistoryTransactionEloquent {

    public function fetch($params = [])
    {
        $history =  HistoryTransaction::where('user_id', logged_in_user()->id);

        if (isset($params['date'])) {
            $history->whereDate('created_at', $params['date']);
        }

        if (isset($params['type_transaction'])) {
            switch ($params['type_transaction']) {
                case '1':
                    $history->where('type_transaction', 1);
                    break;
                    
                case '2':
                    $history->where('type_transaction', 2);
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        foreach ($history->paginate(5) as $key => $value) {
            $data[] = [
                'name' => $value->user->name,
                'type_transaction' => $value->transaction_table == 'saving_deposit_transactions' ? SavingType::label($value->type_transaction) : LoanType::label($value->type_transaction),
                'total' => $value->total,
                'created_at' => $value->created_at,
                'type' => $value->type
            ];
        }

        return $data ?? [];
    }

}
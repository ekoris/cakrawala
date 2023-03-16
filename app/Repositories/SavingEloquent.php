<?php

namespace App\Repositories;

use App\Http\Constants\HistoryTransactionStatus;
use App\Http\Constants\TypeHistoryTransaction;
use App\Models\Customer;
use App\Models\HistoryTransaction;
use App\Models\SavingDeposit;
use App\Models\SavingDepositTransaction;
use Illuminate\Support\Facades\DB;

class SavingEloquent {

    public function fetch($params =[])
    {
        $query = Customer::addSelect('users.*',
            DB::raw("(SELECT total_balance from saving_deposits where user_id = users.id and type = 1) as total_balance_1"),
            DB::raw("(SELECT total_balance from saving_deposits where user_id = users.id and type = 2) as total_balance_2"),
            DB::raw("(SELECT total_balance from saving_deposits where user_id = users.id and type = 3) as total_balance_3"),
        )->latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function detailSaving($id, $type)
    {
        return SavingDeposit::where('user_id', $id)->where('type', $type)->first();
    }

    public function historySaving($params = [], $id, $type)
    {
       $query = SavingDepositTransaction::whereHas('savingDeposit', function($q) use($id,$type){
            $q->where('user_id', $id)->where('type', $type);
       });

       if (isset($params['date'])) {
            $query->where('date_transaction', 'like','%'.date('Y-m-d', strtotime($params['date'])).'%');
        }

        if (isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        if (isset($params['q'])) {
            $query->whereHas('confirmBy', function($q) use($params){
                $q->where('name', 'like', '%'.$params['q'].'%');
            });
        }

       return $query->latest()->paginate(15);
    }

    public function submit($id, $status)
    {
        SavingDepositTransaction::where('id', $id)->update([
            'status' => $status,
            'confirm_by' => logged_in_user()->id
        ]);

        $savingDepositTransaction = SavingDepositTransaction::find($id);
        $savingDeposit = SavingDeposit::find($savingDepositTransaction->saving_deposit_id);
 
        SavingDeposit::where('id', $savingDeposit->id)->update([
            'total_balance' => SavingDepositTransaction::whereHas('savingDeposit', function($q) use($savingDeposit){
                $q->where('user_id', $savingDeposit->user_id)->where('type', $savingDeposit->type);
           })->where('status', HistoryTransactionStatus::APPROVED)->sum('total'),
            'last_updated_at' => date('Y-m-d H:i:s'),
            'last_update_by' => logged_in_user()->id
        ]);

        if ($status == 2) {
            HistoryTransaction::create([
                'transaction_id' => $savingDepositTransaction->id,
                'transaction_table' => 'saving_deposit_transactions',
                'user_id' => $savingDeposit->user->id,
                'total' => $savingDepositTransaction->total,
                'type_transaction' => $savingDeposit->type,
                'type' => TypeHistoryTransaction::IN
            ]);
        }
    }

    public function transactionPending($params = [])
    {
       $query = SavingDepositTransaction::with('savingDeposit')->where('status', HistoryTransactionStatus::PENDING)->latest();

       if (isset($params['date'])) {
            $query->where('date_transaction', 'like','%'.date('Y-m-d', strtotime($params['date'])).'%');
        }

        if (isset($params['status'])) {
            $query->where('status', $params['status']);
        }

       return $query->latest()->paginate(15);
    }
}
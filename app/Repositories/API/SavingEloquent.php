<?php

namespace App\Repositories\API;

use App\Http\Constants\SavingTransactionStatus;
use App\Http\Constants\SavingType;
use App\Http\Constants\TypeAccount;
use App\Models\SavingDeposit;
use App\Models\SavingDepositTransaction;

class SavingEloquent {

    public function saving($data = [])
    {
        $savingDeposit = SavingDeposit::firstOrCreate(
                [
                    'account_id' => $data['account_id'],
                    'type' => $data['type']
                ],[
                    'account_id' => $data['account_id'],
                    'type' => $data['type']
                ]
            );

        $dataTransaction = [
            'saving_deposit_id' => $savingDeposit->id,
            'total' => $data['total'],
            'date_transaction' => date('Y-m-d H:i:s'),
            'status' => SavingTransactionStatus::PENDING,
        ];

        $savingTransaction = SavingDepositTransaction::create($dataTransaction);

        $lastTransaction = array_merge($dataTransaction,
                [
                    'status_label' => SavingTransactionStatus::label($savingTransaction->status),
                    'confirm_by' => $savingTransaction->confirm_by
                ]
            );

        return [
            'account_id' => $savingDeposit->account_id,
            'account_name' => $savingDeposit->account->name,
            'account_user_id' => $savingDeposit->account->user_id,
            'account_user_name' => $savingDeposit->account->user->name,
            'type_saving' => $savingDeposit->type,
            'type_saving_label' => SavingType::label($savingDeposit->type),
            'total_balance' => $savingDeposit->total_balance,
            'last_update' => $savingDeposit->last_update_at,
            'last_update_by' => optional($savingDeposit->lastUpdataUser)->name,
            'transaction' => $lastTransaction
        ];
    }

    public function listSaving($data = [])
    {
        $savingDeposit = SavingDeposit::whereHas('account', function($q){
            $q->where('user_id', logged_in_user()->id)->where('type_account', TypeAccount::SAVING);
        })->get();

        $data = [];
        foreach ($savingDeposit as $key => $value) {
            $data[] = [
                    'account_id' => $value->account_id,
                    'account_name' => $value->account->name,
                    'account_user_id' => $value->account->user_id,
                    'account_user_name' => $value->account->user->name,
                    'type_saving' => $value->type,
                    'type_saving_label' => SavingType::label($value->type),
                    'total_balance' => $value->total_balance,
                    'last_update' => $value->last_update_at,
                    'last_update_by' => optional($value->lastUpdataUser)->name,
                    'history_transaction' => $value->savingDepositTransactions
                ];
        }

        return $data;
    }

    public function savingType($type)
    {
        $savingDeposit = SavingDeposit::whereHas('account', function($q) use($type){
            $q->where('user_id', logged_in_user()->id);
        })->where('type', $type)->get();

        $data = [];
        foreach ($savingDeposit as $key => $value) {
            $data[] = [
                    'id' => $value->id,
                    'account_id' => $value->account_id,
                    'account_name' => $value->account->name,
                    'account_user_id' => $value->account->user_id,
                    'account_user_name' => $value->account->user->name,
                    'type_saving' => $value->type,
                    'type_saving_label' => SavingType::label($value->type),
                    'total_balance' => $value->total_balance,
                    'last_update' => $value->last_update_at,
                    'last_update_by' => optional($value->lastUpdataUser)->name,
                    'history_transaction' => $value->savingDepositTransactions
                ];
        }

        return $data;
    }

    public function findBySavingDepositId($savingDepositId)
    {
        $savingDeposit = SavingDeposit::find($savingDepositId);

        return [
                'id' => $savingDeposit->id,
                'account_id' => $savingDeposit->account_id,
                'account_name' => $savingDeposit->account->name,
                'account_user_id' => $savingDeposit->account->user_id,
                'account_user_name' => $savingDeposit->account->user->name,
                'type_saving' => $savingDeposit->type,
                'type_saving_label' => SavingType::label($savingDeposit->type),
                'total_balance' => $savingDeposit->total_balance,
                'last_update' => $savingDeposit->last_update_at,
                'last_update_by' => optional($savingDeposit->lastUpdataUser)->name,
                'history_transaction' => $savingDeposit->savingDepositTransactions
            ];
    }

    public function historyTransactionDeposit($savingDepositId)
    {
        $savingDepositTransaction = SavingDepositTransaction::where('saving_deposit_id', $savingDepositId)->get();

        return $savingDepositTransaction->map(function ($value){
            return [
                'id' => $value->id,
                'saving_deposit_id' => $value->savingDeposit->id,
                'saving_deposit_type' => $value->savingDeposit->type,
                'saving_deposit_type_label' => SavingType::label($value->savingDeposit->type),
                'total_saving' => $value->total,
                'date_transaction' => $value->date_transaction,
                'status' => $value->status,
                'status_label' => SavingTransactionStatus::label($value->status),
                'confirm_by' => optional($value->confirmBy)->name
            ];
        });
    }

}
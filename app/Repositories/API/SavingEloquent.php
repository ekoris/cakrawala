<?php

namespace App\Repositories\API;

use App\Http\Constants\SavingTransactionStatus;
use App\Http\Constants\SavingType;
use App\Http\Constants\StatusAccount;
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
                    'type' => $data['type'],
                    'user_id' => logged_in_user()->id
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
            'user_id' => $savingDeposit->user_id,
            'user_name' => $savingDeposit->account->user->name,
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
        $savingDeposit = SavingDeposit::where('user_id', logged_in_user()->id)->get();

        $data = [];
        foreach ($savingDeposit as $key => $value) {
            $account = $value->account;
            $data[] = [
                    'user_id' => $value->user_id,
                    'user_name' => $value->account->user->name,
                    'account' => [
                        'id' => $value->account->id,
                        'name' => $account->name,
                        'date_of_birth' => $account->date_of_birth,
                        'place_of_birth' => $account->place_of_birth,
                        'nik' => $account->nik,
                        'address' => $account->address,
                        'account_officer' => $account->account_officer,
                        'market_id' => $account->market_id,
                        'market_name' => optional($account->market)->name,
                        'identity_attachment_url' => $account->url_identity_attachment,
                        'self_photo_url' => $account->url_self_photo,
                        'signature_photo_url' => $account->url_signature_photo,
                        'status' => $account->status,
                        'status_label' => StatusAccount::label($account->status),
                        'type_account' => $account->type_account,
                        'type_account_label' => TypeAccount::label($account->type_account)
                    ],
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
        $savingDeposit = SavingDeposit::where('user_id', logged_in_user()->id)->where('type', $type)->get();

        $data = [];
        foreach ($savingDeposit as $key => $value) {
            $account = $value->account;
            $data[] = [
                    'id' => $value->id,
                    'user_id' => $value->user_id,
                    'user_name' => $value->account->user->name,
                    'account' => [
                        'id' => $value->account->id,
                        'name' => $account->name,
                        'date_of_birth' => $account->date_of_birth,
                        'place_of_birth' => $account->place_of_birth,
                        'nik' => $account->nik,
                        'address' => $account->address,
                        'account_officer' => $account->account_officer,
                        'market_id' => $account->market_id,
                        'market_name' => optional($account->market)->name,
                        'identity_attachment_url' => $account->url_identity_attachment,
                        'self_photo_url' => $account->url_self_photo,
                        'signature_photo_url' => $account->url_signature_photo,
                        'status' => $account->status,
                        'status_label' => StatusAccount::label($account->status),
                        'type_account' => $account->type_account,
                        'type_account_label' => TypeAccount::label($account->type_account)
                    ],
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
        if (!$savingDeposit) {
            return 'Id Tidak Ditemukan';    
        }

        $account = $savingDeposit->account ?? [];

        return [
                'id' => $savingDeposit->id,
                'user_id' => $savingDeposit->user_id,
                'user_name' => $savingDeposit->account->user->name,
                'account' => [
                    'id' => $account->id,
                    'name' => $account->name,
                    'date_of_birth' => $account->date_of_birth,
                    'place_of_birth' => $account->place_of_birth,
                    'nik' => $account->nik,
                    'address' => $account->address,
                    'account_officer' => $account->account_officer,
                    'market_id' => $account->market_id,
                    'market_name' => optional($account->market)->name,
                    'identity_attachment_url' => $account->url_identity_attachment,
                    'self_photo_url' => $account->url_self_photo,
                    'signature_photo_url' => $account->url_signature_photo,
                    'status' => $account->status,
                    'status_label' => StatusAccount::label($account->status),
                    'type_account' => $account->type_account,
                    'type_account_label' => TypeAccount::label($account->type_account)
                ],
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
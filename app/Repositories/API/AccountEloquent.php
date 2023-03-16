<?php

namespace App\Repositories\API;

use App\Http\Constants\StatusAccount;
use App\Http\Constants\TypeAccount;
use App\Models\Account;
use Illuminate\Support\Facades\Storage;

class AccountEloquent {

    public function allAccount($params = [])
    {
        return Account::where('user_id', logged_in_user()->id)->paginate(2);
    }

    public function accountType($type)
    {
        $account = Account::where('type_account', $type)->where('user_id', logged_in_user()->id)->first();
        
        if ($account) {
            return [
                'user_id' => $account->user_id,
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
            ];
        }

        return null;
    }

    public function saveAccount($data)
    {
        $dataTemp = $data;
        unset(
            $dataTemp['identity_attachment'],
            $dataTemp['self_photo'],
            $dataTemp['signature_photo'],
        );

        if ($data['identity_attachment']) {
            $fileNameIdentity = time().'_'.$data['identity_attachment']->getClientOriginalName();
            $data['identity_attachment']->storeAs('account/'.logged_in_user()->id, $fileNameIdentity, 'public');
        }

        if ($data['self_photo']) {
            $fileNameSelfPhoto = time().'_'.$data['self_photo']->getClientOriginalName();
            $data['self_photo']->storeAs('account/'.logged_in_user()->id, $fileNameSelfPhoto, 'public');
        }

        if ($data['signature_photo']) {
            $fileNameSignaturPhoto = time().'_'.$data['signature_photo']->getClientOriginalName();
            $data['signature_photo']->storeAs('account/'.logged_in_user()->id, $fileNameSignaturPhoto, 'public');
        }

        $dataAccount = array_merge(
            $dataTemp,
            [
                'user_id' => logged_in_user()->id,
                'identity_attachment' => $fileNameIdentity ?? null,
                'self_photo' => $fileNameSelfPhoto ?? null,
                'signature_photo' => $fileNameSignaturPhoto ?? null
            ]
        );

        $account = Account::create($dataAccount);

        $dataResponse = array_merge(
            $dataTemp,
            [
                'user_id' => logged_in_user()->id,
                'identity_attachment' => Storage::disk('public')->url('account/'.logged_in_user()->id.'/').$fileNameIdentity ?? null,
                'self_photo' => Storage::disk('public')->url('account/'.logged_in_user()->id.'/').$fileNameSelfPhoto ?? null,
                'signature_photo' => Storage::disk('public')->url('account/'.logged_in_user()->id.'/').$fileNameSignaturPhoto ?? null,
                'market_name' => optional($account->market)->name,
                'type_account' => TypeAccount::label($account->type_account),
            ]
        );

        return $dataResponse;
    }

}
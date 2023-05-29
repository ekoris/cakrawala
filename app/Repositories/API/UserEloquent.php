<?php

namespace App\Repositories\API;

use App\Http\Constants\TypeAccount;
use App\Models\Account;
use App\Models\User;

class UserEloquent {

    public function update($data = [], $id)
    {
        User::where('id', $id)->update($data);

        return User::find($id);
    }

    public function credit()
    {
        $cekCredit = Account::where('user_id', logged_in_user()->id)->where('type_account', TypeAccount::LOAN)->first();
        if ($cekCredit) {
            return true;
        }

        return false;
    }

    public function updatePassword($data = [], $id)
    {
        User::where('id', $id)->update([
            'password' => bcrypt($data['new_password'])
        ]);

        return User::find($id);
    }
}
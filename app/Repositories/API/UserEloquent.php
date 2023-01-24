<?php

namespace App\Repositories\API;

use App\Models\User;

class UserEloquent {

    public function update($data = [], $id)
    {
       User::where('id', $id)->update($data);

       return User::find($id);
    }
}
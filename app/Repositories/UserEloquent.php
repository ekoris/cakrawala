<?php

namespace App\Repositories;

use App\Models\User;

class UserEloquent {

    public function fetch($params =[])
    {
        $query = User::latest();

        return $query->paginate(15);
    }

    public function update($data = [], $id)
    {
       User::where('id', $id)->update($data);

       return User::find($id);
    }
}
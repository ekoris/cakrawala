<?php

namespace App\Repositories;

use App\Models\Customer;

class ClientEloquent {

    public function fetch($params =[])
    {
        $query = Customer::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }


}
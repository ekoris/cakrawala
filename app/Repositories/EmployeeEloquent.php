<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeEloquent {

    public function fetch($params =[])
    {
        $query = Employee::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }


}
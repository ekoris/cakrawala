<?php

namespace App\Repositories;

use App\Models\Employee;

class UserEloquent {

    public function fetch($params =[])
    {
        $query = Employee::latest();

        return $query->paginate(15);
    }

    public function update($data = [], $id)
    {
       Employee::where('id', $id)->update($data);

       return Employee::find($id);
    }

    public function store($data)
    {
        return Employee::create([
            'name' => $data['name'],
            'email' => 
        ]);
    }
}
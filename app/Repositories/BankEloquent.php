<?php

namespace App\Repositories;

use App\Models\AccountBank;

class BankEloquent {

    public function fetch($params =[])
    {
        $query = AccountBank::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function store($data)
    {
        return AccountBank::create([
            'name' => $data['name'],
            'number' => $data['number'],
        ]);
    }
    
    public function find($id)
    {
        return AccountBank::find($id);
    }

    public function update($id, $data)
    {
        return AccountBank::where('id', $id)->update([
            'name' => $data['name'],
            'number' => $data['number']
        ]);
    }

    public function delete($id)
    {
        return AccountBank::where('id', $id)->delete();
    }
}
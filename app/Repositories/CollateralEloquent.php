<?php

namespace App\Repositories;

use App\Models\Collateral;

class CollateralEloquent {

    public function fetch($params =[])
    {
        $query = Collateral::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function store($data)
    {
        return Collateral::create([
            'name' => $data['name']
        ]);
    }
    
    public function find($id)
    {
        return Collateral::find($id);
    }

    public function update($id, $data)
    {
        return Collateral::where('id', $id)->update([
            'name' => $data['name']
        ]);
    }

    public function delete($id)
    {
        return Collateral::where('id', $id)->delete();
    }
}
<?php

namespace App\Repositories;

use App\Models\Market;

class MarketEloquent {

    public function fetch($params =[])
    {
        $query = Market::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function store($data)
    {
        return Market::create([
            'name' => $data['name']
        ]);
    }
    
    public function find($id)
    {
        return Market::find($id);
    }

    public function update($id, $data)
    {
        return Market::where('id', $id)->update([
            'name' => $data['name']
        ]);
    }

    public function delete($id)
    {
        return Market::where('id', $id)->delete();
    }
}
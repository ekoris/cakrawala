<?php

namespace App\Repositories;

use App\Models\BannerPromo;

class BannerEloquent {

    public function fetch($params =[])
    {
        $query = BannerPromo::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function store($data)
    {
        $data['image']->storeAs('banner', $data['image']->getClientOriginalName(), 'public');
        return BannerPromo::create([
            'name' => $data['name'],
            'image' => $data['image']->getClientOriginalName()
        ]);
    }
    
    public function find($id)
    {
        return BannerPromo::find($id);
    }

    public function update($id, $data)
    {
        if (isset($data['image'])) {
            $data['image']->storeAs('banner', $data['image']->getClientOriginalName(), 'public');
        }

        return BannerPromo::where('id', $id)->update([
            'name' => $data['name'],
            'image' => isset($data['image']) ? $data['image']->getClientOriginalName(): BannerPromo::find($id)->image
        ]);
    }

    public function delete($id)
    {
        return BannerPromo::where('id', $id)->delete();
    }
}
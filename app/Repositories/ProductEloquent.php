<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductPhoto;

class ProductEloquent {

    public function fetch($params =[])
    {
        $query = Product::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function store($data)
    {
       $product = Product::create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
       ]);

        if ($data['image']) {
            $fileNameIdentity = time().'_'.$data['image']->getClientOriginalName();
            $data['image']->storeAs('product/', $fileNameIdentity, 'public');

            ProductPhoto::create([
                'product_id' => $product->id,
                'attachment' => $fileNameIdentity,
                'is_thumbnail' => 1
            ]);
        }

        foreach ($data['file'] as $key => $value) {
            $fileNameIdentity = time().'_'.$value->getClientOriginalName();
            $value->storeAs('product/', $fileNameIdentity, 'public');

            ProductPhoto::create([
                'product_id' => $product->id,
                'attachment' => $fileNameIdentity,
                'is_thumbnail' => 0
            ]);
        }
    }
    
    public function find($id)
    {
        return Product::find($id);
    }

    public function update($id, $data)
    {
        return Product::where('id', $id)->update([
            'name' => $data['name']
        ]);
    }

    public function delete($id)
    {
        return Product::where('id', $id)->delete();
    }
}
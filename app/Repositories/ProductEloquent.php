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

        if (($data['image'] ?? [])) {
            $fileNameIdentity = time().'_'.$data['image']->getClientOriginalName();
            $data['image']->storeAs('product/', $fileNameIdentity, 'public');

            ProductPhoto::create([
                'product_id' => $product->id,
                'attachment' => $fileNameIdentity,
                'is_thumbnail' => 1
            ]);
        }

        foreach (($data['file'] ?? []) as $key => $value) {
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

    public function update($data, $id)
    {
        $product = Product::find($id);

        Product::where('id', $product->id)->update([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);

        if (!empty($data['images_before'])) {
            $deletePhotoBefore = ProductPhoto::where('product_id', $product->id)
                ->where('is_thumbnail', 0)
                ->whereNotIn('attachment', $data['images_before'])
                ->delete();
        }else{
            $deletePhotoBefore = ProductPhoto::where('product_id', $product->id)
                ->where('is_thumbnail', 0)
                ->delete();
        }

        if (isset($data['thumbnail'])) {
            $fileNameIdentity = time().'_'.$data['thumbnail']->getClientOriginalName();
            $data['thumbnail']->storeAs('product/', $fileNameIdentity, 'public');

            ProductPhoto::where('product_id', $product->id)->where('is_thumbnail', 1)->update([
                'attachment' => $fileNameIdentity
            ]);
        }

        foreach (($data['file'] ?? []) as $key => $value) {
            $fileNameIdentity = time().'_'.$value->getClientOriginalName();
            $value->storeAs('product/', $fileNameIdentity, 'public');

            ProductPhoto::create([
                'product_id' => $product->id,
                'attachment' => $fileNameIdentity,
                'is_thumbnail' => 0
            ]);
        }

    }

    public function delete($id)
    {
        return Product::where('id', $id)->delete();
    }
}
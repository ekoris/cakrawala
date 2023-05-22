<?php

namespace App\Repositories\API;

use App\Models\Category;
use App\Models\Product;

class ProductEloquent {

    public function find($idProduct)
    {
        $product = Product::find($idProduct);

        if ($product) {
            return  [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category_id' => $product->category_id,
                'category_name' => optional($product->productCategory)->name,
                'photos' => $product->productPhotos->map(function ($product)  {
                    return [
                        'is_thumbnail' => $product->is_thumbnail,
                        'url' => $product->url_photo
                    ];
                }),
                'credit' => $this->credit($product)
            ];
        }

        return null;
    }


    public function fetchProduct($params = [])
    {
        $data = Product::latest();

        if (isset($params['q'])) {
            $data->where('name','like','%'.$params['q'].'%');
        }

        if (isset($params['category_id'])) {
            $data->where('category_id', $params['category_id']);
        }

        return $data->paginate(15);
    }

    public function fetchProductByCategory($params = [], $categoryId)
    {
        $data = Product::where('category_id', $categoryId)->latest();

        if (isset($params['q'])) {
            $data->where('name','like','%'.$params['q'].'%');
        }

        if (isset($params['category_id'])) {
            $data->where('category_id', $params['category_id']);
        }

        return $data->paginate(15);
    }


    public function fetchCategoryProduct($params = [])
    {
        $data = Category::latest();
        
        if (isset($params['q'])) {
            $data->where('name','like','%'.$params['q'].'%');
        }

        return $data->paginate(15);
    }

    private function credit($product)
    {
        return [
            '3' => round($product->price / 3),
            '6' => round($product->price / 6),
            '12' => round($product->price / 12)
        ];
    }
}
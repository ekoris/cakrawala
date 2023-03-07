<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryProductEloquent {

    public function fetch($params =[])
    {
        $query = Category::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function store($data)
    {
       $category = Category::create([
            'name' => $data['name'],
       ]);
    }
    
    public function find($id)
    {
        return Category::find($id);
    }

    public function update($data, $id)
    {
        $category = Category::find($id);

        Category::where('id', $category->id)->update([
            'name' => $data['name'],
        ]);
    }

    public function delete($id)
    {
        return Category::where('id', $id)->delete();
    }
}
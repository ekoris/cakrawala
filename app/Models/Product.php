<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];  
    
    public function productPhotos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
}
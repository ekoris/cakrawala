<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $casts = [
        'category_id' => 'integer',
        'price' => 'integer',
    ];

    protected $guarded = [];  
    
    public function productPhotos()
    {
        return $this->hasMany(ProductPhoto::class)->where('is_thumbnail', 0);
    }

    public function productCategory()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function getUrlImageThumbnailAttribute()
    {
        $thumbnail = $this->hasOne(ProductPhoto::class,'product_id','id')->where('is_thumbnail', 1)->first();
        if (!empty($thumbnail->attachment)) {
            return Storage::disk('public')->url('product/'.$thumbnail->attachment);
        }

        return '#';
        
    }
}
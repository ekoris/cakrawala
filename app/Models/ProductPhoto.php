<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductPhoto extends Model
{
    
    protected $guarded = [];  
    
    public function getUrlPhotoAttribute()
    {
        return Storage::disk('public')->url('product/'.$this->attachment);
    }

}
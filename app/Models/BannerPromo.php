<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BannerPromo extends Model
{
    protected $guarded = [];

    public function getUrlImageAttribute()
    {
        return Storage::disk('public')->url('banner/'.$this->image);
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Account extends Model
{

    protected $casts = [
        'user_id' => 'integer',
        'nik' => 'integer',
        'market_id' => 'integer',
        'status' => 'integer',
    ];
    
    protected $guarded = [];  

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getUrlIdentityAttachmentAttribute()
    {
        return Storage::disk('public')->url('account/'.$this->user_id.'/'.$this->identity_attachment);
    }

    public function getUrlSelfPhotoAttribute()
    {
        return Storage::disk('public')->url('account/'.$this->user_id.'/'.$this->self_photo);
    }

    public function getUrlSignaturePhotoAttribute()
    {
        return Storage::disk('public')->url('account/'.$this->user_id.'/'.$this->signature_photo);
    }

}
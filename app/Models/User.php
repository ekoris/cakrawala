<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];  
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTotalSavingAttribute()
    {
        return SavingDeposit::where('user_id', logged_in_user()->id)->sum('total_balance');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }    

    public function getUrlProfilePictureAttribute()
    {
        return Storage::disk('public')->url('profil/'.$this->id.'/'.$this->profile_picture);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'users';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('checkEmployee', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->whereIn('is_employee', [0,null]);
        });

        static::creating(function ($user) {
            $user->is_employee = 1;
        });
    }

}
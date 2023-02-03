<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'users';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('checkEmployee', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('is_employee', '1');
        });

        static::creating(function ($user) {
            $user->is_employee = 1;
        });
    }

}
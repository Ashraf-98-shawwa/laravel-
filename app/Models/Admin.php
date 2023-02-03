<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;


class Admin extends Authenticatable
{
    use HasFactory, HasRoles , HasApiTokens;

    public function user()
    {
        return $this->morphOne(User::class, 'user', 'user_type', 'user_id', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($admin) {
            $admin->user()->delete();
        });
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
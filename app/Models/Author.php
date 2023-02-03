<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class Author extends Authenticatable
{
    use HasFactory, HasRoles , HasApiTokens;

    public function user()
    {
        return $this->morphOne(User::class, 'user', 'user_type', 'user_id', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($author) {
            $author->user()->delete();
        });
        static::deleting(function ($author) {
            $author->articles()->delete();
        });
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }


}
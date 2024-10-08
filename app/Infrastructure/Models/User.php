<?php

namespace App\Infrastructure\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    protected $connection = 'mongodb';
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

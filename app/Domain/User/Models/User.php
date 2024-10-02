<?php

namespace App\Domain\User\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

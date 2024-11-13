<?php

namespace App\Infrastructure\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function notificationSettings()
    {
        return $this->hasMany(UserNotificationSetting::class);
    }
}

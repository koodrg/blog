<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotificationSetting extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

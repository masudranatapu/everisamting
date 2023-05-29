<?php

namespace Modules\PushNotification\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDeviceToken extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\PushNotification\Database\factories\UserDeviceTokenFactory::new();
    }
}

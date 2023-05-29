<?php

namespace Modules\MobileApp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MobileAppConfig extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\MobileApp\Database\factories\MobileAppConfigFactory::new();
    }
}

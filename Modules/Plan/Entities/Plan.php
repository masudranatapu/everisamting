<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plan\Database\factories\PriceplanFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'label', 'price', 'ad_limit', 'featured_limit', 'badge', 'recommended', 'interval', 'custom_interval_days', 'business_directory_limit',
    ];

    protected $casts = [
        'badge'             =>  'boolean',
    ];


    protected static function newFactory()
    {
        return PriceplanFactory::new();
    }
}

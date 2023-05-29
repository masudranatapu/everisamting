<?php

namespace Modules\ServiceType\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Ad\Entities\Ad;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'status'
    ];

    protected static function newFactory()
    {
        return \Modules\ServiceType\Database\factories\ServiceTypeFactory::new();
    }

    function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }
}

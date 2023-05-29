<?php

namespace Modules\Designation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ad\Entities\Ad;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Designation\Database\factories\DesignationFactory::new();
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}

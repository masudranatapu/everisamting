<?php

namespace Modules\ProductModel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ad\Entities\Ad;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;

class ProductModel extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ProductModel\Database\factories\ProductModelFactory::new();
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

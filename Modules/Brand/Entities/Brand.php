<?php

namespace Modules\Brand\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Modules\ProductModel\Entities\ProductModel;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug'
    ];

    protected static function newFactory()
    {
        return \Modules\Brand\Database\factories\BrandFactory::new();
    }

    /**
     * Set the category slug.
     *
     * @param  string $value
     * @return void
     */
    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }


    /**
     *  Has Many
     * @return HasMany|Collection|AdFeature[]
     */
    function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }
    function models(): HasMany
    {
        return $this->hasMany(ProductModel::class);
    }
}

<?php

namespace Modules\Category\Entities;

use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
    ];

    /**
     *  Active Subcategory scope
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\SubCategoryFactory::new();
    }

    /**
     * Set the subcategory name.
     * Set the subcategory slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    function ads(): HasMany
    {
        return $this->hasMany(Ad::class, 'subcategory_id');
    }
}

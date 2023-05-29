<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image'
    ];

    protected $appends = [
        'image_url'
    ];

    public function setPageSlugAttribute($value)
    {
        $this->attributes['page_slug'] = Str::slug($value);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('frontend/image/default.jpg');
        }

        return asset($this->image);
    }
}

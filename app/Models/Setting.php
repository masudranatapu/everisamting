<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'search_engine_indexing'  =>  'boolean',
        'google_analytics'  =>  'boolean',
        'facebook_pixel'  =>  'boolean',
    ];

    protected $appends = ['logo_image_url', 'white_logo_url', 'favicon_image_url', 'loader_image_url'];


    public function getLogoImageUrlAttribute()
    {
        if (is_null($this->logo_image)) {
            return asset('frontend/images/logo.png');
        }
        return asset($this->logo_image);
    }

    public function getWhiteLogoUrlAttribute()
    {
        if (is_null($this->white_logo)) {
            return asset('backend/image/logo.png');
        }
        return asset($this->white_logo);
    }

    public function getFaviconImageUrlAttribute()
    {
        if (is_null($this->favicon_image)) {
            return asset('backend/image/64x64.png');
        }
        return asset($this->favicon_image);
    }

    public function getLoaderImageUrlAttribute()
    {
        if (is_null($this->loader_image)) {
            return asset('frontend/images/loader.gif');
        }
        return asset($this->loader_image);
    }
}

<?php

namespace Modules\Blog\Entities;

use App\Models\Admin;
use App\Models\BlogComment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\PostCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['image_url'];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-thumbnail.jpg');
        }

        return asset($this->image);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }
}

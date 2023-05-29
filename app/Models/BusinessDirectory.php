<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessDirectory extends Model
{
    use HasFactory;
    protected $table = 'ads_business_directory';
    protected $casts = ['category_id' => 'array'];
    protected $appends = ['image_url'];

    protected $fillable = [
        'title',
        'slug',
        'address',
        'phone',
        'user_id',
        'email',
        'map',
        'thumbnail',
        'street',
        'municipality',
        'plus_code',
        'latitude',
        'longitude',
        'website',
        'domain',
        'opening_hours',
        'review_count',
        'average_rating',
        'review_url',
        'google_knowledge_url',
        'category_id',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getImageUrlAttribute(){
        if (isset($this->thumbnail)) {
            if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
                return $this->thumbnail;
            } else {
                return asset($this->thumbnail);
            }
        }else{
            return asset('images/event.jpg');
        }
    }
}

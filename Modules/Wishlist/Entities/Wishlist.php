<?php

namespace Modules\Wishlist\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ad\Entities\Ad;
use Illuminate\Notifications\Notifiable;

class Wishlist extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Wishlist\Database\factories\WishlistFactory::new();
    }

    /**
     *  Customer scope
     * @return mixed
     */
    public function scopeCustomerData($query)
    {
        return $query->where('user_id', auth('user')->id());
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id')->with('category', 'subcategory', 'customer', 'brand', 'adFeatures', 'galleries');;
    }
}

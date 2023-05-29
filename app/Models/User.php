<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Ad\Entities\Ad;
use Modules\PushNotification\Entities\UserDeviceToken;
use Modules\Review\Entities\Review;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, MustVerifyEmail;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'web',
        'image',
        'show_email',
        'receive_email',
        'show_phone',
        'opening_hour',
        'closing_hours',
        'about_public_profile',
        'username',
        'password'
    ];

    protected $appends = ['image_url', 'unread'];
    protected $guard = 'user';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($customer) {
            $setting = Setting::first();
            $customer->userPlan()->create([
                'ad_limit' => $setting->free_ad_limit,
                'featured_limit' => $setting->free_featured_ad_limit,
                'business_directory_limit' => $setting->free_business_directory_limit,
                'subscription_type' => $setting->subscription_type,
            ]);
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        // $this->attributes['username'] = Str::slug($value) . '_' . time();
    }


    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-user.png');
        }

        return asset($this->image);
    }

    public function getUnreadAttribute()
    {
        return Messenger::where('to_id', auth()->id())
            ->where('from_id', $this->id)
            ->where('body', '!=', '.')
            ->where('read', 0)
            ->count() ?? 0;
    }

    /**
     *  HasMany
     * @return HasMany|Collection|Customer
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class)->where('status', 'active');
    }

    /**
     * User Pricing Plan
     *
     * @return HasOne
     *
     */
    public function userPlan(): HasOne
    {
        return $this->hasOne(UserPlan::class);
    }

    /**
     * User Transactions
     *
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'seller_id');
    }

    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class, 'user_id');
    }

    public function deviceToken()
    {
        return $this->hasMany(UserDeviceToken::class, 'user_id', 'id');
    }
}

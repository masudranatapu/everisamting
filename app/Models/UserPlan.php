<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'ad_limit', 'featured_limit', 'badge', 'subscription_type', 'expired_date', 'current_plan_id', 'is_restored_plan_benefits', 'business_directory_limit',
    ];

    protected $appends = ['remaining_days', 'plan_expired'];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $casts = [
        'badge'  =>  'boolean',
        'is_restored_plan_benefits'  =>  'boolean',
    ];

    /**
     *  Customer scope
     * @return mixed
     */
    public function scopeCustomerData($query, $user_id = null)
    {
        return $query->where('user_id', $user_id ?? auth('user')->id());
    }

    /**
     * Undocumented function
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getRemainingDaysAttribute()
    {
        if ($this->subscription_type == 'recurring' && $this->expired_date) {
            return formatDateTime($this->expired_date)->diffInDays(formatDateTime(now()->format('Y-m-d')));
        } else {
            return false;
        }
    }

    public function getPlanExpiredAttribute()
    {
        if ($this->subscription_type == 'recurring' && $this->expired_date) {
            return formatDateTime($this->expired_date)->isFuture() ? false : true;
        } else {
            return false;
        }
    }
}

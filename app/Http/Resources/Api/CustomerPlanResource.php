<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CustomerPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ad_limit' => $this->ad_limit,
            'featured_limit' => $this->featured_limit,
            'badge' => $this->badge,
            'business_directory_limit' => $this->business_directory_limit,
            // 'remaining_days' => formatDateTime($this->expired_date)->diffInDays(formatDateTime(Carbon::now()->format('Y-m-d')))
        ];
    }
}

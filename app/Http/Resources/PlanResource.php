<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            'id' => $this->id,
            'label' => $this->label,
            'price' => $this->price,
            'ad_limit' => $this->ad_limit,
            'featured_limit' => $this->featured_limit,
            'badge' => $this->badge,
            'recommended' => $this->recommended,
            'business_directory_limit' => $this->business_directory_limit
        ];
    }
}

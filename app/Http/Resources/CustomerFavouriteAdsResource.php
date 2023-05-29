<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResourceMobile;

class CustomerFavouriteAdsResource extends JsonResource
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
            'id' => $this->ad->id,
            'title' => $this->ad->title,
            'slug' => $this->ad->slug,
            'thumbnail' => $this->ad->thumbnail,
            'price' => $this->ad->price,
            'category' => new CategoryResourceMobile($this->ad->category),
            'created_at' => $this->ad->created_at->format('M d, Y'),
        ];
    }
}

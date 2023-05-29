<?php

namespace Modules\Ad\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResourceMobile;


class AdResourceMobile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'price' => $this->price,
            'status' => $this->status,
           
            'category' => new CategoryResourceMobile($this->whenLoaded('category')),
            'created_at' => $this->created_at->format('M d, Y'),
        ];
    }
}

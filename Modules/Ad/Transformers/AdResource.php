<?php

namespace Modules\Ad\Transformers;

use App\Http\Resources\CustomerResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResource;
use Modules\Category\Transformers\SubCategoryResource;

class AdResource extends JsonResource
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
            'featured' => $this->featured,
            'region' => $this->region,
            'country' => $this->country,
            'address' => $this->address,
            'total_views' => $this->total_views,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'subcategory' => $this->whenLoaded('subcategory'),
            'brand' => $this->whenLoaded('brand'),
            'customer' => $this->whenLoaded('customer'),
            'adFeatures' => $this->whenLoaded('adFeatures'),
            'galleries' => $this->whenLoaded('galleries'),
            'created_at' => $this->created_at->diffForHumans(),

        ];
    }
}

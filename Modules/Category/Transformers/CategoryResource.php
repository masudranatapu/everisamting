<?php

namespace Modules\Category\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\SubCategoryResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'order' => $this->order,
            'image' => $this->image,
            $this->mergeWhen($this->ad_count, [
                'ad_count' => $this->ad_count,
            ]),
            'subcategories' => SubCategoryResource::collection($this->whenLoaded('subcategories')),
            'has_custom_field' => $this->has_custom_field
        ];
    }
}

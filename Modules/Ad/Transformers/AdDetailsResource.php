<?php

namespace Modules\Ad\Transformers;

use App\Http\Resources\CustomerResource;
use Modules\Brand\Transformers\BrandResource;
use Modules\Ad\Transformers\AdFeaturesResource;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResource;
use Modules\Category\Transformers\SubCategoryResource;

class AdDetailsResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'thumbnail' => $this->thumbnail,
            'phone' => $this->phone,
            'show_phone' => $this->show_phone,
            'phone_2' => $this->phone_2,
            'email' => $this->email,
            'address' => $this->address,
            'total_views' => $this->total_views,
            'map_address' => $this->map_address,
            'status' => $this->status,
            'wishlisted' => $this->wishlisted,
            'created_at' => $this->created_at,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'subcategory' => new SubCategoryResource($this->whenLoaded('subcategory')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'ad_features' => AdFeaturesResource::collection($this->whenLoaded('adFeatures')),
            'galleries' => AdGalleriesResource::collection($this->whenLoaded('galleries')),

            'share_url' => route('frontend.addetails', $this->slug),
            'badges' => [
                'featured' => $this->featured ? true : false,
                'verified_seller' => $this->customer->email_verified_at ? true : false,
            ]
        ];
    }
}

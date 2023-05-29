<?php

namespace Modules\Ad\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResourcePaginate extends JsonResource
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
            'current_page' => $this->currentPage(),
            'data' => $this->data,
            'first_page_url' => $this->url(1),
            'from' => $this->firstItem(),
            'last_page' => $this->lastPage(),
            'last_page_url' => $this->url($this->lastPage()),
            'next_page_url' => $this->nextPageUrl(),
            'path' => $this->path(),
            'prev_page_url' => $this->previousPageUrl(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'total_pages' => $this->lastPage()
        ];
        // return parent::toArray($request);

        // return [
        //     'current_page' => $this->currentPage(),
        //     'data' => $this->collection->toArray(),
        //     'first_page_url' => $this->url(1),
        //     'from' => $this->firstItem(),
            // 'last_page' => $this->lastPage(),
            // 'last_page_url' => $this->url($this->lastPage()),
            // 'next_page_url' => $this->nextPageUrl(),
            // 'path' => $this->path(),
            // 'per_page' => $this->perPage(),
            // 'prev_page_url' => $this->previousPageUrl(),
            // 'to' => $this->lastItem(),
            // 'total' => $this->total(),
        // ];
    }
}

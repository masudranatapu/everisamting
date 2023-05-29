<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageBodyResource extends JsonResource
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
            'body' => $this->body,
            'created_at' => date('h:i a', strtotime($this->created_at)),
            'from_id' => $this->from_id,
            'id' => $this->id,
            'to_id' => $this->to_id,
            'updated_at' => $this->updated_at
        ];
    }
}

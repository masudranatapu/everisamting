<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceMobileResource extends JsonResource
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
            'transaction' => $this->payment_id,
            'payment_provider' => $this->payment_provider,
            'plan_type' => $this->plan->label,
            'amount' => $this->amount,
            'created_at' => $this->created_at->format('M d, Y g:i A'),
        ];
    }
}

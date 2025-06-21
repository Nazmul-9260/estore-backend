<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerOrderLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            "product_id" => $this->id,
            "product_name" => $this->product_name,
            "product_code" => $this->product_code,
            // "product_image" => $this->product->image ? asset($this->product->image) : null,
            "quantity" => $this->quantity,
            "unit_price" =>  $this->unit_price
        ];
    }
}

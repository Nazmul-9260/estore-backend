<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerReviewResource extends JsonResource
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
            "review_id" => $this->id,
            "name_published" => $this->is_anonymous ? 'Anonymous' : $this->customer_name,
            "product_id" => $this->product_id,
            "product_name" => $this->product->title,
            "image" => asset($this->product->image),
            "price" => $this->product->sell_price,
            "rating" => $this->review_star,
            "review" => $this->review
        ];
    }
}

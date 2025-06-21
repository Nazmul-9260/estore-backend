<?php

namespace App\Http\Resources;

use App\Models\CustomerDetails;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "id" => $this->id,
            "user_id" => $this->user_id,
            "status" => $this->status,
            "auth_method" => $this->auth_method,
            "is_verified" => $this->is_verified,
            "customer_details" => CustomerDetailsResource::make($this->customerDetails),
            "customer_address" =>  CustomerAddressResource::collection($this->customerAddress)

            // CustomerAddressResource::collection($this->customerAddress)


            // "customer_address" => CustomerAddressResource::collection($this->customerAddress)
        ];
    }
}

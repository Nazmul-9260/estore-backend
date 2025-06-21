<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddressResource extends JsonResource
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
            "customer_address_id" => $this->id,
            "address_type_id" => $this->address_type,
            "deliver_to" => $this->deliver_to,
            "address_type" => $this->getAddressTypeName(),
            "street_no" => $this->street_no,
            "post_office" => $this->post_office,
            "thana" => $this->thana,
            "dist" => $this->dist,
            "state" => $this->state,
            "division" => $this->division,
            "country" => $this->country,
            "zip_code" => $this->zip_code,
            "is_default" => $this->is_default

        ];
    }
}

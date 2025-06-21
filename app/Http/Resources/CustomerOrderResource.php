<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerOrderResource extends JsonResource
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
            "order_id" => $this->id,
            "order_date" => $this->order_date,
            "transaction_id" => $this->transaction_id,
            "order_status" => $this->getOrderStatusName(),
            "total_discount" => $this->total_discount,
            "order_amount" => $this->order_amount,
            "total_vat" => $this->total_vat,
            "grand_total" => $this->grand_total,
            "payment_type" => $this->getPaymentTypeName(),
            "delivery_charge" => $this->delivery_charge,
            "remarks" => $this->remarks,
            "bill_address_id" => $this->bill_address_id,
            "bill_address" => CustomerAddressResource::make($this->getBillingAddress($this->bill_address_id)),
            "delivery_address_id" => $this->delivery_address_id,
            "delivery_address" => $this->getDeliveryAddress($this->delivery_address_id),
            "order_lines" => CustomerOrderLineResource::collection($this->salesOrderLines),
            "payment_info" => $this->getPaymentInfo()
        ];
    }
}

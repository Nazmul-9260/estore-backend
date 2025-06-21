<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CustomerPaymentResource extends JsonResource
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
            "payment_id" =>  $this->payment_id,
            "order_id" => $this->order_id,
            // "max_sl_no": 12,
            "mr_no" => $this->mr_no,
            "transaction_id" => $this->transaction_id,
            "payment_method" => $this->getPaymentTypeName(),
            "payment_amount" => $this->payment_amount,
            "discount_amount" =>  $this->discount_amount,
            "payment_date" => $this->payment_datetime,
            "payment_status" =>  $this->payment_status,
            "is_advance_payment" => $this->is_advance_payment ? 'yes' : 'no',
            // "more_details": null,
            // "drawer": null,
            "receive_type" =>  $this->getPaymentReceiveType(),
            "manual_mr_no" => $this->manual_mr_no,
            "received_by" => $this->received_by,
            "bank_name" =>  $this->bank_name,
            "account_name" => $this->account_name,
            "cheque_no" => $this->cheque_no,
            "cheque_date" => $this->cheque_date,
            // "created_at": "2025-02-24T09:40:58.000000Z",
            // "updated_at": "2025-02-24T09:40:58.000000Z",
            // "created_by": 756,
            // "updated_by": null
        ];
    }
}

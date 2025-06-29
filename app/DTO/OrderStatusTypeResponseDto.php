<?php

namespace App\DTO;

class OrderStatusTypeResponseDto
{

    public $orderStatusType;
    public $orderStatusId;

    public function __construct(array $data)
    {
        $this->orderStatusType = $data['name'];
        $this->orderStatusId =  $data['value'];
    }

    public function getResource()
    {
        return [
            "order_status_type" => $this->orderStatusType,
            "order_status_type_id" => $this->orderStatusId
        ];
    }
}

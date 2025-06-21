<?php

namespace App\DTO;

class AddressTypeResponseDto
{

    public $addressType;
    public $addressTypeId;

    public function __construct(array $data)
    {
        $this->addressType = $data['name'];
        $this->addressTypeId =  $data['value'];
    }

    public function getResource()
    {
        return [
            "address_type" => $this->addressType,
            "address_type_id" => $this->addressTypeId
        ];
    }
}

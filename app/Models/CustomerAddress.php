<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $table = 'cms_customer_address';

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function getAddressType()
    {
        $addressType = DB::table('master_common_configurations')->where('type', 'address_type')
            ->where('value', $this->address_type)->first();

        return $addressType;
    }

    public function getAddressTypeName()
    {
        return $this->getAddressType()->name;
    }
}

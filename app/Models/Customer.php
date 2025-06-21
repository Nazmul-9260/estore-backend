<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Otp;
use Modules\Config\Entities\ProductQa;
use Modules\Config\Entities\ProductReview;
use Modules\Sales\Entities\SalesOrder;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Support\Facades\DB;

class Customer extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $table = 'customers';

    protected $guarded = [];

    public function otps()
    {
        return $this->hasMany(Otp::class, 'customer_id', 'id');
    }

    public function customerDetails()
    {
        return $this->hasOne(CustomerDetails::class, 'customer_id', 'id');
    }


    public function customerAddress()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id', 'id');
    }

    public function getCustomerAddressGroupByType()
    {
        $addressList =  $this->customerAddress->toArray();

        $grouped = [];

        foreach ($addressList as $k => $address) {
            $setKey = (string) $address['address_type'];
            if (!isset($grouped[$setKey])) {
                $grouped[$setKey] = [];
            }
            $grouped[$setKey][] = $address;
        }

        return $grouped;
    }

    public function salesOrders()
    {
        // return $this->hasMany(SalesOrder::class, 'customer_id', 'id')->orderBy('id', 'desc');
        return $this->hasMany(SalesOrder::class, 'customer_id', 'id');
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'customer_id', 'id');
    }

    public function productQas()
    {
        return $this->hasMany(ProductQa::class, 'customer_id', 'id');
    }

    public function payments()
    {
        $orders = $this->salesOrders()->get();

        $orderIdList = [];

        foreach ($orders as $order) {
            $orderIdList[] = $order->id;
        }

        return Payment::query()->whereIn('order_id', $orderIdList)->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment_receipt';

    protected $guarded = [];


    public function salesOrder()
    {
        return $this->belongsTo(SaleOrder::class, 'order_id', 'id');
    }

    public function customer()
    {
        $orderId = $this->order_id;

        $customerId = SaleOrder::query()->where('id', $orderId)->first();

        return Customer::query()->where('id', $customerId)->get();
    }

    public function getPaymentTypeName()
    {
        $paymentType = DB::table('master_common_configurations')->where('type', 'payment_type')
            ->where('value', $this->payment_method)->first();

        return $paymentType->name;
    }

    public function getPaymentReceiveType()
    {
        $paymentReceiveType = DB::table('master_common_configurations')->where('type', 'payment_receive_type')
            ->where('value', $this->receive_type)->first();

        return $paymentReceiveType->name;
    }
}

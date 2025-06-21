<?php

namespace Modules\Sales\Entities;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Modules\Accounting\Entities\PaymentReceive;
use App\Models\Payment;

class SalesOrder extends Model
{
    use HasFactory;

    protected $table = "sale_orders";

    protected $guarded = [];

    public function salesOrderLines()
    {
        return $this->hasMany(SalesOrderLine::class, 'order_id', 'id');
    }

    public function salesOrderDeliveries()
    {
        return $this->hasMany(SalesOrderDelivery::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function getOrderStatusName()
    {
        $orderStatus = DB::table('master_common_configurations')->where('type', 'order_status')
            ->where('value', $this->order_status)->first();

        return $orderStatus->name;
    }

    public function getPaymentTypeName()
    {
        $paymentType = DB::table('master_common_configurations')->where('type', 'payment_type')
            ->where('value', $this->payment_type_id)->first();

        return $paymentType->name;
    }

    public function getBillingAddress($billAddressId)
    {
        $billingAddress = collect($this->customer->customerAddress)->filter(function ($address, $key) use ($billAddressId) {
            return $address->id == $billAddressId;
        })->first();

        return $billingAddress;
    }

    public function getDeliveryAddress($deliveryAddressId)
    {
        $deliveryAddress = collect($this->customer->customerAddress)->filter(function ($address, $key) use ($deliveryAddressId) {
            return $address->id == $deliveryAddressId;
        })->first();

        return $deliveryAddress;
    }

    public function paymentReceives()
    {
        return $this->hasMany(PaymentReceive::class, 'order_id', 'id');
    }

    public function getPaymentInfo()
    {
        $countPaymentReceives = null;
        $isFullPaid = null;
        $totalPaid = null;
        $totalDiscount = null;
        $totalDue = null;
        $payments = $this->paymentReceives;
        $countPaymentReceives = count($payments);
        foreach ($payments as $payment) {
            $totalPaid += $payment->payment_amount;
            $totalDiscount += $payment->discount_amount;
        }

        $totalDue = floor($this->grand_total - $totalPaid - $totalDiscount);

        if ($totalDue > 0) {
            $isFullPaid = false;
        } else {
            $isFullPaid = true;
        }

        return [
            "is_full_paid" => $isFullPaid,
            "grand_total" => $this->grand_total,
            "total_paid" => $totalPaid,
            "total_discount" => $totalDiscount,
            "total_due" => $totalDue,
        ];
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'order_id', 'id');
    }
}

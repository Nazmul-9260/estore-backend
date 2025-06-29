<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sales\Entities\SalesOrder;

class PaymentReceive extends Model
{
    use HasFactory;

    protected $table = "payment_receipt";

    protected $guarded = [];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'order_id', 'id');
    }
}

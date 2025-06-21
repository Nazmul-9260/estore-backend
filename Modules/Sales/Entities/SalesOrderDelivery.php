<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrderDelivery extends Model
{
    use HasFactory;

    protected $table = "sale_deliveries";

    protected $guarded = [];

    public function salesOrderDeliveryLines()
    {
        return $this->hasMany(SalesOrderDeliveryLine::class, 'delivery_id', 'id');
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'order_id', 'id');
    }
}

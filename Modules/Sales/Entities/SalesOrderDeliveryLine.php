<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrderDeliveryLine extends Model
{
    use HasFactory;

    protected $table = "sale_delivery_lines";

    protected $guarded = [];

    public function salesOrderDelivery()
    {
        return $this->belongsTo(SalesOrderDelivery::class, 'delivery_id', 'id');
    }

    public function salesOrderLine()
    {
        return $this->belongsTo(SalesOrderLine::class, 'sale_order_line_id', 'id');
    }
}

<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Config\Entities\Product;

class SalesOrderLine extends Model
{
    use HasFactory;

    protected $table = "sale_order_lines";

    protected $guarded = [];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'order_id', 'id');
    }

    public function salesOrderDeliveryLines()
    {
        return $this->hasMany(SalesOrderDeliveryLine::class, 'sale_order_line_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

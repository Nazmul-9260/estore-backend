<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $table = 'payment_log';

    protected $guarded = [];
    

    public function salesOrder()
    {
        return $this->belongsTo(SaleOrder::class, 'order_id', 'id');
    }
}

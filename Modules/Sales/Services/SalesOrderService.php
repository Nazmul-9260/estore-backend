<?php

namespace Modules\Sales\Services;

use Carbon\Carbon;
use DB;
use Exception;
use Modules\Config\Entities\Config;
use Modules\Sales\Entities\SalesOrder;
use Modules\Sales\Entities\SalesOrderDelivery;
use Toastr;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Modules\Config\Entities\Product;
use Modules\Sales\Entities\SalesOrderDeliveryLine;
use Modules\Sales\Entities\SalesOrderLine;

class SalesOrderService
{
    public function deliver(array $data)
    {
        $orderId = $data['order_id'];
        $deliveryDate = $data['delivery_date'];
        $salesOrderLineIdList = $data['sale_order_line_id'];
        $deliveryQuantityList = $data['delivery_quantity'];

        // Step 1: Validation checkpoint
        if ($this->isFullyDelivered($orderId)) {
            return [
                'status' => 'error',
                'message' => 'All Products Already Delivered!',
                'code' => 400,
            ];
        }

        if (!$deliveryDate) {
            return [
                'status' => 'error',
                'message' => 'Has to set delivery date.',
                'code' => 400,
            ];
        }

        if (!$this->hasValidDeliveryQuantities($deliveryQuantityList)) {
            return [
                'status' => 'error',
                'message' => 'Has to deliver at least one product.',
                'code' => 400,
            ];
        }

        // Step 2: Delivery Process
        $salesOrder = SalesOrder::findOrFail($orderId);
        $createdAt = Carbon::now();
        $createdBy = Auth::id();

        $salesOrderDelivery = SalesOrderDelivery::create([
            'order_id' => $orderId,
            'delivery_date' => $deliveryDate,
            'customer_id' => $salesOrder->customer_id,
            'delivery_address_id' => $salesOrder->delivery_address_id,
            'delivered_by' => $createdBy,
            'delivered_media' => $data['delivery_media'] ?? null,
            'remarks' => "Note: Delivery on date " . $deliveryDate,
            'created_at' => $createdAt,
            'created_by' => $createdBy,
        ]);

        $deliveryLines = $this->processDeliveryLines($salesOrderLineIdList, $deliveryQuantityList, $salesOrderDelivery, $createdAt, $createdBy);

        return [
            'status' => 'success',
            'message' => 'Delivered',
            'data' => [
                'partial_delivery_marked' => $deliveryLines['partial_delivery_marked'],
                'sales_order_delivery' => $salesOrderDelivery,
                'sales_order_delivery_lines' => $deliveryLines['lines'],
            ],
            'code' => 200,
        ];
    }

    private function isFullyDelivered($orderId)
    {
        $salesOrderLines = SalesOrderLine::where('order_id', $orderId)->get();

        foreach ($salesOrderLines as $line) {
            $orderedQty = $line->quantity;
            $deliveredQty = SalesOrderDeliveryLine::where('sale_order_line_id', $line->id)->sum('quantity');

            if ($deliveredQty < $orderedQty) {
                return false;
            }
        }

        return true;
    }

    private function hasValidDeliveryQuantities(array $deliveryQuantities)
    {
        foreach ($deliveryQuantities as $quantity) {
            if ($quantity > 0) {
                return true;
            }
        }

        return false;
    }

    private function processDeliveryLines($lineIds, $quantities, $salesOrderDelivery, $createdAt, $createdBy)
    {
        $lines = [];
        $partialDeliveryMarked = false;

        foreach ($lineIds as $index => $lineId) {
            $line = SalesOrderLine::findOrFail($lineId);
            $product = Product::findOrFail($line->product_id);

            $orderedQty = $line->quantity;
            $deliveredQty = SalesOrderDeliveryLine::where('sale_order_line_id', $lineId)->sum('quantity');
            $remainingQty = $orderedQty - $deliveredQty;

            if ($quantities[$index] > 0 && $quantities[$index] <= $remainingQty) {
                $lines[] = SalesOrderDeliveryLine::create([
                    'delivery_id' => $salesOrderDelivery->id,
                    'sale_order_line_id' => $lineId,
                    'product_id' => $line->product_id,
                    'product_name' => $product->title,
                    'product_code' => $product->code,
                    'quantity' => $quantities[$index],
                    'created_at' => $createdAt,
                    'created_by' => $createdBy,
                ]);
            } else {
                $partialDeliveryMarked = true;
                $lines[] = [
                    'message' => "Delivery Failed for product {$product->title}",
                    'requested_delivery_quantity' => $quantities[$index],
                    'ordered_quantity' => $orderedQty,
                    'delivered_quantity' => $deliveredQty,
                ];
            }
        }

        return [
            'lines' => $lines,
            'partial_delivery_marked' => $partialDeliveryMarked,
        ];
    }
}

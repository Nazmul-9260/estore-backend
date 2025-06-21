<?php

namespace Modules\Sales\Http\Controllers;
use Auth;
use App\Models\SaleOrder;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\Config;
use Modules\Sales\Entities\SalesOrder;
use Modules\Sales\Entities\SalesOrderDelivery;
use Toastr;
use Yajra\DataTables\DataTables;
use Modules\Config\Entities\Product;
use Modules\Sales\Entities\SalesOrderDeliveryLine;
use Modules\Sales\Entities\SalesOrderLine;

class SalesOrderController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('SalesOrder.admin')) {
            abort(403);
        }
        if ($request->ajax()) {
            $dataGrid = DB::table('sale_orders')
                ->select('sale_orders.*')
                ->leftJoin('customer_details', 'sale_orders.customer_id', '=', 'customer_details.customer_id')
                ->select('sale_orders.*', 'customer_details.name as customer_name')
                ->orderBy('sale_orders.id', 'desc')
                ->get();

            return DataTables::of($dataGrid)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                   $btn = '<div class="dynamic-btn col-1 m-0 pb-2">
                              <button class="f-button click-event"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                               <div class="dynamic-btn-wrap">
                                   <ul>
                                     <!--<li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i>View</a></li>-->
                                     <li><a class="editStatusData" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '"><i class="fa fa-pencil" aria-hidden="true"></i>Approve</a></li>
                                     <li><a class="deliverData" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" ><i class="fa fa-truck" aria-hidden="true"></i>Deliver</a></li>
                                     <!--<li><a class="deleteData" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" ><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>--> 
                                   
                                  </ul>
                                </div>
                            </div>';
                    return $btn;
                })
                ->editColumn('order_status', function ($dataGrid) {
                    return Config::where('value', $dataGrid->order_status)->where('type', 'order_status')->first()->name;
                })
                ->editColumn('payment_type_id', function ($dataGrid) {
                    return Config::where('value', $dataGrid->payment_type_id)->where('type', 'payment_type')->first()->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('sales::salesOrder.admin');
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('SalesOrder.delete')) {
            abort(403);
        }
        SalesOrder::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }

    public function getOrderStatusWithDropdownList(Request $request, $saleOrderId)
    {
        if (!Auth::user()->hasPermissionTo('SalesOrder.getOrderStatusWithDropdownList')) {
            abort(403);
        }
        $saleOrder = SaleOrder::where('id', $saleOrderId)->first();
        $saleOrderStatus = $saleOrder->order_status;
        $dropDownList = Config::lookupGetDropDownListWithSelected('order_status', $saleOrderStatus);
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $saleOrder->id,
                'dropdown_list' => $dropDownList
            ]
        ]);
    }

    public function updateOrderStatus(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('SalesOrder.updateOrderStatus')) {
            abort(403);
        }

        $saleOrder = SaleOrder::where('id', $request->data_id)->first();
        $saleOrder->order_status_updated_date = $request->order_status_updated_date;
        $saleOrder->order_status_updated_by = $request->user()->id;
        $saleOrder->order_status_updated_user_type = 'App\Models\User';
        $saleOrder->order_status = $request->order_status;
        $saleOrder->updated_at  = Carbon::now();
        $saleOrder->updated_by = $request->user()->id;
        $saleOrder->save();
        return response()->json([
            'success' => 'Sale Order Status Updated Successfully',
            'status_code' => 200,
            'data' => [
                'sale_order_details' => $saleOrder
            ]
        ], 200);
    }

    public function getDeliveryFormView(Request $request, $saleOrderId)
    {
        if (!Auth::user()->hasPermissionTo('SalesOrder.getDeliveryFormView')) {
            abort(403);
        }
        $salesOrder = SalesOrder::where('id', $saleOrderId)->first();

        $salesOrder->load(['salesOrderLines']);

        $view = view('sales::salesOrder.partials.deliveryFormView', ['salesOrder' => $salesOrder])->render();

        return response()->json([
            'status' => 'success',
            'message' => 'Delivery Form View Created',
            'data' => [
                'view' => $view
            ]
        ], 200);
    }

    public function deliver(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('SalesOrder.deliver')) {
            abort(403);
        }
        $orderId = $request->input('order_id');
        $deliveryDate = $request->input('delivery_date');
        $salesOrderLineIdList = $request->input('sale_order_line_id');
        $deliveryQuantityList = $request->input('delivery_quantity');

        /** Validation checkpoint */
        $markedAsDelivered = true;
        $salesOrderLinesList = SalesOrderLine::where('order_id', $orderId)->get();
        //return $salesOrderLinesList;
        foreach ($salesOrderLinesList as $k => $salesOrderLine) {
            $productQuantityOrdered =  $salesOrderLine->quantity;
            //return $productQuantityOrdered;
            $productQuantityDelivered = SalesOrderDeliveryLine::where('sale_order_line_id', $salesOrderLine->id)->sum('quantity');
            //return $productQuantityDelivered;
            $productQuantityToTransfer = $productQuantityOrdered -  $productQuantityDelivered;
            /** Marked as not delivered */
            if ($productQuantityDelivered < $productQuantityOrdered) {
                $markedAsDelivered = false;
            }
        }
        if ($markedAsDelivered) {
            return response()->json([
                'status' => 'error',
                'message' => 'All Products Already Delivered!',
            ], 400);
        }
        /** Check for date */
        $deliveryDateSet = false;

        if (!is_null($deliveryDate)) {
            $deliveryDateSet = true;
        }
        if (!$deliveryDateSet) {
            return response()->json([
                'status' => 'error',
                'message' => 'Has to set delivery date.',
            ], 400);
        }

        //** Check if one delivery quantity is greater than zero */
        $markedAsValidInputs = false;
        foreach ($deliveryQuantityList as $k => $deliveryQuantity) {
            if ($deliveryQuantity > 0) {
                $markedAsValidInputs  = true;
            }
        }
        if (!$markedAsValidInputs) {
            return response()->json([
                'status' => 'error',
                'message' => 'Has to deliver at least one product.',
            ], 400);
        }

        /**
         * DB write
         */

        $salesOrder = SalesOrder::where('id', $orderId)->first();
        $customerId = $salesOrder->customer_id;
        $deliveryAddressId = $salesOrder->delivery_address_id;
        $deliveredBy = Auth::user()->id; //** */
        $deliveredMedia = $request->input('delivery_media');
        $remarks = "Note: Delivery on date " . $deliveryDate; //** */
        $createdAt = Carbon::now();
        $createdBy = Auth::user()->id;

        /** Marked as not delivered, continue.. */
        $salesOrderDelivery = SalesOrderDelivery::create([
            'order_id' => $orderId,
            'delivery_date' => $deliveryDate,
            'customer_id' => $customerId,
            'delivery_address_id' => $deliveryAddressId,
            'delivered_by' => $deliveredBy,
            'delivered_media' => $deliveredMedia,
            'remarks' => $remarks,
            'created_at' => $createdAt,
            'created_by' => $createdBy
        ]);

        $salesOrderDeliveryLinesList = array();
        $partialDeliveryMarked = false;

        foreach ($salesOrderLineIdList as $k =>  $salesOrderLineId) {

            $salesOrderLine = SalesOrderLine::where('id', $salesOrderLineId)->first();
            $product = Product::where('id', $salesOrderLine->product_id)->first();
            /** Validation Per Order Line compared to Delivery Line  */
            $productQuantityOrdered = $salesOrderLine->quantity;
            $productQuantityDelivered = SalesOrderDeliveryLine::where('sale_order_line_id', $salesOrderLine->id)->sum('quantity');
            $productQuantityToTransfer = $productQuantityOrdered -  $productQuantityDelivered;
            /** Mutation */
            // if (is_null($deliveryQuantityList[$k])) {
            //     $deliveryQuantityList[$k] = 0;
            // }
            if ($deliveryQuantityList[$k] <= $productQuantityToTransfer && !is_null($deliveryQuantityList[$k])) {

                $salesOrderDeliveryLine = SalesOrderDeliveryLine::create([
                    'delivery_id' => $salesOrderDelivery->id,
                    'sale_order_line_id' => $salesOrderLineId,
                    'product_id' => $salesOrderLine->product_id,
                    'product_name' => $product->title,
                    'product_code' => $product->code,
                    'quantity' => $deliveryQuantityList[$k],
                    'created_at' => $createdAt,
                    'created_by' => $createdBy
                ]);
                $salesOrderDeliveryLinesList[] =  $salesOrderDeliveryLine;
            } else {
                $partialDeliveryMarked = true;
                $salesOrderDeliveryLinesList[] =  [
                    'message' => 'Delivery Failed for product ' . $product->title,
                    'requested_delivery_quantity' => $deliveryQuantityList[$k],
                    'ordered_quntity' => $productQuantityOrdered,
                    'delivered_quantity' =>  $productQuantityDelivered,
                ];
            }
            /**validation */
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Delivered',
            'data' => [
                'inputs' => $request->all(),
                'partial_delivery_marked' => $partialDeliveryMarked,
                'sales_order_delivery' => $salesOrderDelivery,
                'sales_order_delivery_lines' => $salesOrderDeliveryLinesList,

            ]
        ], 200);
    }

    public function deliverDocumentation(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('SalesOrder.deliverDocumentation')) {
            abort(403);
        }
        $orderId = $request->input('order_id');
        $deliveryDate = $request->input('delivery_date');
        $salesOrderLineIdList = $request->input('sale_order_line_id');
        $deliveryQuantityList = $request->input('delivery_quantity');

        /** Validation checkpoint */
        $markedAsDelivered = true;
        $salesOrderLinesList = SalesOrderLine::where('order_id', $orderId)->get();
        //return $salesOrderLinesList;
        foreach ($salesOrderLinesList as $k => $salesOrderLine) {
            $productQuantityOrdered =  $salesOrderLine->quantity;
            //return $productQuantityOrdered;
            $productQuantityDelivered = SalesOrderDeliveryLine::where('sale_order_line_id', $salesOrderLine->id)->sum('quantity');
            //return $productQuantityDelivered;
            $productQuantityToTransfer = $productQuantityOrdered -  $productQuantityDelivered;
            /** Marked as not delivered */
            if ($productQuantityDelivered < $productQuantityOrdered) {
                $markedAsDelivered = false;
            }
        }
        if ($markedAsDelivered) {
            return response()->json([
                'status' => 'error',
                'message' => 'All Products Already Delivered!',
            ], 400);
        }
        /** Check for date */
        $deliveryDateSet = false;

        if (!is_null($deliveryDate)) {
            $deliveryDateSet = true;
        }
        if (!$deliveryDateSet) {
            return response()->json([
                'status' => 'error',
                'message' => 'Has to set delivery date.',
            ], 400);
        }

        //** Check if one delivery quantity is greater than zero */
        $markedAsValidInputs = false;
        foreach ($deliveryQuantityList as $k => $deliveryQuantity) {
            if ($deliveryQuantity > 0) {
                $markedAsValidInputs  = true;
            }
        }
        if (!$markedAsValidInputs) {
            return response()->json([
                'status' => 'error',
                'message' => 'Has to deliver at least one product.',
            ], 400);
        }

        /**
         * DB write
         */

        $salesOrder = SalesOrder::where('id', $orderId)->first();
        $customerId = $salesOrder->customer_id;
        $deliveryAddressId = $salesOrder->delivery_address_id;
        $deliveredBy = Auth::user()->id; //** */
        $deliveredMedia = $request->input('delivery_media');
        $remarks = "Note: Delivery on date " . $deliveryDate; //** */
        $createdAt = Carbon::now();
        $createdBy = Auth::user()->id;

        /** Marked as not delivered, continue.. */
        $salesOrderDelivery = SalesOrderDelivery::create([
            'order_id' => $orderId,
            'delivery_date' => $deliveryDate,
            'customer_id' => $customerId,
            'delivery_address_id' => $deliveryAddressId,
            'delivered_by' => $deliveredBy,
            'delivered_media' => $deliveredMedia,
            'remarks' => $remarks,
            'created_at' => $createdAt,
            'created_by' => $createdBy
        ]);

        $salesOrderDeliveryLinesList = array();
        $partialDeliveryMarked = false;

        foreach ($salesOrderLineIdList as $k =>  $salesOrderLineId) {

            $salesOrderLine = SalesOrderLine::where('id', $salesOrderLineId)->first();
            $product = Product::where('id', $salesOrderLine->product_id)->first();
            /** Validation Per Order Line compared to Delivery Line  */
            $productQuantityOrdered = $salesOrderLine->quantity;
            $productQuantityDelivered = SalesOrderDeliveryLine::where('sale_order_line_id', $salesOrderLine->id)->sum('quantity');
            $productQuantityToTransfer = $productQuantityOrdered -  $productQuantityDelivered;
            /** Mutation */
            // if (is_null($deliveryQuantityList[$k])) {
            //     $deliveryQuantityList[$k] = 0;
            // }
            if ($deliveryQuantityList[$k] <= $productQuantityToTransfer && !is_null($deliveryQuantityList[$k])) {

                $salesOrderDeliveryLine = SalesOrderDeliveryLine::create([
                    'delivery_id' => $salesOrderDelivery->id,
                    'sale_order_line_id' => $salesOrderLineId,
                    'product_id' => $salesOrderLine->product_id,
                    'product_name' => $product->title,
                    'product_code' => $product->code,
                    'quantity' => $deliveryQuantityList[$k],
                    'created_at' => $createdAt,
                    'created_by' => $createdBy
                ]);
                $salesOrderDeliveryLinesList[] =  $salesOrderDeliveryLine;
            } else {
                $partialDeliveryMarked = true;
                $salesOrderDeliveryLinesList[] =  [
                    'message' => 'Delivery Failed for product ' . $product->title,
                    'requested_delivery_quantity' => $deliveryQuantityList[$k],
                    'ordered_quntity' => $productQuantityOrdered,
                    'delivered_quantity' =>  $productQuantityDelivered,
                ];
            }
            /**validation */
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Delivered',
            'data' => [
                'inputs' => $request->all(),
                'partial_delivery_marked' => $partialDeliveryMarked,
                'sales_order_delivery' => $salesOrderDelivery,
                'sales_order_delivery_lines' => $salesOrderDeliveryLinesList,

            ]
        ], 200);
    }
}

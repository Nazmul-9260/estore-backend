<?php

namespace Modules\Accounting\Http\Controllers;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Entities\SalesOrder;
use App\Models\Customer;
use Modules\Accounting\Entities\PaymentReceive;
use Modules\Accounting\Http\Requests\PaymentReceiveRequest;
use Carbon\Carbon;

class PaymentReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('PaymentReceive.admin')) {
            abort(403);
        }
        // return view('accounting::index');

        if ($request->ajax()) {
            $customerIdList = SalesOrder::query()->where('is_full_paid', 2)->distinct()->pluck('customer_id');
            // return $customerIdList;
            $customers = Customer::query()->whereIn('id', $customerIdList)->get();
            $customers->load(['customerDetails']);
            // return $customers;
            return Datatables::of($customers)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dynamic-btn col-1 m-0 pb-2">
                              <button class="f-button click-event"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                               <div class="dynamic-btn-wrap">
                                   <ul>
                                     <!--<li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i>View</a></li>-->
                                     <li><a class="createMrBtn" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '"><i class="fa fa-pencil" aria-hidden="true"></i>Create MR</a></li>
                                     <!--<li><a class="deliverData" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" ><i class="fa fa-truck" aria-hidden="true"></i>Deliver</a></li>-->
                                     <!--<li><a class="deleteData" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" ><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>--> 
                                   
                                  </ul>
                                </div>
                            </div>';
                    return $btn;
                })->rawColumns(['action'])
                ->make(true);
        }
        // $customerIdList = SalesOrder::query()->distinct()->pluck('customer_id');
        // $customers = Customer::query()->whereIn('id', $customerIdList)->get();
        // $customers->load(['customerDetails']);
        // return $customers;
        return view('accounting::paymentReceive.admin');
    }

    public function getPaymentReceiveFormView($customerId)
    {
        if (!Auth::user()->hasPermissionTo('PaymentReceive.getPaymentReceiveFormView')) {
            abort(403);
        }
        // $salesOrder = SalesOrder::where('id', 1)->first();

        // $salesOrder->load(['salesOrderLines']);

        // $view = view('accounting::paymentReceive.partials.paymentReceiveFormView', ['salesOrder' => $salesOrder])->render();

        $customer = Customer::query()->where('id', $customerId)->first();

        $customer->load(['salesOrders' => function ($query) {
            return $query->where('is_full_paid', 2);
        }, 'customerDetails']);

        $view = view('accounting::paymentReceive.partials.paymentReceiveFormView', ['customer' => $customer])->render();


        return response()->json([
            'status' => 'success',
            'message' => 'Delivery Form View Created',
            'data' => [
                'view' => $view,
                'customer' => $customer
            ]
        ], 200);
    }

    public function storePaymentReceive(PaymentReceiveRequest $request)
    {

        if (!Auth::user()->hasPermissionTo('PaymentReceive.storePaymentReceive')) {
            abort(403);
        }

        // return response()->json([
        //     'data' => $request->all()
        // ], 200);

        $orderIdList = $request->input('order_id');
        $paymentAmountList = $request->input('payment_amount');
        $discountAmountList = $request->input('discount_amount');
        $remainingAmountList = $request->input('remaining_amount');
        $maxSlNo = PaymentReceive::max('max_sl_no');
        if (is_null($maxSlNo)) {
            $maxSlNo = 1;
        } else {
            $maxSlNo += 1;
        }
        $year = date('Y');
        $mrNo = $maxSlNo . '/' .  $year;
        $successfulPaymentReceipts = array();
        $salesOrdersFullPaid = array();
        foreach ($orderIdList as $k => $orderId) {
            if (is_null($paymentAmountList[$k])) {
                continue;
            }
            $paymentReceive = new PaymentReceive();
            $paymentReceive->order_id = $orderId;
            $paymentReceive->max_sl_no = $maxSlNo;
            $paymentReceive->mr_no = $mrNo;
            $paymentReceive->payment_method = $request->input('receive_type'); // verify
            $paymentReceive->payment_amount = $paymentAmountList[$k];
            if (!is_null($discountAmountList[$k])) {
                $paymentReceive->discount_amount = $discountAmountList[$k];
            }
            $paymentReceive->payment_datetime = Carbon::now();
            $paymentReceive->mr_no = $mrNo;
            $paymentReceive->payment_status = 1; // Verify
            $paymentReceive->receive_type = $request->input('receive_type');
            $paymentReceive->manual_mr_no = $request->input('manual_mr_no');
            $paymentReceive->received_by = $request->input('received_by');
            if ($request->has('is_advance_payment')) {
                $paymentReceive->is_advance_payment = $request->input('is_advance_payment');
            }
            if ($request->has('bank_name')) {
                $paymentReceive->bank_name = $request->input('bank_name');
            }
            if ($request->has('account_name')) {
                $paymentReceive->account_name = $request->input('account_name');
            }
            if ($request->has('cheque_no')) {
                $paymentReceive->cheque_no = $request->input('cheque_no');
            }
            if ($request->has('cheque_date')) {
                $paymentReceive->cheque_date = $request->input('cheque_date');
            }
            $paymentReceive->created_at = Carbon::now();
            $paymentReceive->created_by = $request->user()->id;
            $paymentReceive->save();
            $successfulPaymentReceipts[] = $paymentReceive;
            // Update Full Paid in Sales Order
            $salesOrder = SalesOrder::where('id', $orderId)->first();
            $grandTotal = $salesOrder->grand_total;
            $paidAmountSum = PaymentReceive::where('order_id', $orderId)->get()->sum('payment_amount');
            $discountAmountSum = PaymentReceive::where('order_id', $orderId)->get()->sum('discount_amount');
            $dueAmountSum = $grandTotal - $paidAmountSum - $discountAmountSum - $paymentReceive->payment_amount;
            if (!is_null($discountAmountList[$k])) {
                $dueAmountSum -= $paymentReceive->discount_amount;
            }
            if (!($dueAmountSum > 0)) {
                $salesOrder->is_full_paid = 1;
                $salesOrder->save();
                $salesOrdersFullPaid[] = $salesOrder;
            }
            // Update Full Paid in Sales Order 
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Payment receipt approved into system',
            'data' => [
                'payment_receipts' => $successfulPaymentReceipts,
                'full_paid_sales_orders' => $salesOrdersFullPaid
            ]
        ]);
    }
}

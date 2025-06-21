<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
 
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;

use App\Http\Resources\CustomerResource;
// use Illuminate\Support\Facades\DB;
use Modules\Cms\Entities\CmsMenu;
use Modules\Cms\Entities\SiteInfo;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\CustomerAddress;
use Modules\Config\Entities\Config;
use Modules\Config\Entities\Product;
use Modules\Config\Entities\ProductCategory;
use App\DTO\AddressTypeResponseDto;
use App\Models\SaleOrder;
use App\Models\SaleOrderLine;
use App\Models\Payment;
use App\Models\PaymentLog;
use Exception;
use App\Http\Requests\Api\ConfirmOrderApiRequest;
use App\Models\CustomerDetails;
use App\Services\MailService;
use Illuminate\Support\Facades\Log;





class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }
   
    public function payViaAjaxApi(ConfirmOrderApiRequest $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
       
        try {

            /*
            * Insert Sales Order
            */
            $customer = $request->user();
            $delivery_addr_id = $request->input('delivery_address_id');
            $unique_transaction_id = uniqid();
            // return response()->json($customer , 200);
            // Log::error(print_r($query)); 
            DB::enableQueryLog();
            $saleOrder = SaleOrder::create([
                'order_date' => date('Y:m:d'),
                'customer_id' => $customer->id??'',
                'order_status' => 1??'',
                'discount_percentage' => $request->input('discount_percentage')??'',
                'total_discount' => $request->input('total_discount')??'',
                'vat_percentage' => $request->input('vat_percentage')??'',
                'order_amount' => $request->input('order_amount')??'',
                'total_vat' => $request->input('total_vat')??'',
                'grand_total' => $request->input('grand_total')??'',
                'delivery_charge' => $request->input('delivery_charge')??'',
                'bill_address_id' => $request->input('bill_address_id')??'',
                'payment_type_id' => $request->input('payment_type_id')??'',
                // 'delivery_address_id' =>$delivery_addr_id['customer_address_id']??'',
                'delivery_address_id' =>$request->input('delivery_address_id')??'',
                'remarks' => $request->input('remarks')??'',
                'created_by' => $customer->id??''
            ]); 
            // return response()->json(DB::getQueryLog(), 200);
            // return response()->json($saleOrder, 200);

            /*
            * Last Sales ID created in database 
            */
            $saleOrderId = $saleOrder->id;
            

            /*
            * Insert Sales Order Line
            */
            $orderLines = $request->input('order_lines');
            $placedSaleOrderLines = [];
            $productsName = [];
            foreach ($orderLines as $orderLine) {
                $orderLineProduct = Product::where('id', $orderLine['product_id'])->first();
                $productsName[] = $orderLineProduct->title;
                $orderLineProductCat = ProductCategory::where('id', $orderLineProduct['category_id'])->first();
                                
                $saleOrderLine = SaleOrderLine::create([
                    'order_id' => $saleOrderId,
                    'product_id' => $orderLineProduct->id,
                    'product_name' => $orderLineProduct->title,
                    'product_code' => $orderLineProduct->code,
                    'quantity' => $orderLine['quantity'],
                    'unit_price' => $orderLine['unit_price'],
                    'unit_amount' => $orderLine['quantity'] * $orderLine['unit_price'],
                    'discount_percentage' => $orderLine['discount_percentage'],
                    'is_offer_product' => $orderLine['is_offer_product'] == 'false' ? 0 : 1,
                    'is_gift_product' => $orderLine['is_gift_product'] == 'false' ? 0 : 1,
                    'created_by' => $customer->id
                ]);
                $placedSaleOrderLines[] = $saleOrderLine;
            }
            // return response()->json($orderLineProductCat, 200);  
            // return response()->json($saleOrder, 200);
                 
            
            /*
             * Customer Details Insert
            */
            if ($saleOrder->id) {                
                $customerDetails = CustomerDetails::where('customer_id', $customer->id)->first();
                $customerDetailsModified = false;
                // return response()->json($customerDetails, 200);

                if ($request->has(['customer_name', 'email', 'mobile_number'])) {
                    if ($customerDetails) {
                        $customerDetails->name = $request->customer_name;
                        $customerDetails->email = $request->email;
                        $customerDetails->phone = $request->mobile_number;
                        $customerDetailsModified  = true;
                    } else {
                        $customerDetails =  CustomerDetails::create([
                            'customer_id' => $customer->id,
                            'name' => $request->customer_name,
                            'email' => $request->email,
                            'phone' => $request->mobile_number,
                            'created_by' => $customer->id
                        ]);
                    }
                    if ($customerDetailsModified) {
                        $customerDetails->save();
                    }
                }                

            }


            /*
            * Payment Log Insert
            */
            $orderPaymentLog = PaymentLog::create([
                'order_id' => $saleOrderId,
                'max_sl_no' => 1??'',
                'mr_no' => "MR-".date('YmdHis'),
                'transaction_id' => $unique_transaction_id,
                'payment_method' => 2,
                'payment_amount' => $request->input('total_payment')?? 0.00,
                'discount_amount' => $request->input('total_discount')??'',
                'payment_datetime' => date('Y:m:d H:i:s'),
                'payment_status' => 0,
                'more_details' => $request->input('remarks')??'',
                'receive_type' => 1,
                'manual_mr_no' => date('YmdHis'),
                'received_by' => "Automated",
                'bank_name' => NULL,
                'account_name' => NULL,
                'cheque_no' => NULL,
                'cheque_date' => NULL,                
                'payment_log_status' => 0,                
                'posting_status' => 0,                
                'created_by' => $customer->id??'',
                'created_at' => date('Y:m:d H:i:s')
            ]); 
            

            /*
            * Send Email Notification
            */
            $success = MailService::sendOrderConfirmation($customer->id);
            if ($success === true) {
                $confirmationMailSent = true;
            } else {
                $confirmationMailSent = $success;
            }

                            
            /**
             * Payment
             */           
            $bill_address_id = $request->input('bill_address_id');
            $delivery_address_id = $request->input('delivery_address_id'); 
          
            $customerBillAddress1 = CustomerAddress::where('id', $bill_address_id)->first();
            $customerDeliveryAddress1 = CustomerAddress::where('id', $delivery_address_id)->first();
            // return response()->json($customerDeliveryAddress1['deliver_to'], 200);

            $post_data = array();
            $post_data['total_amount'] = $request->input('total_payment');  //$request->input('grand_total'); # You cant not pay less than 10
            $post_data['currency'] =  $request->input('currency');
            $post_data['tran_id'] = $unique_transaction_id; // tran_id must be unique

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $request->customer_name;
            $post_data['cus_email'] = $request->email;
            $post_data['cus_add1'] = $customerBillAddress1['deliver_to'];
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = $customerBillAddress1['dist'];
            $post_data['cus_state'] = $customerBillAddress1['state'];
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = $customerBillAddress1['country'];
            $post_data['cus_phone'] = $request->mobile_number;
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = $request->customer_name;
            $post_data['ship_add1'] = $customerDeliveryAddress1['deliver_to'];
            $post_data['ship_add2'] = "";
            $post_data['ship_city'] = $customerDeliveryAddress1['dist'];
            $post_data['ship_state'] = $customerDeliveryAddress1['state'];
            $post_data['ship_postcode'] = "";
            $post_data['ship_phone'] = $request->mobile_number;
            $post_data['ship_country'] = $customerDeliveryAddress1['country'];
           
            $post_data['shipping_method'] = "NO";
            
            $post_data['product_name'] = implode(',',$productsName);
            $post_data['product_category'] = $orderLineProductCat['title'];
            $post_data['product_profile'] = "physical-goods";

            # OPTIONAL PARAMETERS
            // $post_data['value_a'] = "ref001";
            // $post_data['value_b'] = "ref002";
            // $post_data['value_c'] = "ref003";
            // $post_data['value_d'] = "ref004";

            $post_data['value_a'] = $unique_transaction_id;
            $post_data['value_b'] = $customer->id??'';
            $post_data['value_c'] = $saleOrderId;
            $post_data['value_d'] = "ref004";

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');
          
            return response()->json($payment_options, 200); 
                                

        } catch (Exception $e) {
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);

        }


       
    }


    public function success(Request $request)
    {
        
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $transaction_id = $request->input('value_a');
        $customer_id = $request->input('value_b');
        $order_id = $request->input('value_c');

        //orderSuccess
        // return response()->json($request, 200);
        // return redirect()->away('http://localhost:3000/orderSuccess');


        /* 
        * Payment Insert 
        */
        $orderPayment = Payment::create([
            'order_id' => $order_id,  //$saleOrderId,
            'max_sl_no' => 1??'',
            'mr_no' => "MR-".date('YmdHis'),
            'transaction_id' => $tran_id, //$unique_transaction_id,
            'payment_method' => 2,
            'payment_amount' => $amount, //$request->input('total_payment')?? 0.00,
            'discount_amount' => null, //$request->input('total_discount')??'',
            'payment_datetime' => date('Y:m:d H:i:s'),
            'payment_status' => 1,
            'more_details' => null, //$request->input('remarks')??'',
            'receive_type' => 1,
            'manual_mr_no' => date('YmdHis'),
            'received_by' => "Automated",
            'bank_name' => NULL,
            'account_name' => NULL,
            'cheque_no' => NULL,
            'cheque_date' => NULL,                
            'created_by' => $customer_id, //$customer->id??'',
            'created_at' => date('Y:m:d H:i:s')
        ]); 
        
        
        #Check order status in order tabel against the transaction id or order id.
        /*
        $order_details = DB::table('orders')
        ->where('transaction_id', $tran_id)
        ->select('transaction_id', 'status', 'currency', 'amount')->first();
        */
        
        $payment_details = DB::table('payment_log')
        ->where('transaction_id', $tran_id)
        ->select('transaction_id', 'payment_status', 'payment_amount')->first();
                
        
        if ($payment_details->payment_status == 0) {
           
            $sslc = new SslCommerzNotification();
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {

                // return response()->json('success', 200);

                // return response()->json([
                //     'status' => 'success',
                //     'message' => 'Order placed successfully',
                //     'data' => [
                //         'sale_order_details' => [
                //             'order' => '', //$saleOrder,
                //             'order_lines' => ''   //$placedSaleOrderLines
                //         ]
                //     ]
                // ], 201);

                // $payment_options['data'] = "orderSuccess";
                $payment_options = "orderSuccess";
                // return redirect()->away('http://store.scldev.com:8083/orderSuccess');
                // return response()->json($payment_options, 200); 
                return redirect()->route('sslpay.redirectSFront');
                // redirect()->to('http://store.scldev.com:8083/orderSuccess')->send();


                // return redirect()->away('http://localhost:3000/plans/payment/success'); 


                //orderSuccess
                // return response()->json($request, 200);
                // return redirect()->away('http://localhost:3000/orderSuccess');


                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                /*
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
                */
            }

            
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
             /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */

        
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }
      


    }


    public function redirectSFront(Request $request)
    {
        $payment_options = "orderSuccess";
        return redirect()->away('http://store.scldev.com:8083/orderSuccess');
        // return response()->json($payment_options, 200); 


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}

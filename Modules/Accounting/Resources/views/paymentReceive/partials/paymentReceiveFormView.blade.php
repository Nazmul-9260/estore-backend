<style>
    .table-display-form tr td {
        padding: 5px;
    }

    .table-display-form tr th {
        font-weight: bold;
        padding: 5px;
    }

    .tag {
        padding: 5px;
        background-color: skyblue;
        border-radius: 5px;
        font-weight: bold;
    }
</style>

<div>
    <div class="modal max-width-1200 fade modal-redesign" id="ajaxModalPaymentReceiveFormView" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card">
                <div class="card-header">
                    <h5 id="modelHeadingUpdate"> <i class="fa fa-info-circle" aria-hidden="true"></i> Payment Receive From {{ $customer->customerDetails->name}}</h5>
                    <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="times-25px">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="paymentReceiveDataFormUpdate" name="paymentReceiveDataFormUpdate" class="form-horizontal">


                        <input type="hidden" name="customer_id" value="{{$customer->id}}">
                        <input type="hidden" name="data_id" id="data_id">

                        <!-- <div class="row m-0 pb-3">
                            <div class="form-group col-6 pr-2">
                                <label for="delivery_date" class="w-100 control-label">Delivery Date<span class="text-danger">*</span></label>
                                <div class="w-100">
                                    <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                                </div>
                            </div>


                            <div class="form-group col-6 pl-2">
                                <label for="name" class="w-100 control-label">Delivery Media</label>
                                <div class="w-100">
                                    <select name="delivery_media" class="form-control" id="delivery_media">
                                        @php
                                        echo \Modules\Config\Entities\Config::lookupGetDropDownList('delivery_media');
                                        @endphp
                                    </select>
                                </div>
                            </div>

                        </div> -->


                        <div class="row m-0 pb-0">
                            <div class="form-group col-3 d-none">
                                <label for="customer_name" class="w-100 control-label">Party Name<span class="text-danger">*</span></label>
                                <div class="w-100">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{$customer->customerDetails->name}}" required>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="receive_date" class="w-100 control-label">Receive Date<span class="text-danger">*</span></label>
                                <div class="w-100">
                                    <input type="date" class="form-control" id="receive_date" name="receive_date" value="{{date('Y-m-d')}}" required>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="received_by" class="w-100 control-label">Received By<span class="text-danger">*</span></label>
                                <div class="w-100">
                                    <input type="text" class="form-control" id="received_by" name="received_by" required>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="customer_name" class="w-100 control-label">Manual MR No<span class="text-danger">*</span></label>
                                <div class="w-100">

                                    <input type="text" class="form-control" id="customer_name" name="manual_mr_no" required>

                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="receive_type" class="w-100 control-label">Receive Type<span class="text-danger">*</span></label>
                                <div class="w-100">
                                    <select name="receive_type" class="form-control" id="receive_type">
                                        @php
                                        echo \Modules\Config\Entities\Config::lookupGetDropDownList('payment_receive_type');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 pb-3">
                            <div class="form-group col-3">
                                <label for="cheque_no" class="w-100 control-label">Cheque No</label>
                                <div class="w-100">
                                    <input type="text" class="form-control" id="cheque_no" name="cheque_no" required>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="bank_name" class="w-100 control-label">Bank Name</label>
                                <div class="w-100">
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label for="account_name" class="w-100 control-label">Bank A/C Name</label>
                                <div class="w-100">
                                    <input type="text" class="form-control" id="account_name" name="account_name" required>
                                </div>
                            </div>
        
                            <div class="form-group col-3">
                                <label for="cheque_date" class="w-100 control-label">Cheque Date</label>
                                <div class="w-100">
                                    <input type="date" class="form-control" id="cheque_date" name="cheque_date" value="{{date('Y-m-d')}}" required>
                                </div>
                            </div>
                            

                            <!-- <div class="form-group col-6 pr-2">
                                <label></label>
                                <div class="w-100">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="1" name="is_advance_payment">
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Is Advance Payment</span>
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                        </div>




                        <div class="form-group col-12">

                            @if(count($customer->salesOrders)>0)
                            @php
                            $totalBillAmount = 0;
                            $totalPaidAmount = 0;
                            $totalDiscountAmount = 0;
                            $totalDueAmount = 0;
                            @endphp
                            <table class="table table-bordered table-display-form">
                                <tr>
                                    <th>SL.</th>
                                    <th width="170px">Bill No</th>
                                    <th width="150px">Bill Amount</th>
                                    <th width="120px">Paid</th>
                                    <th width="120px">Discounts</th>
                                    <th width="140px">Due Amount</th>
                                    <th width="140px">Receive Amount</th>
                                    <th width="100px">Discount</th>
                                    <th width="150px">Remaining Amount</th>
                                </tr>
                                @foreach($customer->salesOrders as $sl => $salesOrder)
                                @php
                                $paidAmount = \Modules\Accounting\Entities\PaymentReceive::where('order_id', $salesOrder->id)->get()->sum('payment_amount');
                                $discountAmount = \Modules\Accounting\Entities\PaymentReceive::where('order_id', $salesOrder->id)->get()->sum('discount_amount');
                                $dueAmount = $salesOrder->grand_total - $paidAmount - $discountAmount;
                                if($dueAmount > 0)
                                {
                                $totalBillAmount += $salesOrder->grand_total;
                                $totalPaidAmount += $paidAmount;
                                $totalDiscountAmount += $discountAmount;
                                $totalDueAmount += $dueAmount;
                                }
                                $alreadyPaidAmount = 0;
                                $remainingAmount = $salesOrder->grand_total - $alreadyPaidAmount;
                                $demoAmount1 = 100;
                                $demoAmount2 = 200;
                                @endphp
                                <!-- BDT (&#2547;) -->
                                @if($dueAmount > 0)
                                <tr>
                                    <input type="hidden" name="order_id[]" value="{{$salesOrder->id}}">
                                    <td>{{$sl+1}}</td>
                                    <td width="170px">INV-SCL-{{$salesOrder->id}}</td>
                                    <td width="150px" class="grand_amount">{{$salesOrder->grand_total}}</td>
                                    <td width="120px"class="paid_amount">{{$paidAmount}}</td>
                                    <td width="120px" class="discounts_applied">{{$discountAmount}}</td>
                                    <td width="140px"class="due_amount">{{$dueAmount}}</td>
                                    @if($dueAmount > 0)
                                    <td width="140px"><input type="number" class="payment_amount form-control" max="{{$dueAmount}}" name="payment_amount[]"> </td>
                                    <td width="120px"><input type="number" class="discount_amount form-control" name="discount_amount[]"> </td>
                                    <td width="150px"><input type="number" class="remaining_amount form-control" name="remaining_amount[]"> </td>
                                    @else
                                    <td class="text-center" style="font-weight: bold;">Full Paid
                                    </td>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-center" style="font-weight: bold">Total</td>
                                    <td class="bill_amount_sum">{{$totalBillAmount}} (&#2547;)</td>
                                    <td class="paid_amount_sum">{{$totalPaidAmount}} (&#2547;)</td>
                                    <td class="discount_amount_sum">{{$totalDiscountAmount}} (&#2547;)</td>
                                    <td class="due_amount_sum">{{$totalDueAmount}} (&#2547;)</td>
                                    <td class="payment_amount_sum">0</td>
                                    <td class="discount_amount_sum">0</td>
                                    <td class="remaining_amount_sum">0</td>
                                    <input type="hidden" name="bill_amount_sum_val" id="bill_amount_sum_val">
                                    <input type="hidden" name="due_amount_sum_val" id="due_amount_sum_val">
                                    <input type="hidden" name="payment_amount_sum_val" id="payment_amount_sum_val">
                                    <input type="hidden" name="discount_amount_sum_val" id="discount_amount_sum_val">
                                    <input type="hidden" name="remaining_amount_sum_val" id="remaining_amount_sum_val">

                                </tr>
                                <!-- <tr>
                                    <td colspan="2" class="text-center">Note:</td>
                                    <td colspan="5"> </td>
                                </tr> -->

                            </table>
                            @else
                            <p>No Sales Order Payment Due</p>
                            @endif

                        </div>




                        <div class="col-sm-offset-2 w-100 col-12">
                            <button type="submit" class="btn btn-primary btn-sm" id="paymentReceiveDataSubmitBtn" value="create">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>
    $(document).ready(function() {
        console.log('partials js loaded.')

    })
</script>

@endpush
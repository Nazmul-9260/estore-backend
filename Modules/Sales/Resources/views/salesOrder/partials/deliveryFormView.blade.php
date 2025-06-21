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
    <div class="modal max-width-900 fade modal-redesign" id="ajaxModalDeliveryFormView" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card">
                <div class="card-header">
                    <h5 id="modelHeadingUpdate"> <i class="fa fa-info-circle" aria-hidden="true"></i> Sales Order No ##{{ $salesOrder->id}}</h5>
                    <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="times-25px">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deliverDataFormUpdate" name="dataFormUpdate" class="form-horizontal">

                        <!-- <div class="form-group col-12">
                            <label for="name" class="w-100 control-label">Status</label>
                            <div class="w-100">
                                <select name="order_status" class="form-control" id="status2">
                                    @php
                                    echo \Modules\Config\Entities\Config::lookupGetDropDownListWithSelected('order_status', $salesOrder->order_status);
                                    @endphp
                                </select>
                            </div>
                        </div> -->

                        <input type="hidden" name="order_id" value="{{$salesOrder->id}}">
                        <input type="hidden" name="data_id" id="data_id">

                        <div class="row m-0 pb-3">
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

                        </div>




                        <div class="form-group col-12">
                            <h6 style="text-align: center;"> <i class="fa fa-info-circle" aria-hidden="true"></i> Order Details</h6>
                            <table class="table table-bordered table-display-form">
                                <tr>
                                    <th>Customer Identity</th>
                                    <th>Order No</th>
                                    <th>Order Date</th>
                                    <th>Grand Total</th>
                                </tr>
                                <tr>
                                    <td>{{$salesOrder->customer->user_id}}</td>
                                    <td>{{'## '.$salesOrder->id}}</td>
                                    <td>{{$salesOrder->order_date}}</td>
                                    <td>{{$salesOrder->grand_total}} BDT (&#2547;)</td>
                                </tr>
                            </table>
                            <h6 style="text-align: center;"><i class="fa fa-info-circle" aria-hidden="true"></i> Order Products</h6>
                            @if(count($salesOrder->salesOrderLines)>0)
                            <table class="table table-bordered table-display-form">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Code/SKU</th>
                                    <th>Quantity Ordered</th>
                                    <th>Unit Price</th>
                                    <th>Quantity Delivered</th>
                                    <th>Delivery Quantity</th>
                                </tr>
                                @foreach($salesOrder->salesOrderLines as $salesOrderLine)
                                @php
                                $productQuantityOrdered = $salesOrderLine->quantity;
                                $productQuantityDelivered = \Modules\Sales\Entities\SalesOrderDeliveryLine::where('sale_order_line_id', $salesOrderLine->id)->sum('quantity');
                                $productQuantityToTransfer = $productQuantityOrdered - $productQuantityDelivered;
                                @endphp
                                <tr>
                                    <td>{{$salesOrderLine->product_name}}</td>
                                    <td>{{$salesOrderLine->product_code}}</td>
                                    <td>{{$salesOrderLine->quantity}}</td>
                                    <td>{{$salesOrderLine->unit_price}} BDT (&#2547;)</td>
                                    <td>{{$productQuantityDelivered}}</td>
                                    @if($productQuantityDelivered < $productQuantityOrdered)
                                        <td>
                                        <input type="hidden" name="sale_order_line_id[]" value="{{$salesOrderLine->id}}">
                                        <input type="number" style="background-color: #D8D9D2; padding:5px; border:1px solid #A79D7C; border-radius:5px" name="delivery_quantity[]" max="{{$productQuantityToTransfer}}">
                                        </td>
                                        @else
                                        <td>
                                            <p class="tag"><i class="fa fa-truck" aria-hidden="true"></i> <b>Deliverey Completed</b></p>
                                        </td>
                                        @endif
                                </tr>
                                @endforeach
                            </table>
                            @else
                            <p>No Products Ordered</p>
                            @endif

                        </div>




                        <div class="col-sm-offset-2 w-100 col-12">
                            <button type="submit" class="btn btn-primary btn-sm" id="deliverDataBtn" value="create">Save
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
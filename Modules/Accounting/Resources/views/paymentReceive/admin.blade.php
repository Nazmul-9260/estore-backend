@extends('layouts.master')
@section('content')
<div class="container-fluid category-area">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h5>View All Sales Order Customers</h5>
                </div>
                <div class="card-body">
                    {{-- <a class="btn btn-success" href="javascript:void(0)" id="showForm"> <i class="fas fa-plus"></i> </a> --}}
                    <style>
                        tfoot {
                            display: table-header-group !important;
                        }
                    </style>
                    <div class="table-responsive--">
                        <table class="table table-hover table-bordered data-table dataTable-store">

                            <thead>
                                <tr>
                                    <th width="80px">Sl No</th>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="col-action" style="width: 150px">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="80px">Sl No</th>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="col-action" style="width: 150px">Action</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Status Modal/ Approve -->

<div class="modal fade max-300 modal-redesign" id="ajaxModalStatusDataUpdate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card">
            <div class="card-header">
                <h5 id="modelHeadingUpdate"></h5>
                <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="times-25px">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dataFormUpdate" name="dataFormUpdate" class="form-horizontal">
                    <input type="hidden" name="data_id" id="data_id">
                    <div class="form-group col-12">
                        <label for="order_status_updated_date" class="w-100 control-label">Date<span class="text-danger">*</span></label>
                        <div class="w-100">
                            <input type="date" class="form-control" id="order_status_updated_date" name="order_status_updated_date" required>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="name" class="w-100 control-label">Status</label>
                        <div class="w-100">
                            <select name="order_status" class="form-control" id="status2">



                            </select>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 w-100 col-12">
                        <button type="submit" class="btn btn-primary btn-sm" id="updateStatusDataBtn" value="create">Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delivery -->

<div id="paymentReceiveFormContainer">

</div>




<style>
    .toolbar {
        float: right;
        margin-left: 10px
    }
</style>
@endsection


@push('scripts')

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Start View Data
        $('.data-table').DataTable({
            language: {
                paginate: {
                    next: '&#8594;', // or '→'
                    previous: '&#8592;' // or '←'
                }
            },
            processing: true,
            serverSide: true,
            //for pagination
            paging: true,
            pageLength: 10,

            iDisplayLength: 25,
            aaSorting: [
                ['0', 'desc']
            ],
            dom: '<"toolbar">frtip',

            ajax: "{{url('accounting/salesOrder/payment-receive/admin')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'customer_details.name',
                    name: 'customer_details.name'
                },
                {
                    data: 'customer_details.email',
                    name: 'customer_details.email'
                },
                {
                    data: 'customer_details.phone',
                    name: 'customer_details.phone'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            initComplete: function() {
                this.api().columns([1, 2, 3]).every(function() {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                });
            }
        });

        // $('body').on('click', '.editStatusData', function() {
        //     var dataId = $(this).data('id');
        //     $.get("{{ url('sales/salesOrder/get-order-status-dropdown-list') }}" + '/' + dataId, function(data) {
        //         console.log(data);
        //         $('#data_id').val(data.data.id);
        //         $('#modelHeadingUpdate').html("Edit Unit");
        //         $('#updateBtn').val("edit-unit");
        //         $('#ajaxModalStatusDataUpdate').modal('show');
        //         // $('#title2').val(data.data.title);
        //         $('#status2').html(data.data.dropdown_list);
        //     })
        // });

        // $('#updateStatusDataBtn').click(function(e) {
        //     e.preventDefault();
        //     $(this).html('Updating..');
        //     $.ajax({
        //         data: $('#dataFormUpdate').serialize(),
        //         url: "{{ url('sales/salesOrder/update-order-status') }}",
        //         type: "POST",
        //         dataType: 'json',
        //         success: function(data) {
        //             console.log(data);
        //             $('#dataFormUpdate').trigger("reset");
        //             $('#ajaxModalStatusDataUpdate').modal('hide');
        //             $('.dataTable').DataTable().ajax.reload(null, false);
        //             $('#updateStatusDataBtn').html('Update');
        //         },
        //         error: function(err) {
        //             console.log('Error:', err);
        //             $('#saveBtn').html('Save');
        //         }
        //     });
        // });

        // Payment Receipt

        $('body').on('click', '.createMrBtn', function() {
            console.log('event fired');
            var dataId = $(this).data('id');
            $.get("{{ url('accounting/salesOrder/get-payment-receive-form-view') }}" + '/' + dataId, function(data) {
                console.log(data);
                $('#paymentReceiveFormContainer').html(data.data.view);
                $('#ajaxModalPaymentReceiveFormView').modal('show');
                bindUiEvents();
            })
        });

        $(document.body).on('click', '#paymentReceiveDataSubmitBtn', function(e) {
            e.preventDefault();
            $(this).html('Updating..');
            $.ajax({
                data: $('#paymentReceiveDataFormUpdate').serialize(),
                url: "{{ url('accounting/salesOrder/paymentReceives') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#paymentReceiveDataFormUpdate').trigger("reset");
                    $('#ajaxModalPaymentReceiveFormView').modal('hide');
                    $('.dataTable').DataTable().ajax.reload(null, false);
                    $('#createMrBtn').html('Update');
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: data.message,

                    });
                },
                error: function(err) {
                    console.log('Error:', err);
                    $('#paymentReceiveDataSubmitBtn').html('Update');
                    Swal.fire({
                        icon: "error",
                        title: "Validation Error!",
                        text: err.responseJSON.message,

                    });

                }
            });
        });

        // UI update on change function

        function bindUiEvents() {
            console.log('bind');
            let grandAmounts = $('.grand_amount');
            let paidAmounts = $('.paid_amount');
            let dueAmounts = $('.due_amount')
            let discountsApplied = $('.discounts_applied')
            let paymentAmounts = $('.payment_amount');
            let discountAmounts = $('.discount_amount');
            let remainingAmounts = $('.remaining_amount');

            for (let i = 0; i < grandAmounts.length; i++) {
                let grandAmount = Number($(grandAmounts[i]).text());
                console.log('Grand Amount: ', grandAmount);
                let paidAmount = Number($(paidAmounts[i]).text());
                console.log('Paid Amount: ', paidAmount);
                let discountApplied = Number($(discountsApplied[i]).text());
                console.log('Discount Applied: ', discountApplied);
                let dueAmount = Number($(dueAmounts[i]).text());
                console.log('Due Amount: ', dueAmount);
                let paymentAmount = Number($(paymentAmounts[i]).val());
                console.log('Payment/Receive Amount: ', paymentAmount);
                let discountAmount = Number($(discountAmounts[i]).val());
                console.log('Discount Amount: ', discountAmount);
                let remainingAmount = Number($(remainingAmounts[i]).val());
                console.log('Remaining Amount: ', remainingAmount);

                // Event Listener Bindings

                $(paymentAmounts[i]).on('keyup', function(e) {
                    let paymentAmountInputValue = Number($(paymentAmounts[i]).val());
                    let discountAmountInputValue = Number($(discountAmounts[i]).val());
                    console.log('payment value input:', paymentAmountInputValue);
                    let remainingAmountToSet = Number(dueAmount) - Number(discountAmountInputValue) - Number(paymentAmountInputValue);
                    $(remainingAmounts[i]).val(remainingAmountToSet);
                    // invoke
                    updatePaymentAmountSum();
                    updateRemainingAmountSum()
                })

                $(discountAmounts[i]).on('keyup', function(e) {
                    let paymentAmountInputValue = Number($(paymentAmounts[i]).val());
                    let discountAmountInputValue = Number($(discountAmounts[i]).val());
                    console.log('payment value input:', paymentAmountInputValue);
                    let remainingAmountToSet = Number(dueAmount) - Number(discountAmountInputValue) - Number(paymentAmountInputValue);
                    $(remainingAmounts[i]).val(remainingAmountToSet);
                    updateDiscountAmountSum();
                    updateRemainingAmountSum()
                })

                //end for
            }
            /** bind events */

            function updatePaymentAmountSum() {
                // Aggregate the input sums
                let paymentAmountSum = Number(0);
                for (let i = 0; i < paymentAmounts.length; i++) {
                    let paymentAmountInputValue = Number($(paymentAmounts[i]).val());
                    paymentAmountSum += paymentAmountInputValue;
                }
                $('.payment_amount_sum').text(paymentAmountSum);
                console.log('payment amount sum:', paymentAmountSum);
            }

            function updateDiscountAmountSum() {
                // Aggregate the input sums
                let discountAmountSum = Number(0);
                for (let i = 0; i < discountAmounts.length; i++) {
                    let discountAmountInputValue = Number($(discountAmounts[i]).val());
                    discountAmountSum += discountAmountInputValue;
                }
                $('.discount_amount_sum').text(discountAmountSum);
                console.log('discount amount sum:', discountAmountSum);
            }

            function updateRemainingAmountSum() {
                // Aggregate the input sums
                let remainingAmountSum = Number(0);
                for (let i = 0; i < remainingAmounts.length; i++) {
                    let remainingAmountInputValue = Number($(remainingAmounts[i]).val());
                    remainingAmountSum += remainingAmountInputValue;
                }
                $('.remaining_amount_sum').text(remainingAmountSum);
                console.log('remaining amount sum:', remainingAmountSum);
            }

            // Disable remaing amount 

            $('input.remaining_amount').prop('disabled', true);

            // Receive type on Cash On Selected disable the bank related columns
            $('#receive_type').on('change', function() {
                const selectedValue = $(this).val(); // Get the selected value
                if (selectedValue === '1') {
                    $('#bank_name').prop('disabled', true);
                    $('#account_name').prop('disabled', true);
                    $('#cheque_no').prop('disabled', true);
                    $('#cheque_date').prop('disabled', true);

                } else {
                    $('#bank_name').prop('disabled', false);
                    $('#account_name').prop('disabled', false);
                    $('#cheque_no').prop('disabled', false);
                    $('#cheque_date').prop('disabled', false);
                }
            });



        }
        /** Ends */

    })
</script>


@endpush
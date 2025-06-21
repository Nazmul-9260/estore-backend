@extends('layouts.master')
@section('content')
<div class="container-fluid category-area">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h5>View All Sales Order</h5>
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
                                    <th>Order Date</th>
                                    <th>Client Name</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>VAT</th>
                                    <th>Net Total</th>
                                    <th>Payment Type</th>
                                    <th>Order Status</th>
                                    <th class="col-action" style="width: 150px">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            </tbody>

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

<div id="deliveryFormContainer">

</div>




<style>
    .toolbar {
        float: right;
        margin-left: 10px
    }
</style>
@endsection


@push('scripts')
<!-- <script src="{{url('dataTable')}}/js/jquery.dataTables.min.js"></script>
<script src="{{url('dataTable')}}/js/dataTables.bootstrap4.min.js"></script> -->

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

            ajax: "{{url('sales/salesOrder/admin')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'order_date',
                    name: 'order_date'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name'
                },

                {
                    data: 'order_amount',
                    name: 'order_amount'
                },
                {
                    data: 'total_discount',
                    name: 'total_discount'
                },
                {
                    data: 'total_vat',
                    name: 'total_vat'
                },
                {
                    data: 'grand_total',
                    name: 'grand_total'
                },
                {
                    data: 'payment_type_id',
                    name: 'payment_type_id'
                },
                {
                    data: 'order_status',
                    name: 'order_status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            initComplete: function() {
                this.api().columns([1, 2, 3, 4, 5, 6, 7, 8]).every(function() {
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

        $('body').on('click', '.editStatusData', function() {
            var dataId = $(this).data('id');
            $.get("{{ url('sales/salesOrder/get-order-status-dropdown-list') }}" + '/' + dataId, function(data) {
                console.log(data);
                $('#data_id').val(data.data.id);
                $('#modelHeadingUpdate').html("Edit Unit");
                $('#updateBtn').val("edit-unit");
                $('#ajaxModalStatusDataUpdate').modal('show');
                // $('#title2').val(data.data.title);
                $('#status2').html(data.data.dropdown_list);
            })
        });

        $('#updateStatusDataBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Updating..');
            $.ajax({
                data: $('#dataFormUpdate').serialize(),
                url: "{{ url('sales/salesOrder/update-order-status') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#dataFormUpdate').trigger("reset");
                    $('#ajaxModalStatusDataUpdate').modal('hide');
                    $('.dataTable').DataTable().ajax.reload(null, false);
                    $('#updateStatusDataBtn').html('Update');
                },
                error: function(err) {
                    console.log('Error:', err);
                    $('#saveBtn').html('Save');
                }
            });
        });

        // Delivery 

        $('body').on('click', '.deliverData', function() {
            console.log('event fired');
            var dataId = $(this).data('id');
            $.get("{{ url('sales/salesOrder/get-delivery-form-view') }}" + '/' + dataId, function(data) {
                console.log(data);
                $('#deliveryFormContainer').html(data.data.view);
                $('#ajaxModalDeliveryFormView').modal('show');
            })
        });

        $(document.body).on('click', '#deliverDataBtn', function(e) {
            e.preventDefault();
            $(this).html('Updating..');
            $.ajax({
                data: $('#deliverDataFormUpdate').serialize(),
                url: "{{ url('sales/salesOrder/deliver') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#deliverDataFormUpdate').trigger("reset");
                    $('#ajaxModalDeliveryFormView').modal('hide');
                    $('.dataTable').DataTable().ajax.reload(null, false);
                    $('#deliverDataBtn').html('Update');
                },
                error: function(err) {
                    console.log('Error:', err);
                    $('#deliverDataBtn').html('Update');
                    Swal.fire({
                        icon: "error",
                        title: "Validation Error!",
                        text: err.responseJSON.message,

                    });

                }
            });
        });
    })
</script>


@endpush
 @extends('layouts.master')
@section('content')
<style>
    .page {
        background: #9cc9d1;
        background: -webkit-linear-gradient(to right, #eeeff0, #9cc9d1);
        background: linear-gradient(to right, #eeeff0, #9cc9d1);
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 1000px !important;
        }
    }

    .select2-container--classic .select2-selection--single,
    .select2-container--default .select2-selection--single {
        height: 31px !important;
        padding: 0 1px !important;
    }

    .select2-container--classic .select2-selection--single,
    .select2-container--default .select2-selection--single {
        height: 29px !important;
        padding: 0 1px !important;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 21px;
    }
</style>
<div class="container-fluid category-area">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Stock Manage</h5>
                </div>
                <div class="card-body">
                    {{-- <a class="btn btn-success" href="javascript:void(0)" id="showForm"> <i class="fas fa-plus"></i>
                    </a> --}}
                    <style>
                        tfoot {
                            display: table-header-group !important;
                        }
                    </style>
                    <table class="table table-hover table-bordered data-table dataTable-store">

                        <thead>
                            <tr>
                                <th width="80px">Sl No</th>
                                <th>Transaction Date</th>
                                <th>Store</th>
                                <th>Location</th>
                                <th>Product Name</th>
                                <th>Code</th>
                                <th>Stock Qty In</th>
                                <th>Stock Qty Out</th>
                                <th width="150px">Action</th>
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

<!--- Start Create Modal--->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card">
            <div class="card-header">
                <h5 id="modelHeading"></h5>
            </div>
            <div class="modal-body pl-4 pr-4">
                <div class="alert alert-danger"></div>
                <form id="dataForm" name="dataForm" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-6 pr-2">
                            <div class="inventory-bg">
                                <table class="table dataTable-store">
                                    <tr>
                                        <th>Product Code</th>
                                        <td>
                                            <input type="text" placeholder='Product Code' id="searchProduct">
                                            <input name="code" type="hidden" id="code">
                                            <input name="product_id" type="hidden" id="product_id">
                                            <div id="product_list" style="position: relative"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <td><input type="text" id="product_name" value="" maxlength=""></td>
                                    </tr>
                                    <tr>
                                        <th>Stock Qty</th>
                                        <td><input type="text" id="stock_qty" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Transaction Date</th>
                                        <td><input name="transaction_date" id='transaction_date' type="text"></td>
                                    </tr>
                                    <tr>
                                        <th>Supplier</th>
                                        <td>
                                            <select name="supplier_id" id="supplier_id" style="width: 100%;">
                                                @php
                                                echo Modules\Inventory\Entities\Supplier::getDropDownList('company_name');
                                                @endphp
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="inventory-bg">
                                <table class="table dataTable-store">
                                    <tr>
                                        <th>Store</th>
                                        <td>
                                            <select name="store_id" id="store_id" style="width: 100%;">
                                                @php
                                                echo Modules\Inventory\Entities\Store::getDropDownList('title');
                                                @endphp
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td>
                                            <select name="location_id" id="location_id" style="width: 100%;">
                                                @php
                                                echo Modules\Inventory\Entities\StoreLocation::getDropDownList('title');
                                                @endphp
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Stock Type</th>
                                        <td>
                                            <select name="stock_type" id="stock_type" style="width: 100%;">
                                                @php
                                                echo Modules\Config\Entities\Config::dropDownList('inventory_transaction_type');
                                                @endphp
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Stock Qty</th>
                                        <td><input name="stock_qty" id='stock_qty' type="text"></td>
                                    </tr>
                                    <tr>
                                        <th>Purchase Price</th>
                                        <td><input name="purchase_price" id='purchase_price' type="text"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-dark" id="saveBtn" value="create">Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--- End Create Model--->
<style>
    .toolbar {
        float: right;
        margin-left: 10px
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css" integrity="sha512-lvdq1fIyCp6HMWx1SVzXvGC4jqlX3e7Xm7aCBrhj5F1WdWoLe0dBzU0Sy10sheZYSkJpJcboMNO/4Qz1nJNxfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@push('scripts')
<script>
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

        ajax: '{{ url('inventory/inventory/admin') }}',
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'transaction_date',
            name: 'transaction_date'
        },
        {
            data: 'store_name',
            name: 'store_name'
        },
        {
            data: 'store_location',
            name: 'store_location'
        },
        {
            data: 'product_name',
            name: 'product_name'
        },
        {
            data: 'product_code',
            name: 'product_code'
        },
        {
            data: 'stock_in',
            name: 'stock_in'
        },
        {
            data: 'stock_out',
            name: 'stock_out'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
        initComplete: function () {
            this.api().columns([1, 2, 3, 4, 5, 6, 7]).every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? val : '', true, false).draw();
                    });
            });


            this.api().columns([3]).every(function () {
                var column = this;
                var select = $('<select style="width:100%"><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.each(function () {
                    select.append('<option value="Active">' + 'Active' + '</option>')
                    select.append('<option value="Inactive">' + 'Inactive' + '</option>')
                });
            });

            $("div.toolbar").html(
                "<a class='btn waves-effect waves-light btn-primary btn-sm btnAdd' href='javascript:void(0)' onclick='showForm()'> <i class='fas fa-plus'></i> Add </a>"
            );
        }
    });
    // End View Data


    // Start Create Data
    function showForm() {
        $('#saveBtn').val("save-data");
        $('#product_category_id').val('');
        $('#dataForm').trigger("reset");
        $('#modelHeading').html("Manual Inventory Form");
        $('#ajaxModel').modal('show');
        $('.alert-danger').hide();
    }

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#dataForm').serialize(),
            url: "{{ url('inventory/inventory/create') }}",
            type: "POST",
            dataType: 'json',
            success: function (result) {
                if (result.errors) {
                    $('#saveBtn').html('Send')
                    $('.alert-danger').html('');
                    $.each(result.errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                } else {
                    $('.alert-danger').hide();
                    $('#dataForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    $('.dataTable').DataTable().ajax.reload(null, false);
                    $('#saveBtn').html('Save');
                }
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save');
            }
        });
    });
    // End Create Data


    // End Edit Data

    // Start Delete Data
    $('body').on('click', '.deleteData', function () {

        var data_id = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                type: "GET",
                url: "{{ url('inventory/inventory/delete') }}" + '/' + data_id,
                success: function (data) {
                    $('.dataTable').DataTable().ajax.reload(null, false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }


    });
    // End Delete Data


    // ---------------------- Start Product Search------------------------

    $('#searchProduct').on('keyup', function () {
        var query = $(this).val();
        $.ajax({
            url: "{{ url('/config/search/product') }}",
            type: "GET",
            data: {
                'product': query
            },
            success: function (data) {
                $('#product_list').html(data);
            }
        })
    });

    $(document).on('click', 'li.searchResultProduct', function () {
        var selectedText = $(this).text();
        $('#searchProduct').val(selectedText);
        var code = $(this).data('product-code');
        $('#code').val(code);
        $('#product_list').html("");

        var product_code = code;
        $.ajax({
            url: "{{ url('config/getProduct/prodCode') }}/" + product_code,
            type: "GET",
            data: {
                'product_code': product_code
            },
            success: function (data) {
                $("#product_id").val(data.productId);
                $("#product_name").val(data.productName);
                $("#stock_qty").val(data.stockQty);
            }
        })
    });
    //---------------End Product Search------------------------------

    // Start Delete Data
    $('body').on('click', '.deleteData', function () {
        var data_id = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                type: "GET",
                url: "{{ url('inventory/delete') }}" + '/' + data_id,
                success: function (data) {
                    $('.dataTable').DataTable().ajax.reload(null, false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
    // End Delete Data

    $(function () {
        $("#transaction_date") 
            .datepicker({ //timepicker for time only, datepicker for date only
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
            });
    });

</script>
@endpush
@extends('layouts.master')
@section('header_css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <style>
        .page {
            background: #9cc9d1;
            background: -webkit-linear-gradient(to right, #eeeff0, #9cc9d1);
            background: linear-gradient(to right, #eeeff0, #9cc9d1);
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header text-white bg-info">
                        <b>View All Inventory Data</b>
                    </div>
                    <div class="card-body"
                        style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <style>
                            tfoot {
                                display: table-header-group !important;
                            }

                        </style>
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Transaction Date</th>
                                    <th>Store</th>
                                    <th>Location</th>
                                    <th>Product Name</th>
                                    <th>Code</th>
                                    <th>Stock Qty In</th>
                                    <th>Stock Qty Out</th>
                                    <th style="width: 100px">Action</th>
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
                                    <th style="width: 100px">Action</th>
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
    <!--- Start Update Model--->
    <div class="modal fade" id="ajaxModelUpdate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeadingUpdate"></h4>
                </div>
                <div class="modal-body">
                    <form id="dataFormUpdate" name="dataFormUpdate" class="form-horizontal">
                        <input type="hidden" name="data_id" id="data_id">
                        <div class="form-group">
                            <label for="category_id2" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-12">
                                <select name="category_id" class="form-control" id="category_id2">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title2" class="col-sm-12 control-label">SubCategory Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title2" name="title" placeholder="Enter Title"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Status</label>
                            <div class="col-sm-12">
                                <select name="status" class="form-control" id="status2">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="updateBtn" value="create">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--- End Update Model--->
    <style>
        .toolbar {
            float: right;
            margin-left: 10px
        }

    </style>
@endsection

@section('footer_js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

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

            ajax: '{{ url('/inventory/admin') }}',
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
            initComplete: function() {
                this.api().columns([1, 2, 3, 4, 5, 6, 7]).every(function() {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                });

                $("div.toolbar").html(
                    "<a class='btn btn-success btnAdd' href='javascript:void(0)' onclick='showForm()'> <i class='fas fa-plus'></i></a>"
                );
            }


        });
        // End View Data

        // Start Create Data
        function showForm() {
            $('#saveBtn').val("save-data");
            $('#product_category_id').val('');
            $('#dataForm').trigger("reset");
            $('#modelHeading').html("Create");
            $('#ajaxModel').modal('show');
        }

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#dataForm').serialize(),
                url: "{{ url('productSubCategory/create') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#dataForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    $('.dataTable').DataTable().ajax.reload(null, false);
                    $('#saveBtn').html('Save');
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });
        // End Create Data

        // Start Edit Data
        $('body').on('click', '.editData', function() {
            var dataId = $(this).data('id');
            $.get("{{ url('receive/receiveDetailsView') }}" + '/' + dataId, function(data) {
                $('#data_id').val(data.data.id);
                $('#modelHeadingUpdate').html("Receive Details");
                $('#updateBtn').val("receive-details");
                $('#ajaxModelUpdate').modal('show');
                $('.alert-danger').hide();
                $('#receive_details').html(data.receiveDetails);
            })
        });
        // End Edit Data

    </script>

@endsection

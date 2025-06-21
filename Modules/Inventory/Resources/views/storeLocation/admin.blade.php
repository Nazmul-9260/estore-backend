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
                        <b>View All Stores Location</b>
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
                                    <th>Title</th>
                                    <th>Store</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th width="100px">Action</th>
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
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <form id="dataForm" name="dataForm" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title"
                                    value="" maxlength="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="col-sm-2 control-label">Store</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="store_id" id="store_id">
                                    @php
                                        echo App\Model\Inventory\Store::getDropDownList('title');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Details</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="details" id="details" rows="11"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--- End Create Model--->

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
                            <label for="name" class="col-sm-12 control-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title2" name="title" placeholder="Enter Title"
                                    value="" maxlength="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="col-sm-2 control-label">Store</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="store_id2" name="store_id" required>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Details</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="details2" id="details" rows="11"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-12">
                                <select name="status" class="form-control" id="status2"> </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="updateBtn" value="create">Save
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
            iDisplayLength: 25,
            aaSorting: [
                ['0', 'desc']
            ],
            dom: '<"toolbar">frtip',

            ajax: '{{ url('storeLocation/admin') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'store_name',
                    name: 'store_name'
                },
                {
                    data: 'details',
                    name: 'details'
                },
                {
                    data: 'status',
                    name: 'status'
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


                this.api().columns([4]).every(function() {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.each(function() {
                        select.append('<option value="Active">' + 'Active' + '</option>')
                        select.append('<option value="Inactive">' + 'Inactive' + '</option>')
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
            $('.alert-danger').hide();
            $('#saveBtn').val("save-data");
            $('#data_id').val('');
            $('#dataForm').trigger("reset");
            $('#modelHeading').html("Create");
            $('#ajaxModel').modal('show');
        }

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#dataForm').serialize(),
                url: "{{ url('storeLocation/create') }}",
                type: "POST",
                dataType: 'json',
                success: function(result) {
                    if (result.errors) {
                        $('#saveBtn').html('Send')
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        $('#dataForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        $('.dataTable').DataTable().ajax.reload(null, false);
                        $('#saveBtn').html('Save');
                    }
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
            $.get("{{ url('storeLocation/edit') }}" + '/' + dataId, function(data) {
                $('#data_id').val(data.data.id);
                $('#modelHeadingUpdate').html("Edit Store Location");
                $('#updateBtn').val("edit-store-location");
                $('#ajaxModelUpdate').modal('show');
                $('.alert-danger').hide();
                $('#title2').val(data.data.title);
                $('#details2').val(data.data.details);
                $('#store_id2').html(data.str);
                $('#status2').html(data.status);
            })
        });

        $('#updateBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Updating..');
            $.ajax({
                data: $('#dataFormUpdate').serialize(),
                url: "{{ url('storeLocation/update') }}",
                type: "POST",
                dataType: 'json',
                success: function(result) {
                    if (result.errors) {
                        $('#saveBtn').html('Update')
                        $('#updateError').html('');
                        $.each(result.errors, function(key, value) {
                            $('#updateError').show();
                            $('#updateError').append('<li>' + value + '</li>');
                        });
                        $('#updateBtn').html('Update');
                    } else {
                        $('#dataFormUpdate').trigger("reset");
                        $('#ajaxModelUpdate').modal('hide');
                        $('.dataTable').DataTable().ajax.reload(null, false);
                        $('#updateBtn').html('Update');
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });

        // End Edit Data

        // Start Delete Data
        $('body').on('click', '.deleteData', function() {

            var data_id = $(this).data("id");
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('storeLocation/delete') }}" + '/' + data_id,
                    success: function(data) {
                        $('.dataTable').DataTable().ajax.reload(null, false);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }


        });
        // End Delete Data

    </script>

@endsection

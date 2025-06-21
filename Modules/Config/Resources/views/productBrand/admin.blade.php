@extends('layouts.master')
@section('header_css')
<link href="{{url('dataTable')}}/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{url('dataTable')}}/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <style>
        .page {
            background: #9cc9d1;
            background: -webkit-linear-gradient(to right, #eeeff0, #9cc9d1);
            background: linear-gradient(to right, #eeeff0, #9cc9d1);
        }

    </style>
    <div class="container-fluid category-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Product Brand</h5>
                    </div>
                    <div class="card-body">
                        {{-- <a class="btn btn-success" href="javascript:void(0)" id="showForm"> <i class="fas fa-plus"></i> </a> --}}
                        <style>
                            tfoot {
                                display: table-header-group !important;
                            }

                        </style>
                        <table class="table table-hover table-bordered data-table dataTable-store">
                            <thead>
                                <tr>
                                    <th width="80px">Sl No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Web URL</th>
                                    <th>Status</th>
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
                                    <th width="150px">Action</th>
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
    <div class="modal fade modal-redesign" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card">
                <div class="card-header">
                    <h5 id="modelHeading"></h5>
                </div>
                <div class="modal-body">
                    <form id="dataForm" name="dataForm" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Name<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Slug<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Web URL</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="website_url" name="website_url" placeholder="Enter Web URL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Description</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-dark btn-sm" id="saveBtn" value="create">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--- End Create Model--->

    <!--- Start Update Model--->
    <div class="modal fade modal-redesign" id="ajaxModelUpdate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeadingUpdate"></h4>
                </div>
                <div class="modal-body">
                    <form id="dataFormUpdate" name="dataFormUpdate" class="form-horizontal">
                        <input type="hidden" name="data_id" id="data_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name2" name="name" placeholder="Enter Name" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Slug<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="slug2" name="slug" placeholder="Enter Slug" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Web URL</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="website_url2" name="website_url" placeholder="Enter Web URL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Description</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="description2" name="website_url"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-12">
                                <select name="status" class="form-control" id="status2">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-dark btn-sm" id="updateBtn" value="create">Save
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

@push('scripts')
<script src="{{url('dataTable')}}/js/jquery.dataTables.min.js"></script>
<script src="{{url('dataTable')}}/js/dataTables.bootstrap4.min.js"></script>

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
            aaSorting: [['0', 'desc']],
            dom: '<"toolbar">frtip',

            ajax: '{{ url('config/productBrand/admin') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'website_url',
                    name: 'website_url'
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
                this.api().columns([1,2,3]).every(function() {
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

                $("div.toolbar").html("<a class='btn waves-effect waves-light btn-primary btn-sm btnAdd' href='javascript:void(0)' onclick='showForm()'> <i class='fas fa-plus'></i>Add</a> ");
            }
        });
        // End View Data


        // Start Create Data
        function showForm(){
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
                url: "{{ url('config/productBrand/create') }}",
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
            $.get("{{ url('config/productBrand/edit') }}" + '/' + dataId, function(data) {
                $('#data_id').val(data.data.id);
                $('#modelHeadingUpdate').html("Edit Product category");
                $('#updateBtn').val("edit-product-category");
                $('#ajaxModelUpdate').modal('show');
                $('#name2').val(data.data.name);
                $('#slug2').val(data.data.slug);
                $('#description2').val(data.data.description);
                $('#website_url2').val(data.data.website_url);
                $('#status2').html(data.str);
            })
        });

        $('#updateBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Updating..');
            $.ajax({
                data: $('#dataFormUpdate').serialize(),
                url: "{{ url('config/productBrand/update') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#dataFormUpdate').trigger("reset");
                    $('#ajaxModelUpdate').modal('hide');
                    $('.dataTable').DataTable().ajax.reload(null, false);
                    $('#updateBtn').html('Update');
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
                    url: "{{ url('config/productBrand/delete') }}" + '/' + data_id,
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

@endpush
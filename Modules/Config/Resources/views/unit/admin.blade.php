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
                        <h5>View All Units</h5>
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
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
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
    <div class="modal fade max-300 modal-redesign" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card">
                <div class="card-header">
                    <h5 id="modelHeading"></h5>
                </div>
                <div class="modal-body">
                    <form id="dataForm" name="dataForm" class="form-horizontal">
                        <div class="form-group col-12">
                            <label for="name" class="w-100 control-label">Title<span class="text-danger">*</span></label>
                            <div class="w-100">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title"
                                    value="" maxlength="" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 w-100 col-12">
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
    <div class="modal fade max-300 modal-redesign" id="ajaxModelUpdate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card">
                <div class="card-header">
                    <h5 id="modelHeadingUpdate"></h5>
                </div>
                <div class="modal-body">
                    <form id="dataFormUpdate" name="dataFormUpdate" class="form-horizontal">
                        <input type="hidden" name="data_id" id="data_id">
                        <div class="form-group col-12">
                            <label for="name" class="w-100 control-label">Title<span class="text-danger">*</span></label>
                            <div class="w-100">
                                <input type="text" class="form-control" id="title2" name="title" placeholder="Enter Title"
                                    value="" maxlength="" required="">
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="name" class="w-100 control-label">Status</label>
                            <div class="w-100">
                                <select name="status" class="form-control" id="status2">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 w-100 col-12">
                            <button type="submit" class="btn btn-primary btn-sm" id="updateBtn" value="create">Save
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
<!-- @section('footer_js') -->
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

            ajax: '{{ url('config/unit/admin') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
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
                this.api().columns([1]).every(function() {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                });


                this.api().columns([2]).every(function() {
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

                $("div.toolbar").html("<a class='btn waves-effect waves-light btn-primary btn-sm btnAdd' href='javascript:void(0)' onclick='showForm()'> <i class='fas fa-plus'></i>Add </a>");
            }
        });
        // End View Data


        // Start Create Data
        function showForm(){
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
                url: "{{ url('config/unit/create') }}",
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
            $.get("{{ url('config/unit/edit') }}" + '/' + dataId, function(data) {
                $('#data_id').val(data.data.id);
                $('#modelHeadingUpdate').html("Edit Unit");
                $('#updateBtn').val("edit-unit");
                $('#ajaxModelUpdate').modal('show');
                $('#title2').val(data.data.title);
                $('#status2').html(data.str);
            })
        });

        $('#updateBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Updating..');
            $.ajax({
                data: $('#dataFormUpdate').serialize(),
                url: "{{ url('config/unit/update') }}",
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
                    url: "{{ url('config/unit/delete') }}" + '/' + data_id,
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

    <script>
        $(document).ready(function () {
            // Function to display error messages
            function showError(input, message) {
                let formGroup = $(input).closest('.form-group');
                formGroup.find('.error-message').remove();  // Remove any existing error messages
                formGroup.append(`<div class="text-danger error-message p-0">${message}</div>`);
                $(input).addClass('is-invalid');
            }

            // Function to clear error messages
            function clearError(input) {
                let formGroup = $(input).closest('.form-group');
                formGroup.find('.error-message').remove();
                $(input).removeClass('is-invalid');
            }

            // Validate on form submission
            $('#saveBtn').click(function (event) {
                event.preventDefault();  // Prevent form submission to handle validation
                let isValid = true;

                // Check title field
                if (!$('#title').val().trim()) {
                    showError($('#title'), 'Title is required');
                    isValid = false;
                } else {
                    clearError($('#title'));
                }

                // Submit the form if validation passes
                if (isValid) {
                    $('#dataForm').submit();
                }
            });
        });

    </script>

@endpush

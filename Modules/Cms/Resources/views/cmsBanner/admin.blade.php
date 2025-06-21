@extends('layouts.master')
@section('content')
    <div class="container-fluid category-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>View All Banner</h5>
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
                                        <th>Title</th>
                                        <th>Banner Image</th>
                                        <th>Width</th>
                                        <th>Height</th>
                                        <th>Ordering</th>
                                        <th>Button URL</th>
                                        <th>Status</th>
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
            //for pagination
            paging: true,
            pageLength: 10,

            iDisplayLength: 25,
            aaSorting: [
                ['0', 'desc']
            ],
            dom: '<"toolbar">frtip',

            ajax: '{{ url('cms/cmsBanner/admin') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
               
                {
                    data: 'title',
                    name: 'title'
                },
                { data: 'banner_image', name: 'banner_image',
                    render: function( data, type, full, meta ) {
                        return "<img src=\"{{url('/')}}/" + data + "\" width=\"50\"/>";
                    }
                },
                {
                    data: 'width',
                    name: 'width'
                },
                {
                    data: 'height',
                    name: 'height'
                },
                {
                    data: 'ordering',
                    name: 'ordering'
                },
                {
                    data: 'button_url',
                    name: 'button_url'
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
                this.api().columns([1, 2,3,4,5,6]).every(function() {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                });


                this.api().columns([7]).every(function() {
                    var column = this;
                    var select = $('<select style="width:100%"><option value=""></option></select>')
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

                var customUrl = window.location.origin + "/cms/cmsBanner/create";

                $("div.toolbar").html(
                    "<a class='btn waves-effect waves-light btn-primary btn-sm btnAdd' href='" + customUrl +
                    "'> <i class='fas fa-plus'></i> Add</a>"
                );
            }
        });
    </script>
@endpush

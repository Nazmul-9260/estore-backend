@extends('layouts.master')
@section('content')
<div class="container-fluid category-area">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h5>View Site Info</h5>
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
                                <th width="80">Sl No</th>
                                <th>Site Name</th>
                                <th>Meta Type</th>
                                <th>Site Title</th>
                                <th>Moto</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Domain Name</th>
                                <th>Status</th>
                                <th width="150">Action</th>
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
                                <th width="150">Action</th>
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

            ajax: '{{ url('cms/siteInfo/admin') }}',
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            // {
            //     data: 'logo', name: 'logo',
            //     render: function (data, type, full, meta) {
            //         return "<img src=\"/upload/cms/logo/" + data + "\" height=\"50\"/>";
            //     }
            // },
            {
                data: 'site_name',
                name: 'site_name'
            },
            {
                data: 'meta_type',
                name: 'meta_type'
            },
            {
                data: 'site_title',
                name: 'site_title'
            },
            {
                data: 'moto',
                name: 'moto'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'domain_name',
                name: 'domain_name'
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
            initComplete: function () {
                this.api().columns([1, 2,3,4,5,6,7]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                });


                this.api().columns([8]).every(function () {
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

                var customUrl = window.location.origin + "/cms/siteInfo/create";

                $("div.toolbar").html(
                    "<a class='btn waves-effect waves-light btn-primary btn-sm btnAdd' href='" + customUrl +
                    "'> <i class='fas fa-plus'></i>Add </a>"
                );
            }
        });
    </script>
@endpush
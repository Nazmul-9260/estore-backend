@extends('layouts.master')
@section('header_css')
    <link rel="stylesheet" href="{{ url('css') }}/addToGrid.css">
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
                        <b>View All Received Data</b>
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
                                    <th>Supplier</th>
                                    <th>Receive No</th>
                                    <th>PO No</th>
                                    <th>Receive Date</th>
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
                    @include('inventory.receive._returnForm')
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

            ajax: '{{ url('/receive/return') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'supplier',
                    name: 'supplier'
                },
                {
                    data: 'receive_no',
                    name: 'receive_no'
                },
                {
                    data: 'po_no',
                    name: 'po_no'
                },
                {
                    data: 'receive_date',
                    name: 'receive_date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            initComplete: function() {
                this.api().columns([1, 2, 3, 4]).every(function() {
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
        // End View Data

        // Start Edit Data
        $('body').on('click', '.editData', function() {
            var dataId = $(this).data('id');
            $.get("{{ url('receive/returnForm') }}" + '/' + dataId, function(data) {
                $('#data_id').val(data.data.id);
                $('#modelHeadingUpdate').html("Return Form");
                $('#updateBtn').val("receive-product");
                $('#ajaxModelUpdate').modal('show');
                $('.alert-danger').hide();
                $('#supplierName').html(data.supplierName);
                $('#receiveNo').html(data.data.receive_no);
                $('#po_no').val(data.data.po_no);
                $('#receiveDate').html(data.data.receive_date);
                $('#return_details').html(data.receiveDetails);
            })
        });


        $('#returnBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Saving..');
            $.ajax({
                data: $('#dataFormUpdate').serialize(),
                url: "{{ url('receive/returnProduct') }}",
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
                        $('#returnBtn').html('Update');
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });
        // End Edit Data

        $(function() {
            $("#return_date").datepicker({ //timepicker for time only, datepicker for date only
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
            });
        });

        $("#returnBtn").click(function() {
            if ($('#return_date').val() == '') {
                alert("Please Insert Return Date.");
                return flase;
            }
            /*
            $('#dataGrid td input.returnQty').each(function() {
                var $returnQty = $(this).val();
                if ($returnQty != '') {

                } else {
                    alert("Please Insert Return Qty.");
                    return flase;
                    event.preventDefault();
                }
            });
            */

        });

    </script>

@endsection

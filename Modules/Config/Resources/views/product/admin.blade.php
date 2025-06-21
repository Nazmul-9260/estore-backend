@extends('layouts.master')
@section('content')
    <div class="container-fluid category-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>View All Products</h5>
                    </div>
                    <div class="card-body">
                        {{-- <a class="btn btn-success" href="javascript:void(0)" id="showForm"> <i class="fas fa-plus"></i> </a> --}}
                        <style>
                            tfoot {
                                display: table-header-group !important;
                            }

                        </style>
                        <div class="table-responsive--">
                            <table class="table table-hover table-bordered data-table dataTable-store product-table-view">

                                <thead>
                                    <tr>
                                        <th width="80px">Sl No</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Min Order Qty.</th>
                                        <th>Status</th>
                                        <th class="col-action" width="190px">Action</th>
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
                                        <th width="190px"> Action</th>
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

    {{-- <script src="{{ asset('assets/js/modal.js') }}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script>


        $(document).on('click', '.button', function (e) {

                   
            e.preventDefault();
            
            var id = $(this).data('id');
            console.log(id)     
            
            swal({title: `Are you sure you want to delete this record?`,text: "If you delete this, it will be gone forever.",icon: "warning",buttons: true,dangerMode: true,})
            .then((willDelete) => {
            if (willDelete) {
                // form.submit();
                $.ajax({
                        type: "POST",
                        url: "{{url('/config/product/delete/')}}/"+id,
                        data: {id:id},
                        success: function (data) {
                                    swal({
                                        title: "Deleted!",
                                        text: "Your Product has been deleted.",
                                        icon: "success",
                                        confirmButtonText: "Ok",
                                    }).then((value)=>{
                                        if(value)location.reload()
                                    }); 

                            }         
                    });                    
                   
            }

            });

           
        });



        $(document).ready(function () {
        //Basic alert
        // document.querySelector('.sweet-1').onclick = function(){
        // 	swal("Here's a message!", "It's pretty, isn't it?")
        // };
        // console.log('test');
        });

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
            ajax: '{{ url('config/product/admin') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                { data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                        return "<img src=\"{{url('/')}}/" + data + "\" width=\"50\"/>";
                    }
                },
                {
                    data: 'categoryName',
                    name: 'categoryName'
                },
                {
                    data: 'subCategoryName',
                    name: 'subCategoryName'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'min_order_qty',
                    name: 'min_order_qty'
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

                var customUrl = window.location.origin + "/config/product/create";

                $("div.toolbar").html(
                    "<a class='btn waves-effect waves-light btn-primary btn-sm btnAdd' href='" + customUrl +
                    "'> <i class='fas fa-plus'></i> Add</a>"
                );
            }
        });
    </script>
@endpush

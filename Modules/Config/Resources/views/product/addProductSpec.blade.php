@extends('layouts.master')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
     
@endsection

@section('content')
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
}
</style>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Product Specification</h5>
        </div>
        <div class="card-body">
            <form id="attribute_form" action="{{ url('config/product/productSpecSave') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $data->id }}">
                <div class="w-100">
                    <table class="table table-hover table-bordered data-table dataTable-store dataTable"
                        id="attribute-table">
                        <thead>
                            <tr>
                                <td>Product Specification</td>
                            </tr>
                        </thead>
                        <tbody id="dynamic-rows">
                            <tr id="initial-row">
                                <td>
                                    {{-- <input name="specification" class="form-control remarks" type="text" placeholder="Specification"> --}}
                                    <textarea style="height:200px !important;" class="form-control remarks" id="summer-note-textarea" placeholder="Specification" rows="5" name="specification">{{ $data->specification }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="w-100 pt-1 pb-1">
                        <button type="submit" class="btn btn-dark" id="saveBtn" value="save-data">Add Product Specification</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>

        
 $(document).ready(function () {
    // Function to check for duplicate product attributes
     
});


            // Remove 'is-invalid' on input
            $(document).on('input change', '#attribute_specification tbody input[name="attribute_specification_type_id[]"], #attribute_specification tbody input[name="specification_value[]"]', function () {
                if ($(this).val().trim()) {
                    $(this).removeClass('is-invalid');
                }
            });

            // Form Validation
            $('#attribute_form').validate({
                rules: {
                    'attribute_specification_type_id[]': {
                        required: true,
                        minlength: 1,
                    },
                    'specification_value[]': {
                        required: true,
                        minlength: 1,
                    },

                },
                messages: {
                    'attribute_specification_type_id[]': "Please Select Specification Type",
                    'specification_value[]': "Please Enter Value",
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('text-danger');
                    element.closest('td').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
       
    </script>
    
    
    @endsection
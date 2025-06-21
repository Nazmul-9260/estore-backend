@extends('layouts.master')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Product Attribute</h5>
        </div>
        <div class="card-body">
            <form id="attribute_form" action="{{ url('config/product/productAttributeSave') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $data->id }}">
                <div class="w-100">
                    <table class="table table-hover table-bordered data-table dataTable-store dataTable"
                        id="attribute-table">
                        <thead>
                            <tr>
                                <td>Product Attribute Type</td>
                                <td>Product Attribute Value</td>
                                <td>Remarks</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody id="dynamic-rows">
                            <tr id="initial-row">
                                <td>
                                    <select class="form-control fill product-attribute" id="product_attribute_type_id">
                                        @php
                                            echo Modules\Config\Entities\Config::dropDownList('product_attribute_type');
                                        @endphp
                                    </select>
                                </td>
                                <td><input class="form-control attribute-value" type="text" placeholder="Product Attribute Value"></td>
                                <td><input class="form-control remarks" type="text" placeholder="Remarks"></td>
                                
                                <td>
                                    <button type="button" class="btn btn-sm btn-success add-more">Add More</button>
                                </td>
                            </tr>
                            <?php echo Modules\Config\Entities\SubCategoryAttribute::getAttributeList($data->id, $data->subcategory_id); ?>
                        </tbody>
                    </table>
                    <div class="w-100 pt-1 pb-1">
                        <button type="submit" class="btn btn-dark" id="saveBtn" value="save-data">Save</button>
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
    function isDuplicateAttribute(attribute) {
        let isDuplicate = false;

        $('#dynamic-rows tr').not('#initial-row').each(function () {
            const existingAttribute = $(this).find('.product-attribute').val();

            if (existingAttribute === attribute) {
                isDuplicate = true;
            }
        });

        return isDuplicate;
    }
    
    $(document).on('click', '.add-more', function () {
        const $initialRow = $('#initial-row');
        
    
        const selectedAttribute = $initialRow.find('.product-attribute').val();
        const inputValue = $initialRow.find('.attribute-value').val().trim();
        const remarksValue = $initialRow.find('.remarks').val().trim();

     
        if (selectedAttribute === "" || inputValue === "") {
            alert('Please fill in all fields (Attribute, Value, and Remarks) before adding a new row.');
            return;
        }

        
        if (isDuplicateAttribute(selectedAttribute)) {
            alert('This product attribute type is already selected. Please choose a different one.');
            return;
        }
       
       
        const newRow = `
        <tr>
            <td>
                <select class="form-control product-attribute" name="product_attribute_type_id[]">
                    <option value="">Select One</option>
                    @php
                        echo Modules\Config\Entities\Config::dropDownList('product_attribute_type');
                    @endphp
                    <option value="${selectedAttribute}" selected>${$initialRow.find('.product-attribute option:selected').text()}</option>
                </select>
            </td>
            <td>
                <input class="form-control attribute-value" type="text" placeholder="Value" name="attribute_value[]" value="${inputValue}">
            </td>
            <td>
                <input class="form-control remarks" type="text" placeholder="Remarks" name="remarks[]" value="${remarksValue}">
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger remove-row">Remove</button>
            </td>
        </tr>`;

        $('#dynamic-rows').append(newRow);
        $('#product_attribute_type_id').val("");
    });

    
    $(document).on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
    });
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
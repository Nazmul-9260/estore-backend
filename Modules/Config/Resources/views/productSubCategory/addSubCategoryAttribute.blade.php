@extends('layouts.master')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    
    <div class="card">
        <div class="card-header">
            <h5>Sub category Attribute (<span style="font-size: 16px; display: inline; color:red">
                    <?php echo Modules\Config\Entities\ProductSubCategory::title($data->id) ?></span>)
            </h5>
        </div>
        <div class="card-body">
            <form id="attribute_form" action="{{ url('config/productSubCategory/subCategoryAttributeSave') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sub_category_id" value="{{ $data->id }}">
                <div class="w-100">
                    <table class="table table-hover table-bordered data-table dataTable-store dataTable"
                        id="attribute-table">
                        <thead>
                            <tr>
                                <td>Product Attribute Type</td>
                                <td>Remarks</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody id="dynamic-rows">
                            <?php    
              $attr = [];
foreach ($attrData as $dt) {?>
                            <tr>
                                <td>
                                    <?php

    if ($dt->attribute_id > 0) {
        $attr[] = $dt->attribute_id;
        echo Modules\Config\Entities\Config::headTitleOnly('product_attribute_type', $dt->attribute_id);
    }
                    ?>
                                </td>
                                <td><?php    echo $dt->remarks; ?></td>
                                <td></td>
                            </tr>
                            <?php    } ?>
                            <tr id="initial-row">
                                <td>
                                    <select class="form-control fill product-attribute" id="attribute_id">
                                        @php
                                            $attr = implode(",", array_unique($attr));
                                            echo Modules\Config\Entities\Config::dropDownListWithExclude('product_attribute_type', $attr);
                                        @endphp
                                    </select>
                                </td>
                                <td><input class="form-control remarks" type="text" placeholder="Remarks"></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success add-more">Add More</button>
                                </td>
                            </tr>
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
                const remarksValue = $initialRow.find('.remarks').val().trim();
                if (selectedAttribute === "") {
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
                <select class="form-control product-attribute" name="attribute_id[]">
                    <option value="">Select One</option>
                    @php
                        echo Modules\Config\Entities\Config::dropDownList('product_attribute_type');
                    @endphp
                    <option value="${selectedAttribute}" selected>${$initialRow.find('.product-attribute option:selected').text()}</option>
                </select>
            </td>
            <td>
                <input class="form-control remarks" type="text" placeholder="Remarks" name="remarks[]" value="${remarksValue}">
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger remove-row">Remove</button>
            </td>
        </tr>`;
                $('#dynamic-rows').append(newRow);
                $('#attribute_id').val("");
            });

            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
        });
        // Remove 'is-invalid' on input
        $(document).on('input change', '#attribute_specification tbody input[name="attribute_id[]"], #attribute_specification tbody input[name="specification_value[]"]', function () {
            if ($(this).val().trim()) {
                $(this).removeClass('is-invalid');
            }
        });

        // Form Validation
        $('#attribute_form').validate({
            rules: {
                'attribute_id[]': {
                    required: true,
                    minlength: 1,
                },
            },
            messages: {
                'attribute_id[]': "Please Select Attribute",
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
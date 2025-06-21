@extends('layouts.master')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Product File</h5>
        </div>
        <div class="card-body">
            <form id="image_form" action="{{ url('config/product/productFileSave') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="data_id" value="{{ $data->id }}">
                <div class="w-100">
                    <table class="table table-hover table-bordered data-table dataTable-store dataTable"
                        id="image_upload">
                        <thead>
                            <tr>
                                <td>Title</td>
                                <td>File</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php    
                                            $attr = [];
foreach ($fileData as $dt) {?>
                            <tr>
                                <td>
                                    <?php

    echo $dt->title;
                                ?>
                                </td>
                                <td> 
                                    <a target="_blank" href="{{ asset('upload/productDetailsFile/' . $dt->file_name) }}"> {{$dt->file_name}} </a>
                                    <?php
                            ?></td>
                                <td></td>
                            </tr>
                            <?php    } ?>
                            <tr>
                                <td><input class="form-control" type="text" placeholder="Product Title" name="title[]"
                                        required></td>
                                <td>
                                    <input type="file" class="form-control" name="pdf_files[]" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success add-more">Add More</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="w-100 pt-1 pb-1">
                        <button type="submit" class="btn btn-dark" id="saveBtn" value="save-data">Add File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add More Button
            $(document).on('click', '.add-more', function () {
                // Validate only the Title and Image fields in the last row before adding a new row
                let isValid = true;
                // Check Title field
                const titleField = $('#image_upload tbody tr:last input[name="title[]"]');
                if (!titleField.val().trim()) {
                    isValid = false;
                    titleField.addClass('is-invalid');
                } else {
                    titleField.removeClass('is-invalid');
                }

                // Check Image field
                const imageField = $('#image_upload tbody tr:last input[name="pdf_files[]"]');
                if (!imageField.val().trim()) {
                    isValid = false;
                    imageField.addClass('is-invalid');
                } else {
                    imageField.removeClass('is-invalid');
                }

                if (isValid) {
                    // Add a new row if the current row is valid
                    $('#image_upload tbody').append(`
                        <tr>
                            <td><input type="text" name="title[]" placeholder="Product Title" class="form-control" required></td>
                            <td><input type="file" name="pdf_files[]" class="form-control" required  accept="image/*,.pdf"></td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-row">Remove</button></td>
                        </tr>
                    `);
                } else {
                    alert('Please fill in the required fields: Title and Image.');
                }
            });

            // Remove Row
            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });

            // Remove 'is-invalid' on input
            $(document).on('input change', '#image_upload tbody input[name="title[]"], #image_upload tbody input[name="pdf_files[]"]', function () {
                if ($(this).val().trim()) {
                    $(this).removeClass('is-invalid');
                }
            });

            // Form Validation
            $('#image_form').validate({
                rules: {
                    'title[]': {
                        required: true,
                        minlength: 3,
                    },
                    'pdf_files[]': {
                        required: true,
                        extension: "jpg|jpeg|png|gif|pdf",
                    }
                },
                messages: {
                    'title[]': "Please enter a valid title (at least 3 characters).",
                    'pdf_files[]': "Please upload a valid image file (jpg, jpeg, png, gif,pdf)."
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
        });



    </script>
    @endsection
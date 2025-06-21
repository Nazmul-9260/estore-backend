@extends('layouts.master')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Product Image</h5>
        </div>
        <div class="card-body">
            <form id="image_form" action="{{ url('config/product/productImageSave') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="data_id" value="{{ $data->id }}">
                <div class="w-100">
                    <table class="table table-hover table-bordered data-table dataTable-store dataTable" id="image_upload">
                        <thead>
                            <tr>
                                <td>Title</td>
                                <td>Sub-Title</td>
                                <td>Content</td>
                                <td>Image</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php    
                            $attr = [];
                            foreach ($imgData as $dt) {
                            ?>
                            <tr>
                                <td><?php echo $dt->title; ?></td>
                                <td><?php echo $dt->subtitle; ?></td>
                                <td><?php echo $dt->content; ?></td>
                                <td> 
                                    <img src="{{ asset($dt->product_image) }}" style="width: 10%; height:10%">
                                    <!--<a target="_blank" href="{{ asset('upload/productDetailsFile/' . $dt->product_image) }}"> {{$dt->product_image}} </a>-->
                                    <?php  ?>
                                </td>
                                <td>
                                    <a  class="btn btn-sm btn-danger remove-row button" data-id="<?php echo $dt->id; ?>" href="#"> Delete </a>
                                    {{-- <button type="button" href="{{ asset('upload/productDetailsFile/' . $dt->product_image) }}" class="btn btn-sm btn-danger remove-row button">Remove</button> --}}
                                </td>
                            </tr>
                            <?php 
                            } 
                            ?>

                            <tr>
                                <td><input class="form-control" type="text" placeholder="Product Title" name="title[]" required></td>
                                <td><input class="form-control" type="text" placeholder="Product Sub Title" name="sub_title[]" required></td>
                                <td><input class="form-control" type="text" placeholder="Product Content" name="content[]" required></td>
                                <td>
                                    <input type="file" class="form-control" name="images[]" required accept="image/*">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success add-more">Add More</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="w-100 pt-1 pb-1">
                        <button type="submit" class="btn btn-dark" id="saveBtn" value="save-data">Add Product</button>
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
                const imageField = $('#image_upload tbody tr:last input[name="images[]"]');
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
                            <td><input type="text" name="sub_title[]" placeholder="Product Sub Title" class="form-control"></td>
                            <td><input type="text" name="content[]" placeholder="Product Content" class="form-control"></td>
                            <td><input type="file" name="images[]" class="form-control" required accept="image/*"></td>
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
            $(document).on('input change', '#image_upload tbody input[name="title[]"], #image_upload tbody input[name="images[]"]', function () {
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
                    'images[]': {
                        required: true,
                        extension: "jpg|jpeg|png|gif",
                    }
                },
                messages: {
                    'title[]': "Please enter a valid title (at least 3 characters).",
                    'images[]': "Please upload a valid image file (jpg, jpeg, png, gif)."
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

@push('scripts')
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
                        url: "{{url('/config/product/deleteImg/')}}/"+id,
                        data: {id:id},
                        success: function (data) {
                                    swal({
                                        title: "Deleted!",
                                        text: "Your Product Image has been deleted.",
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
 
    </script>

@endpush

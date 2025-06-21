@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">
    <div class="card">
        <div class="card-header">
            <h5>Input Field Style</h5>
        </div>

        <div class="card-block custom-input-field">

            <div class="dynamic-btn col-1 m-0 pb-2">
                <button class="f-button click-event"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                <div class="dynamic-btn-wrap">
                    <ul>
                        <li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></li>
                        <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                        <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Input Field Error</label>
                        <input class="form-control custom-input-control form-control-danger" type="text" placeholder="Text">
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>Error Message</strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Input Field Success</label>
                        <input class="form-control custom-input-control form-control-success" type="text" placeholder="Text">
                        <span class="valid-feedback d-block" role="alert">
                            <strong>Success Message</strong>
                        </span>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Input Field</label>
                        <input class="form-control custom-input-control" type="text" placeholder="Text">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Input Field</label>
                        <input class="form-control custom-input-control" type="text" placeholder="Text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Input Field</label>
                        <input class="form-control custom-input-control" type="text" placeholder="Text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Input Field</label>
                        <input class="form-control custom-input-control" type="text" placeholder="Text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group custon-select">
                        <label for="exampleFormControlSelect2">Example select</label>
                        <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Input Field</label>
                        <input disabled="" class="form-control custom-input-control" type="text" placeholder="Text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label label-warning" for="exampleFormControlSelect1">Input Field</label>
                        <input class="form-control custom-input-control" type="text" placeholder="Text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Input Field</label>
                        <input class="form-control custom-input-control" type="text" placeholder="Text">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Upload File Drag & Drop</label>
                        <label class="form__container" id="upload-container">Choose or Drag & Drop Files
                            <input class="form__file" id="upload-files" type="file" multiple="multiple" />
                        </label>
                        <div id="files-list-container"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Upload File</label>
                        <input id="files" type="file" class="form-control custom-input-control fill field-upload">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Textarea</label>
                        <textarea class="form-control custom-textarea" name="textarea" cols="20" rows="8" placeholder="Message"></textarea>
                    </div>
                </div>
            </div>

            <div class="row m-t-10 text-left">
                <div class="col-12">
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            <span class="text-inverse">Checkbox style 1</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row m-t-10 text-left m-b-10">
                <div class="col-12">
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            <span class="text-inverse">Checkbox style 2</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row m-t-10 text-left m-b-10">
                <div class="col-12 custom-radio">
                    <label class="checkcontainer m-b-10">One
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkcontainer m-b-10">Two
                        <input type="radio" name="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkcontainer m-b-10">Three
                        <input type="radio" name="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkcontainer">Four
                        <input type="radio" name="radio">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>


            <div class="row">
                <div class="col-md-2">
                    <div class="form-group mt-2">
                        <button type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle dynamic-btn-wrap on button click
    // $(document).ready(function() {
    //     $('.click-event').on('click', function(event) {
    //         event.stopPropagation(); // Prevent click event from bubbling to the document
    //         $('.dynamic-btn-wrap').toggle(); // Toggle visibility
    //     });
    //     // Hide dynamic-btn-wrap when clicking outside of it
    //     $(document).on('click', function() {
    //         $('.dynamic-btn-wrap').hide(); // Hide the menu
    //     });
    //     // Prevent closing when clicking inside the dynamic-btn-wrap
    //     $('.dynamic-btn-wrap').on('click', function(event) {
    //         event.stopPropagation(); // Prevent click event from bubbling to the document
    //     });
    // });

    $(document).ready(function() {
        // Use delegated event binding for dynamically added rows
        $(document).on('click', '.click-event', function(event) {
            event.stopPropagation(); // Prevent bubbling
            const button = $(this); // Cache the clicked button
            const wrap = button.siblings('.dynamic-btn-wrap'); // Find the associated dynamic-btn-wrap

            // Hide all other .dynamic-btn-wrap elements
            $('.dynamic-btn-wrap').not(wrap).hide();

            // Toggle the specific dynamic-btn-wrap for the clicked button
            wrap.toggle();
            console.log('Dynamic button clicked');
        });

        // Hide dynamic-btn-wrap when clicking outside
        $(document).on('click', function() {
            $('.dynamic-btn-wrap').hide(); // Hide all menus
        });

        // Prevent hiding when clicking inside dynamic-btn-wrap
        $(document).on('click', '.dynamic-btn-wrap', function(event) {
            event.stopPropagation(); // Prevent bubbling
        });
    });
</script>

@endpush
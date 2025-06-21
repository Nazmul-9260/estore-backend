@extends('layouts.master')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid modal-redesign">
    <div class="card">
        <div class="card-header">
            <h5>Banner Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form class="redesign-form" action="{{ url('cms/cmsBanner/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Banner Title<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Sub Title<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="sub_title" name="sub_title"
                                            placeholder="Enter Sub Title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Content<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="bammer_content" name="content"
                                            placeholder="Enter Content">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Width<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="width" name="width"
                                            placeholder="Enter Width">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Height<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="height" name="height"
                                            placeholder="Enter Height">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Button Text<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="button_text" name="button_text"
                                            placeholder="Enter Button Text">
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Ordering</label>
                                    <div class="w-100">
                                        <select class="form-control" id="ordering" name="ordering">
                                            @php
                                                echo Modules\Config\Entities\Config::dropDownList('ordering');
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Button URL<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="button_url" name="button_url"
                                            placeholder="Enter Button URL">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Position</label>
                                    <div class="w-100">
                                        <select class="form-control" id="banner_position" name="banner_position">
                                            @php
                                                echo Modules\Config\Entities\Config::dropDownList('banner_position');
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Remarks</label>
                                    <div class="w-100">
                                        <textarea class="form-control" name="remarks" id="remarks" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Upload Image</label>
                                    <div class="w-100">
                                        <input type="file" class="form-control" id="banner_image" name="banner_image"
                                            onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                                            accept="image/*">
                                        <img id="blah2" alt="" class="img-fluid mt-1" style="width: 200px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-1 pb-1">
                                <button type="submit" class="btn btn-dark btn-sm" id="saveBtn"
                                    value="save-data">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
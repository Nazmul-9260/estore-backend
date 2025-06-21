@extends('layouts.master')
@section('header_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header text-white bg-info">
                <b>Product Info</b>
            </div>
            <div class="card-body"
                style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{url('config/product/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="data_id" value="{{$data->id}}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Category<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="category_id" id="category_id" required="">
                                                @php
                                                    echo Modules\Config\Entities\ProductCategory::getDropDownList('title', $data->category_id);
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Sub Category<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="subcategory_id" id="subcategory_id" required="">
                                                @php
                                                    echo Modules\Config\Entities\ProductSubCategory::getDropDownList('title', $data->subcategory_id);
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Product Name<span
                                            class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter Title" value="{{$data->title}}" maxlength="" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Product Code</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="code" name="code"
                                                placeholder="Enter Code" value="{{$data->code}}" maxlength="" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Unit</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="unit_id" id="unit_id" required>
                                                @php
                                                    echo Modules\Config\Entities\Unit::getDropDownList('title', $data->unit_id);
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Min. Order Qty.</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="min_order_qty" name="min_order_qty"
                                                placeholder="Enter Min. Order Qty." value="{{$data->min_order_qty}}" maxlength="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Size</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="size_id" name="size_id">
                                                @php
                                                    echo Modules\Config\Entities\Config::dropDownList('size', $data->size_id);
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Color</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="color_id" name="color_id">
                                                @php
                                                    echo Modules\Config\Entities\Config::dropDownList('color', $data->color_id);
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Details</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="details" id="details" rows="6"> @php
                                                echo $data->details
                                            @endphp </textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label">Upload Image</label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right pt-1 pb-1">
                                    <button type="submit" class="btn btn-primary" id="saveBtn" value="save-data">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection


@extends('layouts.master')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid modal-redesign">
    <div class="card">
        <div class="card-header">
            <h5>Product Info</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <ul id="tabs-nav" class="nav nav-tabs tabs d-flex flex-wrap tab-custon-menu" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab1">Basic Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab2">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab3">Feature and Image</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <form action="{{url('config/product/update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="data_id" value="{{$data->id}}">
                        <div class="tabs card-block p-0 pt-3 patient-tab">
                            <div class="tab-pane tab-content active" id="tab1">
                                <div class="table-user-list custom-table">
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Category<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <select class="form-control" name="category_id" id="category_id"
                                                    required>
                                                    @php
                                                        echo Modules\Config\Entities\ProductCategory::getDropDownList('title', $data->category_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Sub Category<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <select class="form-control" name="subcategory_id" id="subcategory_id"
                                                    required="">
                                                    @php
                                                        echo Modules\Config\Entities\ProductSubCategory::getDropDownList('title', $data->subcategory_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Product Name<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Enter Title" required value="{{$data->title}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Product brand</label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="code" name="brand"
                                                    placeholder="Enter brand" value="" maxlength="">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Size</label>
                                            <div class="cw-100">
                                                <select class="form-control" id="size_id" name="size_id">
                                                    @php
                                                        echo Modules\Config\Entities\Config::dropDownList('size', $data->size_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Product Code</label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="code" name="code"
                                                    placeholder="Enter Code" required value="{{$data->code}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Unit</label>
                                            <div class="w-100">
                                                <select class="form-control" name="unit_id" id="unit_id" required>
                                                    @php
                                                        echo Modules\Config\Entities\Unit::getDropDownList('title', $data->unit_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Model<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="model" name="model"
                                                    placeholder="Enter Model" value="{{$data->model}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Tax Class<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="tax_class" name="tax_class"
                                                    placeholder="Enter Tax Class" value="{{$data->tax_class}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Sales Price<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="sell_price"
                                                    name="sell_price" placeholder="Enter Sales Price"
                                                    value="{{$data->sell_price}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Color</label>
                                            <div class="w-100">
                                                <select class="form-control" id="color_id" name="color_id">
                                                    @php
                                                        echo Modules\Config\Entities\Config::dropDownList('color', $data->color_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <div class="form-group">
                                                <label for="name" class="w-100 control-label">Status</label>
                                                <div class="w-100">
                                                    <select class="form-control" name="status" id="status">
                                                        @php
                                                            echo Modules\Config\Entities\Config::dropDownList('active_status', $data->status);
                                                        @endphp
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Price Show Status</label>
                                            <div class="w-100">
                                                <select class="form-control" id="price_show_status" name="price_show_status">
                                                    @php
                                                        echo Modules\Config\Entities\Config::dropDownList('product_price_show_status', $data->price_show_status);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane tab-content" id="tab2">
                                <div class="table-user-list custom-table">
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Measurement<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="measurement"
                                                    name="measurement" placeholder="Enter Measurement"
                                                    value="{{$data->measurement}}">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Warranty<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="warranty" name="warranty"
                                                    placeholder="Enter Warranty" value="{{$data->warranty}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Code Category</label>
                                            <div class="cw-100">
                                                <select class="form-control" id="code_cat_id" name="code_cat_id">
                                                    @php
                                                        echo Modules\Config\Entities\Config::dropDownList('product_code_category', $data->code_cat_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Weight<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="weight" name="weight"
                                                    placeholder="Enter Weight" value="{{$data->weight}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Weight Unit</label>
                                            <div class="w-100">
                                                <select class="form-control" name="weight_unit_id" id="weight_unit_id"
                                                    required>
                                                    @php
                                                        echo Modules\Config\Entities\Unit::getDropDownList('title', $data->weight_unit_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Foreign Name<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="foreign_name"
                                                    name="foreign_name" placeholder="Enter Foreign Name"
                                                    value="{{$data->foreign_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Manufacturer<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="manufacturer"
                                                    name="manufacturer" placeholder="Enter Foreign Name"
                                                    value="{{$data->manufacturer}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Ordering</label>
                                            <div class="cw-100">
                                                <select class="form-control" id="ordering" name="ordering">
                                                    @php
                                                        echo Modules\Config\Entities\Config::dropDownList('ordering', $data->ordering);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Min. Order Qty.</label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="min_order_qty"
                                                    name="min_order_qty" placeholder="Enter Min. Order Qty."
                                                    value="{{$data->min_order_qty}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Width<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="width" name="width"
                                                    placeholder="Enter Width" value="{{$data->width}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Height<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <input type="text" class="form-control" id="height" name="height"
                                                    placeholder="Enter Height" value="{{$data->length_unit_id}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Length Unit</label>
                                            <div class="w-100">
                                                <select class="form-control" name="length_unit_id" id="length_unit_id"
                                                    required>
                                                    @php
                                                        echo Modules\Config\Entities\Unit::getDropDownList('title', $data->length_unit_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane tab-content" id="tab3">
                                <div class="table-user-list custom-table">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="name" class="w-100 control-label">Details</label>
                                            <div class="w-100">
                                                <textarea class="form-control" name="details" id="details"
                                                    rows="5">{{$data->details}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="name" class="w-100 control-label">Features</label>
                                            <div class="w-100">
                                                <textarea class="form-control" name="features" id="features"
                                                    rows="5">{{$data->features}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Country<span
                                                    class="text-danger">*</span></label>
                                            <div class="w-100">
                                                <select class="form-control" name="country_id" id="country_id">
                                                    @php
                                                        echo Modules\Config\Entities\Country::getDropDownList('title', $data->country_id);
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="name" class="w-100 control-label">Upload Image</label>
                                            <div class="w-100">
                                                <input type="file" class="form-control" id="image" name="image"
                                                    onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                                                    accept="image/*">
                                                <img id="blah2" alt="" class="img-fluid mt-1" style="width: 200px">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="prev-btn btn btn-secondary btn-sm" type="button">Previous</button>
                            <button class="next-btn btn btn-primary btn-sm" type="button">Next</button>
                            <button type="submit" class="btn btn-dark btn-sm" id="saveBtn"
                                value="save-data">Save</button>
                        </div>
                        <!-- <div class="w-100 pt-1 pb-1">
                            <button type="submit" class="btn btn-dark btn-sm" id="saveBtn" value="save-data">Save</button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
        <!-- olld data -->
        <!-- <div class="card-body"> 
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{url('config/product/update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="data_id" value="{{$data->id}}">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Category<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            @php
                                                echo Modules\Config\Entities\ProductCategory::getDropDownList('title', $data->category_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Sub Category<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <select class="form-control" name="subcategory_id" id="subcategory_id"
                                            required="">
                                            @php
                                                echo Modules\Config\Entities\ProductSubCategory::getDropDownList('title',$data->subcategory_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Product Name<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter Title" required value="{{$data->title}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Product Code</label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="code" name="code"
                                            placeholder="Enter Code" required value="{{$data->code}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Unit</label>
                                    <div class="w-100">
                                        <select class="form-control" name="unit_id" id="unit_id" required>
                                            @php
                                                echo Modules\Config\Entities\Unit::getDropDownList('title', $data->unit_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Min. Order Qty.</label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="min_order_qty" name="min_order_qty"
                                            placeholder="Enter Min. Order Qty." value="{{$data->min_order_qty}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Model<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="model" name="model"
                                            placeholder="Enter Model" value="{{$data->model}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Status</label>
                                    <div class="w-100">
                                        <select class="form-control" name="status" id="status">
                                            @php
                                                echo Modules\Config\Entities\Config::dropDownList('active_status',$data->status);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Size</label>
                                    <div class="cw-100">
                                        <select class="form-control" id="size_id" name="size_id">
                                            @php
                                                echo Modules\Config\Entities\Config::dropDownList('size',$data->size_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Color</label>
                                    <div class="w-100">
                                        <select class="form-control" id="color_id" name="color_id">
                                            @php
                                                echo Modules\Config\Entities\Config::dropDownList('color',$data->color_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Sales Price<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="sell_price" name="sell_price"
                                            placeholder="Enter Sales Price" value="{{$data->sell_price}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Tax Class<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="tax_class" name="tax_class"
                                            placeholder="Enter Tax Class" value="{{$data->tax_class}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Foreign Name<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="foreign_name" name="foreign_name"
                                            placeholder="Enter Foreign Name" value="{{$data->foreign_name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Manufacturer<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="manufacturer" name="manufacturer"
                                            placeholder="Enter Foreign Name" value="{{$data->manufacturer}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Ordering</label>
                                    <div class="cw-100">
                                        <select class="form-control" id="ordering" name="ordering">
                                            @php
                                                echo Modules\Config\Entities\Config::dropDownList('ordering', $data->ordering);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Country<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <select class="form-control" name="country_id" id="country_id">
                                            @php
                                                echo Modules\Config\Entities\Country::getDropDownList('title', $data->country_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Measurement<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="measurement" name="measurement"
                                            placeholder="Enter Measurement" value="{{$data->measurement}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Warranty<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="warranty" name="warranty"
                                            placeholder="Enter Warranty" value="{{$data->warranty}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Code Category</label>
                                    <div class="cw-100">
                                        <select class="form-control" id="code_cat_id" name="code_cat_id">
                                            @php
                                                echo Modules\Config\Entities\Config::dropDownList('product_code_category', $data->code_cat_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Weight<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="weight" name="weight"
                                            placeholder="Enter Weight" value="{{$data->weight}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Weight Unit</label>
                                    <div class="w-100">
                                        <select class="form-control" name="weight_unit_id" id="weight_unit_id" required>
                                            @php
                                                echo Modules\Config\Entities\Unit::getDropDownList('title',$data->weight_unit_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Upload Image</label>
                                    <div class="w-100">
                                        <input type="file" class="form-control" id="image" name="image"
                                            onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                                            accept="image/*">
                                        <img id="blah2" alt="" class="img-fluid mt-1" style="width: 200px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Details</label>
                                    <div class="w-100">
                                        <textarea class="form-control" name="details" id="details" rows="5">{{$data->details}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Features</label>
                                    <div class="w-100">
                                        <textarea class="form-control" name="features" id="features"
                                            rows="5">{{$data->features}}</textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Width<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="width" name="width"
                                            placeholder="Enter Width" value="{{$data->width}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Height<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="height" name="height"
                                            placeholder="Enter Height" value="{{$data->length_unit_id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Length Unit</label>
                                    <div class="w-100">
                                        <select class="form-control" name="length_unit_id" id="length_unit_id" required>
                                            @php
                                                echo Modules\Config\Entities\Unit::getDropDownList('title',$data->length_unit_id);
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-1 pb-1">
                                <button type="submit" class="btn btn-primary" id="saveBtn"
                                    value="save-data">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
    @endsection

    @push('scripts')

        <script>
            $(document).ready(function () {

                $('#tabs-nav a:first').addClass('active');
                $('.tab-content:first').addClass('active');


                $('#tabs-nav a').click(function (event) {
                    event.preventDefault();
                    $('#tabs-nav a').removeClass('active');
                    $('.tab-content').removeClass('active');

                    $(this).addClass('active');
                    var activeTab = $(this).attr('href');
                    $(activeTab).addClass('active');
                });


                $('.dropdown-item').click(function (event) {
                    event.preventDefault();
                    $('#tabs-nav a').removeClass('active');
                    $('.tab-content').removeClass('active');

                    var activeTab = $(this).attr('href');
                    $(activeTab).addClass('active');
                });
            });

            $(document).ready(function () {
                $('ul.md-tabs li:first-child a').addClass('active');
            });
            $(document).ready(function () {
                // Initialize variables
                const $tabs = $('.nav-link'); // All tab links
                const $panes = $('.tab-pane'); // All tab content panes
                const $nextBtn = $('.next-btn'); // Next button
                const $prevBtn = $('.prev-btn'); // Previous button
                const $saveBtn = $('#saveBtn'); // Save button (initially hidden)

                // Function to update button states
                function updateButtons() {
                    const activeIndex = $tabs.index($('.nav-link.active')); // Get the index of the active tab

                    // Disable "Previous" button on the first tab
                    $prevBtn.prop('disabled', activeIndex === 0);

                    // Show "Save" button only on the last tab
                    if (activeIndex === $tabs.length - 1) {
                        $nextBtn.hide(); // Hide the "Next" button
                        $saveBtn.show(); // Show the "Save" button
                    } else {
                        $nextBtn.show(); // Show the "Next" button
                        $saveBtn.hide(); // Hide the "Save" button
                    }
                }

                // Function to go to the next tab
                function goToNextTab() {
                    const activeTab = $('.nav-link.active');
                    const nextTab = activeTab.parent().next().find('.nav-link');

                    if (nextTab.length) {
                        nextTab.click(); // Trigger click event for the next tab
                    }
                }

                // Function to go to the previous tab
                function goToPrevTab() {
                    const activeTab = $('.nav-link.active');
                    const prevTab = activeTab.parent().prev().find('.nav-link');

                    if (prevTab.length) {
                        prevTab.click(); // Trigger click event for the previous tab
                    }
                }

                // Event listener for the "Next" button
                $nextBtn.on('click', function () {
                    goToNextTab();
                });

                // Event listener for the "Previous" button
                $prevBtn.on('click', function () {
                    goToPrevTab();
                });

                // Update button states when a tab is clicked
                $tabs.on('click', function () {
                    const $this = $(this);

                    // Set active tab and corresponding content pane
                    $tabs.removeClass('active');
                    $panes.removeClass('active show');
                    $this.addClass('active');
                    $(`#${$this.attr('href').substring(1)}`).addClass('active show');

                    // Update button states
                    updateButtons();
                });

                // Initial button state update
                updateButtons();
            });
        </script>



    @endpush
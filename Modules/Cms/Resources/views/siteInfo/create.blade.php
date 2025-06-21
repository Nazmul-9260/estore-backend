@extends('layouts.master')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid category-area modal-redesign">
    <div class="card">
        <div class="card-header">
            <h5>Site Info</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form class="redesign-form" action="{{ url('cms/siteInfo/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Site Name<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="site_name" name="site_name"
                                            placeholder="Enter Site Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Phone</label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Email</label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Moto</label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="moto" name="moto"
                                            placeholder="Enter Moto">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Site Title</label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="site_title" name="site_title"
                                            placeholder="Enter Site Title">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Upload Favicon</label>
                                    <div class="w-100">
                                        <input type="file" class="form-control" id="favicon" name="favicon"
                                            onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                                            accept="image/*">
                                        <img id="blah2" alt="" class="img-fluid mt-1" style="width: 200px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Domain Name</label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="domain_name" name="domain_name"
                                            placeholder="Enter Domain Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Meta Type<span
                                            class="text-danger">*</span></label>
                                    <div class="w-100">
                                        <input type="text" class="form-control" id="meta_type" name="meta_type"
                                            placeholder="Enter Meta Type" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="w-100 control-label">Upload Logo</label>
                                    <div class="w-100">
                                        <input type="file" class="form-control" id="logo" name="logo"
                                            onchange="document.getElementById('blah3').src = window.URL.createObjectURL(this.files[0])"
                                            accept="image/*">
                                        <img id="blah3" alt="" class="img-fluid mt-1" style="width: 200px">
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
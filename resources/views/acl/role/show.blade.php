@extends('layouts.master')

@section('content')


<div class="page-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Role</h5>
                </div>
                <div class="card-block p-0 form-estore">
                    <div class="card-block ard-block-user custom-input-field p-b-10 p-t-15 section-blog-card">
                        <h6 class="group-title">Role Infomation</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="float-label" for="name">Role Name</label>
                                    <input name="name" class="form-control fill capitalize" type="text" value="{{$role->name}}" readonly>
                                    <span class="form-bar"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="float-label" for="name">Keyword to use</label>
                                    <input name="name" class="form-control fill" type="text" value="{{$role->name}}" readonly>
                                    <span class="form-bar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <div class="card m-b-0">
                                        <div class="card-block">
                                            <p class="m-0" style="font-weight: 600;"> {{$role->description}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection
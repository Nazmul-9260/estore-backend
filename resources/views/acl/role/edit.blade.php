@extends('layouts.master')

@section('content')


<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{url('acl/roles/'. $role->id)}}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Role</h5>
                    </div>
                    <div class="card-block p-0">
                        <div class="card-block ard-block-user custom-input-field p-b-10 p-t-15 section-blog-card">
                            <h6 class="group-title">Role Infomation</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-default">
                                        <label class="float-label" for="name">Role Name</label>
                                        <input name="name" class="form-control custom-input-control @error('name') form-control-danger @enderror" type="text" value="{{$role->name}}">
                                        <span class="form-bar"></span>
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('name')
                                            <strong>{{$errors->first('name')}}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group mt-2">
                            <button type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>

@endsection
@extends('layouts.master')

@section('content')


<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <form class="form-estore" method="POST" action="{{url('acl/modules')}}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>Create New Module</h5>
                    </div>
                    <div class="card-block p-0">
                        <div class="card-block ard-block-user custom-input-field p-b-10 p-t-15 section-blog-card">
                            <h6 class="group-title">Module Infomation</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-default">
                                        <label class="float-label" for="name">Module Name</label>
                                        <input name="name" placeholder="Module Name" class="form-control @error('name') form-control-danger @enderror" type="text" value="{{old('name')}}">
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
                    <div class="col-md-2 max-w-100">
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
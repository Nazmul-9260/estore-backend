@extends('layouts.master')

@section('content')


<div class="page-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create New Contact</h5>
                </div>
                <div class="card-block">

                    <form method="POST" action="{{url('contact/contacts')}}">
                        @csrf

                        <div class="card-block custom-input-field form-estore">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" placeholder="Name" class="form-control custom-input-control @error('name') form-control-danger @enderror" type="text" value="{{old('name')}}">
                                        <span class="invalid-feedback d-block" role="alert">
                                            <!-- <strong>Error Name</strong> -->
                                            @error('name')
                                            <strong>{{$errors->first('name')}}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input name="phone" class="form-control custom-input-control @error('phone') form-control-danger @enderror" type="number" placeholder="(+880)" value="{{old('phone')}}">
                                        <span class="invalid-feedback d-block" role="alert">
                                            <!-- <strong>Error Phone</strong> -->
                                            @error('phone')
                                            <strong>{{$errors->first('phone')}}</strong>
                                            @enderror

                                        </span>
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
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



</div>

@endsection
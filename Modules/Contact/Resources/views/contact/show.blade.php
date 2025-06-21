@extends('layouts.master')

@section('content')


<div class="page-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Contact</h5>
                    <a href="{{url('contact/contacts/create')}}" class="btn waves-effect waves-light btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Add Contact</a>
                    @include('layouts.partials.page-widget')
                </div>
                <div class="card-block">
                    <div class="card-block custom-input-field">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" class="form-control custom-input-control" type="text" value="{{$contact->name}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input name="phone" class="form-control custom-input-control" type="number" placeholder="(+880)" value="{{$contact->phone}}" readonly>
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
@extends('layouts.master')

@section('content')


<div class="page-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Permission</h5>
                </div>
                <div class="card-block form-material">
                    <div class="card-block custom-input-field">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-default">
                                    <input name="name" class="form-control fill" type="text" value="{{$permission->name}}" readonly>
                                    <span class="form-bar"></span>
                                    <label class="float-label" for="name">Permission Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-default">
                                    <input name="name" class="form-control fill" type="text" value="{{$permission->submodule?$permission->submodule->name:'No submodule attached'}}" readonly>
                                    <span class="form-bar"></span>
                                    <label class="float-label" for="name">Submodule Attached</label>
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
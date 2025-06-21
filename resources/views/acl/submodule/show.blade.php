@extends('layouts.master')

@section('content')


<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Submodule</h5>
                </div>
                <div class="card-block p-0 form-material">
                    <div class="card-block ard-block-user custom-input-field p-b-10 p-t-15 section-blog-card">
                        <h6 class="group-title">Submodule Infomation</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-default m-b-0">
                                    <input name="name" class="form-control fill" type="text" value="{{$submodule->name}}" readonly>
                                    <span class="form-bar"></span>
                                    <label class="float-label" for="name">Submodule Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-default m-b-0">
                                    <input name="name" class="form-control fill" type="text" value="{{$submodule->module?$submodule->module->name:'No module attached'}}" readonly>
                                    <span class="form-bar"></span>
                                    <label class="float-label" for="name">Module Attached</label>
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
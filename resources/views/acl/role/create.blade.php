@extends('layouts.master')

@section('content')


<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <form class="form-estore" method="POST" action="{{url('acl/roles')}}">
             @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>Create New Role</h5>
                    </div>
                    <div class="card-block p-0">
                        <div class="card-block ard-block-user custom-input-field p-b-10 p-t-15 section-blog-card">
                            <h6 class="group-title">Role Infomation</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-default">
                                        <label class="float-label" for="name">Role Name</label>
                                        <input name="name" placeholder="Role Name" class="form-control @error('name') form-control-danger @enderror" type="text" value="{{old('name')}}">
                                        <span class="form-bar"></span>                                    
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('name')
                                            <strong>{{$errors->first('name')}}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-default">
                                        <label for="name">Description</label>
                                        <textarea placeholder="Description" rows="3" cols="30" name="description" class="form-control @error('description') form-control-danger @enderror" value="{{old('name')}}" required></textarea>
                                        <span class="form-bar"></span>
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('description')
                                            <strong>{{$errors->first('description')}}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-t-10"></div>
                        <div class="section-blog-card">
                            <h6 class="group-title">Role Wise Permission</h6>
                            <div class="card-block p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card m-b-0 shadow-none">
                                            <!-- Modules -->
                                            @if(count($modules)>0)
                                            @foreach($modules as $module)
                                            <div class="card-row module-area">
                                                <div class="card-header- p-t-10">
                                                    <h6 class="sub-title m-b-0 font-600 p-b-6">{{$module->name}}</h6>
                                                </div>
                                                <div class="card-block card-block-col">
                                                    <!-- Submodules -->
                                                    @if(count($module->submodules)>0)
                                                    @foreach($module->submodules as $submodule)
                                                    <div class="card-block-area submodule-area">
                                                        <h6>{{$submodule->name}}</h6>
                                                        <div class="checkbox-fade-group d-flex flex-wrap">
                                                            <!-- Permissions -->
                                                            @if(count($submodule->permissions)>0)
                                                            @foreach($submodule->permissions as $permission)
                                                            <div class="checkbox-fade fade-in-primary permission-area">
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}" id="{{$permission->name}}">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                    <span class="text-inverse">{{$permission->name}}</span>
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                            @else
                                                            <p>No permission found.</p>
                                                            @endif
                                                            <!-- Permissions -->
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <p>No submodule found.</p>
                                                    @endif
                                                    <!-- Submodules -->
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <p>No Module Found.</p>
                                            @endif
                                            <!-- Modules -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-2 max-w-100">
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
@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <form class="form-material" method="POST" action="{{url('acl/roles/'.$role->id.'/update-details')}}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>Role Details</h5>
                    </div>
                    <div class="card-block p-0 module-area edit-meta">
                        <div class="card-block ard-block-user custom-input-field p-b-10 p-t-15 section-blog-card">
                            <h6 class="group-title">Role Infomation</h6>
                            <div class="row d-block m-0">
                                <div class="col-md-5">
                                    <div class="form-group pb-2 form-default">
                                        <label>Role Name</label>
                                        <input class="form-control capitalize" name="name" readonly type="text" placeholder="Admin" value="{{$role->name}}">
                                        <span class="form-bar"></span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-default">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" cols="10" rows="2" placeholder="Description">{{$role->description}}</textarea>
                                        <span class="form-bar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                                <input type="checkbox" name="permissions[]" value="{{$permission->name}}" id="{{$permission->name}}" {{in_array($permission->name, $roleAssocitedPermissionsNames->toArray())?'checked':''}}>
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
                <div class="row">
                    <div class="card-block card-block-col w-100">
                        <div class="col-md-2 max-w-100">
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



@endsection
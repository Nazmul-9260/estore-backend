@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Role Details</h5>
                </div>
                <div class="card-row module-area"> 
                    <div class="card-block custom-input-field">
                        <div class="row d-block">
                            <div class="col-md-5">
                                <div class="form-group pb-2">
                                    <label>Role Name</label>
                                    <input class="form-control custom-input-control" readonly type="text" placeholder="Admin">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                <label>Description</label>
                                    <textarea class="form-control custom-textarea" readonly name="textarea" cols="20" rows="6" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-row module-area"> 
                    <div class="card-header">
                        <h5>User Management</h5>
                    </div>
                    <div class="card-block card-block-col">
                        <div class="card-block-area submodule-area">
                            <h6>Role</h6>
                            <div class="checkbox-fade-group d-flex flex-wrap">
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input checked type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">create-roles</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">edit-roles</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">view-roles</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">delete-roles</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">assign-permissions</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-block-area submodule-area">
                            <h6>Permission</h6>
                            <div class="checkbox-fade-group d-flex flex-wrap">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">create-permissions</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">edit-permissions</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">view-permissions</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">delete-permissions</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">attach-submodule</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">1-models</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">2-models</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">3-models</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">4-models</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-row module-area"> 
                    <div class="card-header">
                        <h5>Bank</h5>
                    </div>
                    <div class="card-block card-block-col">
                        <div class="card-block-area submodule-area">
                            <h6>Account</h6>
                            <div class="checkbox-fade-group d-flex flex-wrap">
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Checkbox style 1</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Checkbox style 1</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary permission-area">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Checkbox style 1</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-block-area submodule-area">
                            <h6>Employee</h6>
                            <div class="checkbox-fade-group d-flex flex-wrap">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Checkbox style 1</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Checkbox style 1</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Checkbox style 1</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-block-area submodule-area">
                            <h6>Salary</h6>
                            <div class="checkbox-fade-group d-flex flex-wrap">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Checkbox style 1</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Checkbox style 1</span>
                                    </label>
                                </div>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">edit-users 1</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-block card-block-col pt-0">
                    <div class="col-md-2 p-0">
                        <div class="form-group mt-2">
                            <button type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Submit</button>
                        </div>
                    </div>
                   
                </div>

            </div>


        </div>

    </div>




</div>



@endsection
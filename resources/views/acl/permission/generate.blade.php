@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <form class="form-material" method="POST" action="{{url('acl/permissions/generate')}}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>Generate Permissions</h5>
                    </div>
                    <!-- Form Inputs -->

                    <div class="section-blog-card">
                        <h6 class="group-title">Resource Controller Wise Permissions</h6>

                        <div class="checkbox-fade fade-in-primary permission-area">

                            <label>
                                <input value="check-all" type="checkbox" id="check-all" class="check-all" name="check_all">
                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                <span class="text-inverse"> Select All</span>
                            </label>

                        </div>

                        <div class="card-block p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card m-b-0 shadow-none">
                                        <!-- Modules -->
                                        @if(count($controllersWithMethods)>0)
                                        @foreach($controllersWithMethods as $controllerGroupName => $controllerGroupMethods)
                                        <div class="card-row module-area">
                                            <div class="card-header- p-t-10">


                                                <div class="checkbox-fade fade-in-primary permission-area">

                                                    <label>
                                                        <input value="{{$controllerGroupName}}" type="checkbox" id="{{$controllerGroupName}}" class="{{$controllerGroupName}} controller-group" name="{{$controllerGroupName}}">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        <span class="text-inverse"> {{$controllerGroupName }}</span>
                                                    </label>

                                                </div>


                                            </div>
                                            <div class="card-block card-block-col">
                                                <!-- Methods -->
                                                @if(count($controllerGroupMethods)>0)
                                                <div class="card-block-area submodule-area d-flex flex-wrap gaps">
                                                    <!-- @if(count(array_diff($controllerGroupMethods, $permissionsExist->toArray())) == 0)
                                                    <p>No method permisssion to generate found.</p>
                                                    @endif -->
                                                    @php
                                                    $noPermissionFound = true;
                                                    @endphp
                                                    @foreach($controllerGroupMethods as $method)
                                                    @php

                                                    $permissionsMethodName = $controllerGroupName. '.' . $method;

                                                    @endphp

                                                    <!-- <div class="card-block-area submodule-area d-flex flex-wrap"> -->
                                                    @if(!in_array( $permissionsMethodName, $permissionsExist->toArray()))
                                                    @php
                                                    $noPermissionFound = false;

                                                    @endphp

                                                    <div class="checkbox-fade fade-in-primary permission-area">
                                                        <label>
                                                            <input type="checkbox" class="{{$controllerGroupName}}" name="permissions[]" value="{{$permissionsMethodName}}" id="{{$permissionsMethodName}}">
                                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                            <span class="text-inverse">{{$permissionsMethodName}}</span>
                                                        </label>
                                                    </div>

                                                    @endif
                                                    <!-- </div> -->

                                                    @endforeach
                                                    @if($noPermissionFound)
                                                    <p>No method permisssion to generate.</p>
                                                    @endif
                                                </div>
                                                @else
                                                <p>No method found.</p>
                                                @endif
                                                <!-- Methods -->
                                            </div>

                                        </div>
                                        @endforeach
                                        @else
                                        <p>No Controller Found.</p>
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

@push('scripts')

<script>
    $(document).ready(function() {
        console.log('ready');

        $(document.body).on('change', '#check-all', function(event) {
            console.log('Checbox clicked value', $(this).val());
            var groupCheckboxInputValue = $(this).val();
            // Check if it is checked or not
            var checked = this.checked;
            console.log(groupCheckboxInputValue + ' all check status: ' + checked);

            if (checked) {
                $('input[type="checkbox"]').each(function(index, elem) {
                    $(elem).prop('checked', true)
                })
            }
            if (!checked) {
                $('input[type="checkbox"]').each(function(index, elem) {
                    $(elem).prop('checked', false)
                })
            }

        })

        $(document.body).on('change', '.controller-group', function(event) {
            console.log('Checbox clicked value', $(this).val());
            var groupCheckboxInputValue = $(this).val();
            // Check if it is checked or not
            var checked = this.checked;
            console.log(groupCheckboxInputValue + ' check status: ' + checked);

            if (checked) {
                $('.' + groupCheckboxInputValue).each(function(index, elem) {
                    $(elem).prop('checked', true)
                })
            }
            if (!checked) {
                $('.' + groupCheckboxInputValue).each(function(index, elem) {
                    $(elem).prop('checked', false)
                })
            }

        })

    })
</script>

@endpush
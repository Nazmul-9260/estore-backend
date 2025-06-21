@extends('layouts.master')

@section('content')


<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <form id="formuserpass" class="form-estore" method="POST" action="{{url('acl/users')}}">
                @csrf
                <div class="card m-b-20">
                    <div class="card-header m-b-15">
                        <h5>Create New User</h5>
                    </div>
                    <div class="card-block p-0">
                        <div class="card-block ard-block-user custom-input-field p-b-10 p-t-15 section-blog-card">
                            <h6 class="group-title">User Basic Information</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-default">
                                        <label class="float-label" for="name">Display Name</label>
                                        <input id="name" type="text" name="name" placeholder="Name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                        <span class="form-bar"></span>
                                        <small class="error-msg"></small>
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('name')
                                            <strong>{{$errors->first('name')}}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group custon-select form-default">
                                        <label class="float-label" for="email">Email/Username</label>
                                        <input id="email" type="email" name="email" placeholder="Email"  class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                        <span class="form-bar"></span>
                                        <small class="error-msg"></small>
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('email')
                                            <strong>{{$errors->first('email')}}</strong>
                                            @enderror
                                        </span>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group form-default">
                                        <label for="role-id" class="float-label">Select User Role</label>
                                        <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="role_id[]" id="role-id">
                                            @foreach($roles as $role)
                                            <option class="clickable" value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-bar"></span>
                                        <small class="error-msg"></small>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group custon-select form-default">
                                        <label class="float-label" for="password">Password</label>
                                        <input id="password" type="password" placeholder="Password" name="password" class="form-control  @error('password') is-invalid @enderror">
                                        <span class="form-bar"></span>
                                        <small class="error-msg"></small>
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('password')
                                            <strong>{{$errors->first('password')}}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group custon-select form-default">
                                        <label class="float-label" for="exampleFormControlSelect2">Confirm Password</label>
                                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                        <span class="form-bar"></span>
                                        <small class="error-msg"></small>
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('password')
                                            <strong>{{$errors->first('password')}}</strong>
                                            @enderror
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-blog-card">
                        <h6 class="group-title">Module Wise Permission</h6>
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
                <div class="row">
                    <div class="col-md-2 max-w-100">
                        <div class="form-group mt-2">
                            <button type="submit"  id="submitFrom"class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Submit</button>
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
        var form = $("#formuserpass");

        form.on("submit", function(event) {
            var isValid = true;

        // Get form input elements
        var name = $("#name");
        var email = $("#email");
        var password = $("#password");
        var passwordConfirm = $("#password-confirm");
        var role = $("#role-id"); // corrected id from ruserRole to userRole

            // Clear previous errors
            clearError(name);
            clearError(email);
            clearError(password);
            clearError(passwordConfirm);
            clearError(role);

            // Validate Name
            if (name.val().trim() === "") {
                showError(name, "First Name is required.");
                isValid = false;
            }

            // Validate Email (basic format validation)
            var emailPattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
            if (!emailPattern.test(email.val())) {
                showError(email, "Please enter a valid email.");
                isValid = false;
            }

            // Validate Password (at least 8 characters)
            if (password.val().length < 8) {
                showError(password, "Password must be at least 8 characters long.");
                isValid = false;
            }

            // Validate Password Confirmation
            if (passwordConfirm.val() !== password.val()) {
                showError(passwordConfirm, "Passwords do not match.");
                isValid = false;
            }

            // Validate User Role (at least one role selected)
            if (role.prop('selectedOptions').length === 0) {
                showError(role, "Please select at least one user role.");
                isValid = false;
            }

            // If form is not valid, prevent form submission
            if (!isValid) {
                event.preventDefault(); // Prevent form submission
            }
        });

        // Function to show error
        function showError(input, message) {
            var formGroup = input.closest(".form-group");
            var errorMsg = formGroup.find(".error-msg");
            formGroup.addClass("error");
            errorMsg.text(message).show();
        }

        // Function to clear error
        function clearError(input) {
            var formGroup = input.closest(".form-group");
            var errorMsg = formGroup.find(".error-msg");

            formGroup.removeClass("error");
            errorMsg.text("").hide();

        }
    });
</script>




<script>
    $(document).ready(function() {
        // Init read-only state of selectboxes 
        $('input[type="checkbox"]').on('click', function(e) {
            e.preventDefault(); // Prevent clicking to achieve a readonly-like behavior
        });

        // Initialize Select2 with placeholder
        $(".multipleSelect2").select2({
            placeholder: "" // Set your placeholder here
        });

        // Handle focus and blur for moving the label like Material Design
        $('.multipleSelect2').on('select2:open', function(e) {
            var label = $(this).parent().find('.select2-label');
            label.addClass('active'); // Add class to move label up when interacting with the field
        });

        $('.multipleSelect2').on('select2:close', function(e) {
            var label = $(this).parent().find('.select2-label');
            if ($(this).val() === null || $(this).val().length === 0) {
                label.removeClass('active'); // Move label down if no selection was made
            }
        });

        // When an item is selected, move the label up
        $('.multipleSelect2').on('select2:select', function(e) {
            var label = $(this).parent().find('.select2-label');
            label.addClass('active'); // Keep the label up when an option is selected
            $(this).parent().find('.select2-selection__placeholder').remove(); // Remove placeholder once selected
        });

        // When all items are unselected, revert the label position
        $('.multipleSelect2').on('select2:unselect', function(e) {
            var label = $(this).parent().find('.select2-label');
            if ($(this).val() === null || $(this).val().length === 0) {
                label.removeClass('active'); // Move the label down if no options are selected
            }
        });




        //
        $('#role-id').on('change', function(e) {
            var roleId = $('#role-id').val();
            console.log('Now roles:', roleId);
            if (Array.isArray(roleId) && (roleId.length > 0)) {

                //
                $.ajax({
                    url: "{{url('acl/roles/get-permissions-by-roles')}}",
                    method: 'GET',
                    data: {
                        roles: roleId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        //
                        $('input[type="checkbox"]').prop('checked', false);
                        data.forEach((el) => {
                            setPermissionCheckedUI(el);
                        })
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
                //

            } else {

                console.log('Role Not Valid:', roleId);
                $('input[type="checkbox"]').prop('checked', false);

            }
            //
        })

        function getPermissionsByRoleId(roleId) {

            return new Promise((resolve, reject) => {

                //
                $.ajax({
                    url: '/get-permissions-by-role',
                    method: 'GET',
                    data: {
                        roleId: roleId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        //console.log(data);
                        resolve(data);
                    },
                    error: function(err) {
                        //console.log(err);
                        reject(err);
                    }
                })
                //
            })
        }

        //

        function getPermissionsByRoles(roles) {

            return new Promise((resolve, reject) => {

                //
                $.ajax({
                    url: '/get-permissions-by-roles',
                    method: 'GET',
                    data: {
                        roles: roles,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log('roles pers succ:', data);
                        //resolve(data);
                    },
                    error: function(err) {
                        console.log('roles pers err:', err);
                        //reject(err);
                    }
                })
                //
            })
        }

        //

        function setPermissionCheckedUI(el) {
            var componentIdString = String(el).replace(' ', '-');
            //console.log(componentIdString);
            var componentId = `#${componentIdString}`;
            $(componentId).prop('checked', true);
        }

        //

        function setPermissionUncheckedUI(el) {
            var componentIdString = String(el).replace(' ', '-');
            //console.log(componentIdString);
            var componentId = `#${componentIdString}`;
            $(componentId).prop('checked', false);
        }

    })
</script>

@endpush
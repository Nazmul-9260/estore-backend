@extends('layouts.master')

@section('content')

<div class="page-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>User Settings</h5>
                </div>

                <div class="card-block table-border-style">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tab-and-button d-flex flex-nowrap justify-content-between">
                                <div class="sub-title-item d-flex flex-nowrap align-items-center">
                                    <h6>With Selected</h6>
                                    <div class="selected-items d-flex flex-nowrap">
                                        <a href="#" id="bulk-user-activate" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Activate</a>
                                        <a href="#" id="bulk-user-deactivate" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Deactivate</a>
                                        <a href="#" id="bulk-user-delete" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Delete</a>
                                        <a href="#" id="edit-user-details" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="#" id="edit-user-direct-permissions" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Custom Permission</a>
                                    </div>
                                </div>
                                <div class="selected-items">
                                    <a href="{{route('acl.users.create')}}" class="btn btn-primary custom-btn"><i class="fa fa-plus"></i> Create User</a>
                                </div>
                            </div>

                            <!-- Nav tabs -->

                            <ul id="tabs-nav" class="nav nav-tabs tabs d-flex flex-wrap tab-custon-menu" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-filter="all" href="#all-users">All Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-filter="inactive" href="#inactive-users">Inactive</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-filter="banned" href="#banned-users">Banned</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-filter="deleted" href="#deleted-users">Deleted</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="filter-by-role-dropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">By Role</a>
                                    <div class="dropdown-menu" id="filter-by-role">
                                        <!-- <a class="dropdown-item" href="#Administrator">Administrator</a>
                                        <a class="dropdown-item" href="#Doctor">Doctor</a> -->
                                        @foreach($roles as $role)
                                        <a href="#{{str_replace(' ','-',$role->name)}}" class="dropdown-item" data-filter="role" data-role="{{str_replace(' ','-',$role->name)}}" id="tab-{{str_replace(' ','-',$role->name)}}">{{$role->name}}</a>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tabs card-block p-0 pt-3">
                                <div class="tab-pane tab-content active" id="all-users">
                                    @include('acl.user.partials.user-list', ['users'=> $users])
                                    @include('acl.user.partials.user-list-pagination', ['users'=> $users])
                                </div>


                                <div class="tab-pane tab-content" id="inactive-users">
                                    <p class="text-center pw">Please wait ...</p>
                                </div>
                                <div class="tab-pane tab-content" id="banned-users">
                                    <p class="text-center">Please wait ...</p>
                                </div>
                                <div class="tab-pane tab-content" id="deleted-users">
                                    <p class="text-center">Please wait ...</p>
                                </div>
                                <!-- <div class="tab-pane tab-content" id="Administrator">
                                    <p class="text-center">Please wait Ad...</p>
                                </div>
                                <div class="tab-pane tab-content" id="Doctor">
                                    <p class="text-center">Please wait Doctor...</p>
                                </div> -->

                                @foreach($roles as $role)
                                <div class="tab-pane tab-content" id="{{str_replace(' ','-',$role->name)}}">
                                    <p class="text-center">Please wait ...</p>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel"><i class="fa fa-check-circle" aria-hidden="true"></i> Confirm </h5>
                <button type="button" class="close border-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i> </span></button>
            </div>
            <div class="modal-body">
                Are you sure you want to <span id="actionType"></span> this role?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" id="confirmAction"><i class="fa fa-check"></i> Yes, Confirm</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script>
    /** Gloabal States */
    let actionData = {};
    var filter = '';
    var role = '';
    $(document).ready(function() {
        /**
         * Feat
         */
        /** Multi select user role sync service */
        initMultiSlect()
        //
        bindMultiSelectEventListeners();

        // Show confirmation modal
        function showModal(action) {
            $('#actionType').text(action === 'add' ? 'add' : 'remove');
            $('#confirmationModal').modal('show');
        }

        /**
         * Feat
         */
        /** Edit User Direct permissions  */
        $('#edit-user-direct-permissions').on('click', function(event) {
            event.preventDefault();
            var selectedUsers = [];
            //
            $('.user-select:checked').each((i, el) => {
                selectedUsers.push($(el).val());
            })
            if (selectedUsers.length > 0) {
                var userId = selectedUsers[0];
                var uriTemplate = "{{url('acl/users/{user}/edit-custom-permissions')}}";
                var uri = uriTemplate.replace('{user}', userId);
                window.location.href = uri;
            } else {
                Swal.fire({
                    title: 'Please Wait!',
                    titleText: 'Select at least one user to continue',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }
        })

        /**
         * Feat
         */
        /** Edit User Details  */
        $('#edit-user-details').on('click', function(event) {
            event.preventDefault();
            var selectedUsers = [];
            //
            $('.user-select:checked').each((i, el) => {
                selectedUsers.push($(el).val());
            })
            if (selectedUsers.length > 0) {
                var userId = selectedUsers[0];
                var uriTemplate = "{{url('acl/users/{user}/edit')}}";
                var uri = uriTemplate.replace('{user}', userId);
                window.location.href = uri;
            } else {
                Swal.fire({
                    title: 'Please Wait!',
                    titleText: 'Select at least one user to continue',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }
        })

        /**
         * Feat
         */
        /** Bulk Users Activate  */
        $('#bulk-user-activate').on('click', function(event) {
            event.preventDefault();
            initPlugins();
            var selectedUsers = [];
            //
            $('.user-select:checked').each((i, el) => {
                selectedUsers.push($(el).val());
            })
            if (selectedUsers.length > 0) {

                var uri = "{{route('acl.user.active_users')}}";
                var method = 'POST';
                $('#user-list-bulk-ops').prop('action', uri);
                $('#user-list-bulk-ops').prop('method', method);
                // let usersInput = $("<input>")
                //     .attr("type", "hidden")
                //     .attr("name", "users[]")
                //     .val(selectedUsers.join(','));
                selectedUsers.forEach(function(val, index) {
                    let usersInput = $("<input>")
                        .attr("type", "hidden")
                        .attr("name", "users[]")
                        .val(selectedUsers[index]);
                    $('#user-list-bulk-ops').append(usersInput);
                })
                $('#user-list-bulk-ops').submit();
            } else {
                Swal.fire({
                    title: 'Please Wait!',
                    titleText: 'Select at least one user to continue',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }
        })

        /**
         * Feat
         */
        /** Bulk Users Deactivate  */
        $('#bulk-user-deactivate').on('click', function(event) {
            event.preventDefault();
            var selectedUsers = [];
            //
            $('.user-select:checked').each((i, el) => {
                selectedUsers.push($(el).val());
            })
            if (selectedUsers.length > 0) {
                var uri = "{{route('acl.user.deactive_users')}}";
                var method = 'POST';
                $('#user-list-bulk-ops').prop('action', uri);
                $('#user-list-bulk-ops').prop('method', method);
                $('#user-list-bulk-ops').submit();

            } else {
                Swal.fire({
                    title: 'Please Wait!',
                    titleText: 'Select at least one user to continue',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }
        })

        /**
         * Feat
         */
        /** Bulk Users Delete  */
        $('#bulk-user-delete').on('click', function(event) {
            event.preventDefault();
            var selectedUsers = [];
            //
            $('.user-select:checked').each((i, el) => {
                selectedUsers.push($(el).val());
            })
            if (selectedUsers.length > 0) {
                var uri = "{{route('acl.user.delete_users')}}";
                var method = 'POST';
                $('#user-list-bulk-ops').prop('action', uri);
                $('#user-list-bulk-ops').prop('method', method);
                $('#user-list-bulk-ops').submit();

            } else {
                Swal.fire({
                    title: 'Please Wait!',
                    titleText: 'Select at least one user to continue',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }
        })

        /**
         * Feat
         */
        /** Tabs Filter*/
        $('#tabs-nav').on('click', 'a', function(event) {
            event.preventDefault();
            console.log();
            filter = $(this).data('filter');
            let ajaxData = {
                filter: filter
            };
            role = null;
            if (filter == 'role') {
                role = $(this).data('role');
                console.log('role selected: ', role);
                ajaxData.role = role;
            }
            console.log('tab filter', filter);
            console.log(ajaxData);
            $.ajax({
                url: "{{route('acl.user.filter_by_account_status')}}",
                method: 'GET',
                data: ajaxData,
                success: function(data) {
                    console.log(data);
                    switch (filter) {
                        case 'inactive':
                            $('#inactive-users').html(data.user_list);
                            $('#inactive-users').append(data.users_pagination_links);
                            break;
                        case 'banned':
                            $('#banned-users').html(data.user_list);
                            $('#banned-users').append(data.users_pagination_links);
                            break;
                        case 'deleted':
                            $('#deleted-users').html(data.user_list);
                            $('#deleted-users').append(data.users_pagination_links);
                            break;
                        case 'role':
                            var container = '#' + ajaxData.role;
                            $(container).html(data.user_list);
                            $(container).append(data.users_pagination_links);
                            break;
                    }
                    // $('#inactive-users').html(data.user_list);
                    // $('#inactive-users').append(data.users_pagination_links);
                    initPlugins();

                },
                error: function(err) {
                    console.log('error', err);
                }
            });

        })

        /** Handle Pagination
         *  On click Pagination Links Load only for tabs
         * 
         */
        $(document).on('click', '.filter .pagination .page-link', function(event) {
            event.preventDefault();
            var endpoint = $(this).attr('href');
            console.log(endpoint);
            //var filter = 'inactive';
            // Add your AJAX request to load the new page content
            let ajaxDataPaging = {
                filter: filter
            };
            if (filter == 'role') {
                console.log('role selected: ', role);
                ajaxDataPaging.role = role;
            }
            $.ajax({
                url: endpoint,
                type: 'GET',
                data: ajaxDataPaging,
                success: function(data) {
                    // Update the content with the new data received from the server
                    switch (filter) {
                        case 'inactive':
                            $('#inactive-users').html(data.user_list);
                            $('#inactive-users').append(data.users_pagination_links);
                            break;
                        case 'banned':
                            $('#banned-users').html(data.user_list);
                            $('#banned-users').append(data.users_pagination_links);
                            break;
                        case 'deleted':
                            $('#deleted-users').html(data.user_list);
                            $('#deleted-users').append(data.users_pagination_links);
                            break;
                        case 'role':
                            var container = '#' + ajaxDataPaging.role;
                            $(container).html(data.user_list);
                            $(container).append(data.users_pagination_links);
                            break;
                    }
                    initPlugins();
                },
                error: function(err) {
                    console.error('An error occurred: ' + err);
                }
            });
        });

        /**App Func ends */
    })

    /**
     * Modular Functions
     */

    /** Init Multi select */

    function initMultiSlect() {
        $('.multipleSelect2').select2({
            placeholder: 'Select Roles'
        });
    }

    /** Bind events on selecting and deselecting roles */
    function bindMultiSelectEventListeners() {
        $('.user-multirole-select').each(function(index, el) {
            $(el).on('select2:selecting', function(e) {
                e.preventDefault();
                actionData = {
                    action: 'add',
                    roleId: e.params.args.data.id,
                    userId: $(e.params.args.data.element).data('userId'),
                    selectElement: $(e.target)
                }
                showModal(actionData.action);
            })

            $(el).on('select2:unselecting', function(e) {
                e.preventDefault();
                actionData = {
                    action: 'remove',
                    roleId: e.params.args.data.id,
                    userId: $(e.params.args.data.element).data('userId'),
                    selectElement: $(e.target)
                }
                showModal(actionData.action);
            })
        })
    }

    // Show confirmation modal
    function showModal(action) {
        $('#actionType').text(action === 'add' ? 'add' : 'remove');
        $('#confirmationModal').modal('show');
    }

    // Handle confirmation button click
    $('#confirmAction').on('click', function() {
        $('#confirmationModal').modal('hide');
        performAction(actionData);
    })

    // Handle ajax sync user single role api service call
    function performAction(actionData) {
        console.log('AJAX REQUEST');
        // console.log(data);
        $.ajax({
            url: "{{url('acl/users/update-user-role-single')}}",
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                user_id: actionData.userId,
                role_id: actionData.roleId,
                action: actionData.action
            },
            success: function(data) {
                console.log(data);
                // Update the UI based on action type after successful backend update
                if (actionData.action === 'add') {
                    console.log('add action update ui');
                    let option = actionData.selectElement.find('option[value="' + actionData.roleId + '"]');
                    option.prop('selected', true); // Manually select the option
                    console.log('option', option);
                    var type = 'success';
                    toastr.options.timeOut = 10000;
                    toastr.success(data.message);
                } else if (actionData.action === 'remove') {
                    let option = actionData.selectElement.find('option[value="' + actionData.roleId + '"]');
                    option.prop('selected', false); // Manually deselect the option
                    var type = 'success';
                    toastr.options.timeOut = 10000;
                    toastr.success(data.message);
                }
                // Trigger the Select2 change event to update the UI
                actionData.selectElement.trigger('change.select2');
                //alert(data.msg); // Handle success, show a message or update the UI
                console.log(actionData.selectElement);
            },
            error: function(err) {
                console.log(err);
                //alert('An error occurred. Please try again.'); // Handle error
                var type = 'error';
                toastr.options.timeOut = 10000;
                toastr.success(err.message);
            }
        })
    }

    /** Multiple data row select for bulk operations */

    function initMultipleDataRowSelection() {

        $(".tab-content #selectAll").click(function() {
            $(".tab-content input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        $(".tab-content input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $(".tab-content #selectAll").prop("checked", false);
            }
        });
    }

    // UI plugins init
    function initPlugins() {
        initMultiSlect();
        bindMultiSelectEventListeners();
        initMultipleDataRowSelection();
    }
</script>

<script>
    /** UI tabs navigation */
    $(document).ready(function() {

        // Initially show the first tab
        $('#tabs-nav a:first').addClass('active');
        $('.tab-content:first').addClass('active');

        // Handle regular tab click
        $('#tabs-nav a').click(function(event) {
            event.preventDefault();
            $('#tabs-nav a').removeClass('active');
            $('.tab-content').removeClass('active');

            $(this).addClass('active');
            var activeTab = $(this).attr('href');
            $(activeTab).addClass('active');
        });

        // Handle dropdown menu click
        $('.dropdown-item').click(function(event) {
            event.preventDefault();
            $('#tabs-nav a').removeClass('active');
            $('.tab-content').removeClass('active');

            var activeTab = $(this).attr('href');
            $(activeTab).addClass('active');
        });
    });
</script>


@endpush
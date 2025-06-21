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
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Activate</a>
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Deactivate</a>
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Delete</a>
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
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">By Role</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#Administrator">Administrator</a>
                                        <a class="dropdown-item" href="#Doctor">Doctor</a>
                                    </div>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tabs card-block p-0 pt-3">
                                <div class="tab-pane tab-content active" id="all-users">
                                    @include('acl.user.partials.user-list', ['users'=> $users])
                                </div>


                                <div class="tab-pane tab-content" id="inactive-users">
                                    <div class="table-user-list custom-table">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input id="selectAll" type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>Display Name</th>
                                                        <th>Roles</th>
                                                        <th>Custom Permission</th>
                                                        <th>Last Login</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>1</td>
                                                        <td>admin@gmail.com</td>
                                                        <td>admin</td>
                                                        <td>
                                                            <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="" id="" style="width:auto">
                                                                <option value="1">admin</option>
                                                                <option value="2">Writer</option>
                                                                <option value="3">Editor</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items permission-tag flex-wrap d-flex">
                                                                <span>Edit Voucher</span>
                                                            </div>
                                                        </td>
                                                        <td>Sep 10, 2024<br> 2:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-disabled disabled">Deactivate</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="table-pagination justify-content-between align-items-center d-flex flex-wrap">
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0">
                                                    <div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div>
                                                </div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane tab-content" id="banned-users">
                                    <div class="table-user-list custom-table">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input id="selectAll" type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>Display Name</th>
                                                        <th>Roles</th>
                                                        <th>Custom Permission</th>
                                                        <th>Last Login</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>1</td>
                                                        <td>admin@gmail.com</td>
                                                        <td>admin</td>
                                                        <td>
                                                            <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="" id="" style="width:auto">
                                                                <option value="1">admin</option>
                                                                <option value="2">Writer</option>
                                                                <option value="3">Editor</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items permission-tag flex-wrap d-flex">
                                                                <span>Edit Voucher</span>
                                                            </div>
                                                        </td>
                                                        <td>Sep 10, 2024<br> 2:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-disabled disabled">Banned</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>1</td>
                                                        <td>admin@gmail.com</td>
                                                        <td>admin</td>
                                                        <td>
                                                            <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="" id="" style="width:auto">
                                                                <option value="1">admin</option>
                                                                <option value="2">Writer</option>
                                                                <option value="3">Editor</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items permission-tag flex-wrap d-flex">
                                                                <span>Edit Voucher</span>
                                                            </div>
                                                        </td>
                                                        <td>Sep 10, 2024<br> 2:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-disabled disabled">Banned</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="table-pagination justify-content-between align-items-center d-flex flex-wrap">
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0">
                                                    <div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div>
                                                </div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane tab-content" id="deleted-users">
                                    <div class="table-user-list custom-table">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input id="selectAll" type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>Display Name</th>
                                                        <th>Roles</th>
                                                        <th>Custom Permission</th>
                                                        <th>Last Login</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>2</td>
                                                        <td>admin@gmail.com</td>
                                                        <td>admin</td>
                                                        <td>
                                                            <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="" id="" style="width:auto">
                                                                <option value="1">admin</option>
                                                                <option value="2">Writer</option>
                                                                <option value="3">Editor</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items permission-tag flex-wrap d-flex">
                                                                <span>Edit Voucher</span>
                                                            </div>
                                                        </td>
                                                        <td>Sep 10, 2024<br> 2:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-danger">Deleted</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="table-pagination justify-content-between align-items-center d-flex flex-wrap">
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0">
                                                    <div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div>
                                                </div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane tab-content" id="Administrator">
                                    <div class="table-user-list custom-table">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input id="selectAll" type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>Display Name</th>
                                                        <th>Roles</th>
                                                        <th>Custom Permission</th>
                                                        <th>Last Login</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>1</td>
                                                        <td>admin@gmail.com</td>
                                                        <td>admin</td>
                                                        <td>
                                                            <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="" id="" style="width:auto">
                                                                <option value="1">admin</option>
                                                                <option value="2">Writer</option>
                                                                <option value="3">Editor</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items permission-tag flex-wrap d-flex">
                                                                <span>Edit Voucher</span>
                                                            </div>
                                                        </td>
                                                        <td>Sep 10, 2024<br> 2:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-succes">Active</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="table-pagination justify-content-between align-items-center d-flex flex-wrap">
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0">
                                                    <div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div>
                                                </div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane tab-content" id="Doctor">
                                    <div class="table-user-list custom-table">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input id="selectAll" type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>Display Name</th>
                                                        <th>Roles</th>
                                                        <th>Custom Permission</th>
                                                        <th>Last Login</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>1</td>
                                                        <td>admin@gmail.com</td>
                                                        <td>admin</td>
                                                        <td>
                                                            <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="" id="" style="width:auto">
                                                                <option value="1">admin</option>
                                                                <option value="2">Writer</option>
                                                                <option value="3">Editor</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items permission-tag flex-wrap d-flex">
                                                                <span>Edit Voucher</span>
                                                            </div>
                                                        </td>
                                                        <td>Sep 10, 2024<br> 2:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn btn-success">Active</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>2</td>
                                                        <td>admin@gmail.com</td>
                                                        <td>admin</td>
                                                        <td>
                                                            <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="" id="" style="width:auto">
                                                                <option value="1">admin</option>
                                                                <option value="2">Writer</option>
                                                                <option value="3">Editor</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items permission-tag flex-wrap d-flex">
                                                                <span>Edit Voucher</span>
                                                            </div>
                                                        </td>
                                                        <td>Sep 10, 2024<br> 2:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-success">Active</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="table-pagination justify-content-between align-items-center d-flex flex-wrap">
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0">
                                                    <div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div>
                                                </div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>



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
    let actionData = {};
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
        /** Tabs Filter*/
        $('#tabs-nav').on('click', 'a', function(event) {
            event.preventDefault();
            console.log();
            var filter = $(this).data('filter');
            console.log('tab filter', filter);
            $.ajax({
                url: "{{route('acl.user.filter_by_account_status')}}",
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    filter: filter
                },
                success: function(data) {
                    //console.log(data);
                    $('#inactive-users').html(data);
                    initMultiSlect();
                    bindMultiSelectEventListeners();
                },
                error: function(err) {
                    console.log('error', err);
                }
            });
        })


        /**App Func ends */
    })

    /**
     * Modular
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
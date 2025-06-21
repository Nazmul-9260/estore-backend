@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

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
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Edit</a>
                                    </div>
                                </div>
                                <div class="selected-items">
                                    <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-plus"></i> Create User</a>
                                </div>
                            </div>

                            <!-- Nav tabs -->
                            
                            <ul id="tabs-nav" class="nav nav-tabs tabs d-flex flex-wrap tab-custon-menu" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#home1">All Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#profile1">Inactive</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#messages1">Banned</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#settings1">Deleted</a>
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
                                <div class="tab-pane tab-content active" id="home1">
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
                                                            <div class="permission-items permission-tag  flex-wrap d-flex">
                                                                <span>Edit Voucher</span>
                                                            </div>
                                                        </td>
                                                        <td>Sep 14, 2024<br> 5:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-success">Active</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="table-pagination justify-content-between align-items-center d-flex flex-wrap">
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0"><div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div></div>
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
                                <div class="tab-pane tab-content" id="profile1">
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
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0"><div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div></div>
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
                                <div class="tab-pane tab-content" id="messages1">
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
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0"><div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div></div>
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
                                <div class="tab-pane tab-content" id="settings1">
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
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0"><div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div></div>
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
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0"><div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div></div>
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
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0"><div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div></div>
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



@endsection

@push('scripts')

<script>
    $(document).ready(function(){
        $('.multipleSelect2').select2({
            placeholder: 'Select Roles'
        });
    })
</script>

<script>
    $(document).ready(function () {
        // Initially show the first tab
        $('#tabs-nav a:first').addClass('active');
        $('.tab-content:first').addClass('active');

        // Handle regular tab click
        $('#tabs-nav a').click(function (event) {
            event.preventDefault();
            $('#tabs-nav a').removeClass('active');
            $('.tab-content').removeClass('active');

            $(this).addClass('active');
            var activeTab = $(this).attr('href');
            $(activeTab).addClass('active');
        });

        // Handle dropdown menu click
        $('.dropdown-item').click(function (event) {
            event.preventDefault();
            $('#tabs-nav a').removeClass('active');
            $('.tab-content').removeClass('active');

            var activeTab = $(this).attr('href');
            $(activeTab).addClass('active');
        });
    });
</script>



@endpush
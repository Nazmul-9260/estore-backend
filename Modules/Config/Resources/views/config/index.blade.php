@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">

                    <button type="button" style="float:left;" class="btn btn-primary btn-sm" id="createConfigBtn">
                        <!-- data-toggle="modal" data-target="#createContactModal"-->
                        <i class="fa fa-plus" aria-hidden="true"></i> Add Row
                    </button>
                    <div style="margin-left:10px;margin-top:7px; float:left;" class="text-info">[For edit click on gird row]</div>


                    <a href="{{route('config.exportCsv')}}" class="btn btn waves-effect waves-light btn-info btn-outline-info btn-sm" style="float:right; margin-left:5px !important;" id="exportConfigBtn" style="color:#FFFFFF">
                        <i class="fa fa-cloud-download" aria-hidden="true"></i> Export Data CSV
                    </a>

                    <button type="button" class="btn btn waves-effect waves-light btn-info btn-outline-info btn-sm" style="float:right; margin-left:5px !important;" data-toggle="modal" data-target="#ImportModal">
                        <i class="fa fa-cloud-upload" aria-hidden="true"></i> Import Data CSV
                    </button>

                    <a href="{{route('config.exportJson')}}" class="btn waves-effect waves-light btn-success btn-outline-success btn-sm" style="float:right; margin-left:5px !important; " id="exportConfigBtn">
                        <i class="fa fa-cloud-download" aria-hidden="true"></i> Export Data JSON
                    </a>

                    <button type="button" class="btn waves-effect waves-light btn-danger btn-outline-danger btn-sm" style="float:right;" data-toggle="modal" data-target="#ImportModalJson">
                        <i class="fa fa-cloud-upload" aria-hidden="true"></i> Import Data JSON
                    </button>


                    <!-- Modal Structure JSON Import-->
                    <div class="modal fade" id="ImportModal" tabindex="-1" aria-labelledby="ImportModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ImportModalLabel">Add Import Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="fa fa-close"></span>
                                    </button>
                                </div>
                                <form action="{{route('config.importCsv')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label class="w-100 col-form-label">Upload File</label>
                                        <div class="form-group m-b-0">
                                            <input type="file" name="csv" class="form-control" accept=".csv">
                                        </div>
                                        <small class="text-danger">[ Accept only csv file ]</small>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Structure -->
                    <div class="modal fade" id="ImportModalJson" tabindex="-1" aria-labelledby="ImportModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ImportModalLabel">Add Import Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="fa fa-close"></span>
                                    </button>
                                </div>
                                <form action="{{route('config.importJson')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label class="w-100 col-form-label">Upload File</label>
                                        <div class="form-group m-b-0">
                                            <input type="file" name="json" class="form-control" accept=".json">
                                        </div>
                                        <small class="text-danger">[ Accept only json file ]</small>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-block table-user-list custom-table">
                    <div class="table-responsive">
                        <table id="configs-list-view-table" class="table table-hover display table">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Config Type</th>
                                    <th>Config Name</th>
                                    <th>Config Value</th>
                                    <th>Status</th>
                                    <th class="action-col">Actions</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Contact Modal -->

    <div class="modal fade" id="createContactModal" tabindex="-3" aria-labelledby="createContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="create-contact-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createContactModalLabel">Create Contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-block custom-input-field">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" name="name" class="form-control custom-input-control @error('name') form-control-danger @enderror" type="text" value="{{old('name')}}">
                                        <span class="invalid-feedback d-block" role="alert">


                                            <strong id="validation-error-name"></strong>

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input id="phone" name="phone" class="form-control custom-input-control @error('phone') form-control-danger @enderror" type="number" placeholder="(+880)" value="{{old('phone')}}">
                                        <span class="invalid-feedback d-block" role="alert">


                                            <strong id="validation-error-phone"></strong>


                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="col-md-4 custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!--Edit Config Name Modal -->

    <div class="modal fade" id="editConfigNameModal" tabindex="-4" aria-labelledby="editContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="edit-config-name-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editContactModalLabel">Edit Config Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-block custom-input-field">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="config_name">Name</label>
                                        <input id="edit-config-name" name="config_name" class="form-control custom-input-control @error('name') form-control-danger @enderror" type="text" value="{{old('name')}}">
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="edit-validation-error-name"></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="col-md-4 custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Show Contact Modal -->

    <div class="modal fade" id="showContactModal" tabindex="-4" aria-labelledby="showContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showContactModalLabel">Edit Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-block custom-input-field">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="show-name" name="name" class="form-control custom-input-control @error('name') form-control-danger @enderror" type="text" value="{{old('name')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input id="show-phone" name="phone" class="form-control custom-input-control @error('phone') form-control-danger @enderror" type="number" placeholder="(+880)" value="{{old('phone')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!--Show Contact Modal -->

    <div class="modal fade" id="confirmDeleteContactModal" tabindex="-4" aria-labelledby="confirmDeleteContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteContactModalLabel">Delete Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-block custom-input-field">
                        <div class="row">
                            <div class="col-md-12">
                                Are you sure you want to delete this contact?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="confirmDeleteBtn" class="col-md-4 custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Confirm</button>

                </div>
            </div>

        </div>
    </div>





</div>








@endsection

@push('scripts')

<script>
    $(document).ready(function() {

        /** Datatable */
        $('#configs-list-view-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{url('config/configs/get-configs-datatable')}}",
            lengthMenu: [5, 10, 20, 50, 100],
            pageLength: 50,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'type',
                    name: 'type',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'value',
                    name: 'value',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
            order: {
                name: 'id',
                dir: 'desc'
            }

        });
        /** Datatable */

        /** Inline config type edit */

        let previousOptionVal = null;
        let previousOption = null;

        let configId = null;

        let rowAddProcessing = false;

        let createNewConfigTypeProcessing = false;

        $(document.body).on('focus', '.inline-select-configs', function() {
            // Store the previously selected option when the select element gains focus
            previousOption = $(this).find('option:selected');
            previousOptionVal = $(this).find('option:selected').val();
            console.log('prev val', previousOptionVal);
        });

        $(document.body).on('change', '.inline-select-configs', function(event) {
            event.preventDefault();

            if (!rowAddProcessing) {

                Swal.fire({
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Save",
                    denyButtonText: `Don't save`,

                }).then((result) => {
                    /* Handle isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        // Show loading spinner with a custom message
                        Swal.fire({
                            title: 'Saving...',
                            html: 'Please wait while we save your changes.', // Custom message
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading(); // Show loading spinner
                            }
                        });
                        // ajax call to db
                        let optionSelected = $(this).find('option:selected');
                        //console.log('selected option', optionSelected);
                        configId = $(optionSelected).data('config-id');
                        let optionSelectedVal = optionSelected.val();
                        console.log('config row id', configId);
                        console.log('config option selected value', optionSelectedVal);
                        let ajaxData = {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            config_id: configId,
                            value: optionSelectedVal
                        }
                        $.ajax({
                            url: "{{route('config.updateConfigType')}}",
                            method: 'POST',
                            data: ajaxData,
                            success: function(data) {
                                console.log(data);
                                Swal.fire("Saved!", data.data.message, "success");
                                toastr.success(data.data.message);
                                $('#configs-list-view-table').DataTable().ajax.reload();
                            },
                            error: function(err) {
                                console.log(err);
                                $(this).find('option[value="' + previousOptionVal + '"]').prop('selected', true);
                                Swal.fire("Error", "There was a problem saving your changes.", "error");
                                toastr.error(data.data.message);
                                $('#configs-list-view-table').DataTable().ajax.reload();
                            },
                            complete: function() {
                                rowAddProcessing = false;
                                createNewConfigTypeProcessing = false;
                            }
                        })
                        // Demo DB call
                        // setTimeout(function() {
                        //     // After having the ajax data received
                        //     Swal.fire("Saved!", "", "success");

                        // }, 3000);
                        //Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });

            }

        })
        /** Inline config type edit */

        /** Inline config name edit */
        $(document.body).on('click', '.inline-edit-configs-name', function(event) {
            var thisElem = $(this);
            var restoreElemHtmlContent = thisElem.html();
            thisElem.off();
            thisElem.removeClass('inline-edit-configs-name');
            var valueName = $(this).text();
            $('#edit-config-name').val($(this).text());
            configId = $(this).data('config-id');
            // $('#editConfigNameModal').modal('show');
            var editableElemName = $('<input class="inline-input"  style="border:none">');
            editableElemName.val(valueName);
            editableElemName.prop('type', 'text');
            thisElem.html(editableElemName);
            var editConfirmBtnName = $('<button class="btn btn-sm btn-primary inline-editing-common">');
            var editConfirmIconName = '<i class="fa fa-check" aria-hidden="true"></i>';
            var editCancelBtnName = $('<button class="btn btn-sm btn-danger inline-editing-common">');
            var editCancelIconName = '<i class="fa fa-times" aria-hidden="true"></i>';
            editConfirmBtnName.html(editConfirmIconName);
            editCancelBtnName.html(editCancelIconName);
            //'<button class="edit-confirm-icon active"><i class="fa fa-check" aria-hidden="true"></i></button>';
            thisElem.append(editConfirmBtnName);
            thisElem.append(editCancelBtnName);
            /** On Confirm */
            editConfirmBtnName.click(function() {
                var newInputValueName = editableElemName.val();
                console.log('new input value', newInputValueName);
                let ajaxData = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    config_id: configId,
                    value: newInputValueName,
                }
                $.ajax({
                    url: "{{route('config.updateConfigName')}}",
                    method: 'POST',
                    data: ajaxData,
                    success: function(data) {
                        console.log(data);
                        Swal.fire("Saved!", data.data.message, "success");
                        toastr.success(data.data.message);
                        $('#configs-list-view-table').DataTable().ajax.reload();
                    },
                    error: function(err) {
                        console.log(err);
                        $(this).find('option[value="' + previousOptionVal + '"]').prop('selected', true);
                        Swal.fire("Error", "There was a problem saving your changes.", "error");
                        toastr.error(data.data.message);
                        $('#configs-list-view-table').DataTable().ajax.reload();
                    },
                    complete: function() {
                        rowAddProcessing = false;
                        createNewConfigTypeProcessing = false;
                    }
                })

            })
            /** On Cancel */
            editCancelBtnName.click(function() {
                var newInputValueName = editableElemName.val();
                console.log('new input value', newInputValueName);
                thisElem.html(restoreElemHtmlContent);
                thisElem.addClass('inline-edit-configs-name');
                rowAddProcessing = false;
                createNewConfigTypeProcessing = false;
            })
        })
        /** Inline config name edit */

        /** Inline config value edit */
        $(document.body).on('click', '.inline-edit-configs-value', function(event) {
            var thisElem = $(this);
            var restoreElemHtmlContent = thisElem.html();
            thisElem.off();
            thisElem.removeClass('inline-edit-configs-value');
            var value = $(this).text();
            $('#edit-config-value').val($(this).text());
            configId = $(this).data('config-id');
            // $('#editConfigNameModal').modal('show');
            var editableElem = $('<input class="inline-input" style="border:none">');
            editableElem.val(value);
            editableElem.prop('type', 'text');
            thisElem.html(editableElem);
            var editConfirmBtn = $('<button class="btn btn-sm btn-primary inline-editing-common">');
            var editConfirmIcon = '<i class="fa fa-check" aria-hidden="true"></i>';
            var editCancelBtn = $('<button class="btn btn-sm btn-danger inline-editing-common">');
            var editCancelIcon = '<i class="fa fa-times" aria-hidden="true"></i>';
            editConfirmBtn.html(editConfirmIcon);
            editCancelBtn.html(editCancelIcon);
            //'<button class="edit-confirm-icon active"><i class="fa fa-check" aria-hidden="true"></i></button>';
            thisElem.append(editConfirmBtn);
            thisElem.append(editCancelBtn);
            var newInputValue;
            /** On Confirm */

            editConfirmBtn.click(function() {
                newInputValue = editableElem.val();
                console.log('new input value', newInputValue);
                let ajaxData = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    config_id: configId,
                    value: newInputValue,
                }
                console.log('debugg ajax data val', ajaxData);
                $.ajax({
                    url: "{{route('config.updateConfigValue')}}",
                    method: 'POST',
                    data: ajaxData,
                    success: function(data) {
                        console.log(data);
                        Swal.fire("Saved!", data.data.message, "success");
                        toastr.success(data.data.message);
                        $('#configs-list-view-table').DataTable().ajax.reload();
                    },
                    error: function(err) {
                        console.log(err);
                        $(this).find('option[value="' + previousOptionVal + '"]').prop('selected', true);
                        Swal.fire("Error", "There was a problem saving your changes.", "error");
                        toastr.error(data.data.message);
                        $('#configs-list-view-table').DataTable().ajax.reload();
                    },
                    complete: function() {
                        rowAddProcessing = false;
                        createNewConfigTypeProcessing = false;
                    }
                })

            })
            /** On Cancel */
            editCancelBtn.click(function() {
                // console.log('debugg ajax data val', ajaxData);
                newInputValue = editableElem.val();
                console.log('new input value', newInputValue);
                thisElem.html(restoreElemHtmlContent);
                thisElem.addClass('inline-edit-configs-value');
                rowAddProcessing = false;
                createNewConfigTypeProcessing = false;
            })
        })
        /** Inline config value edit */

        $(document.body).on('change', '.inline-select-configs-status', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`,

            }).then((result) => {
                /* Handle isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    // Show loading spinner with a custom message
                    Swal.fire({
                        title: 'Saving...',
                        html: 'Please wait while we save your changes.', // Custom message
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading(); // Show loading spinner
                        }
                    });
                    // ajax call to db
                    let optionSelected = $(this).find('option:selected');
                    //console.log('selected option', optionSelected);
                    configId = $(optionSelected).data('config-id');
                    let optionSelectedVal = optionSelected.val();
                    console.log('config row id', configId);
                    console.log('config option selected value', optionSelectedVal);
                    let ajaxData = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        config_id: configId,
                        value: optionSelectedVal
                    }
                    $.ajax({
                        url: "{{route('config.updateConfigStatus')}}",
                        method: 'POST',
                        data: ajaxData,
                        success: function(data) {
                            console.log(data);
                            Swal.fire("Saved!", data.data.message, "success");
                            toastr.success(data.data.message);
                            $('#configs-list-view-table').DataTable().ajax.reload();
                        },
                        error: function(err) {
                            console.log(err);
                            $(this).find('option[value="' + previousOptionVal + '"]').prop('selected', true);
                            Swal.fire("Error", "There was a problem saving your changes.", "error");
                            toastr.error(data.data.message);
                            $('#configs-list-view-table').DataTable().ajax.reload();
                        },
                        complete: function() {
                            rowAddProcessing = false;
                            createNewConfigTypeProcessing = false;
                        }
                    })
                    // Demo DB call
                    // setTimeout(function() {
                    //     // After having the ajax data received
                    //     Swal.fire("Saved!", "", "success");

                    // }, 3000);
                    //Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");

                }
            });
        })

        /** Add New Row*/

        $(document.body).on('click', '#createConfigBtn', function(event) {

            event.preventDefault();

            let table = $('#configs-list-view-table').DataTable();

            console.log('add datatable row');

            if ($('#configs-list-view-table tbody tr.form-row').length == 0 && !rowAddProcessing) {
                addFormRow();
            } else if (rowAddProcessing) {
                console.log('debug 1 len:', $('#configs-list-view-table tbody tr.form-row').length);
                console.log('debug 2 row', rowAddProcessing)
                Swal.fire("Please wait!", "You can add one record at a time", "error");
            } else {
                return;
            }
        })

        /** Add New Row*/
        function addFormRow() {
            let formRow = `
                <tr class="form-row">
                    <td></td> <!-- Empty for ID -->
                    <td><input type="text" class="form-control" id="config_name" placeholder="Enter config name"></td>
                    <td>
                        <select class="form-control" id="config_type">
                            <option value="">Select Type</option>
                            <option value="Type1">Type1</option>
                            <option value="Type2">Type2</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-success" id="saveNewConfig">Save</button>
                        <button class="btn btn-sm btn-danger" id="cancelNewConfig">Cancel</button>
                    </td>
                </tr>
            `;

            let copiedRow = `<tr>
                                <td class="dt-type-numeric">1</td>
                                <td><select class="inline-select-configs" name="config_type"><option data-config-type="Gender" data-config-id="1" value="Gender" selected="">Gender</option><option data-config-type="Zone" data-config-id="1" value="Zone">Zone</option><option data-config-type="Area" data-config-id="1" value="Area">Area</option></select></td>
                                <td><span class="inline-edit-configs-name" data-config-id="1">Male</span></td>
                                <td class="dt-type-numeric">1</td>
                                <td class="dt-type-numeric"><a class="btn btn-sm btn-primary" href="1">1</a></td></tr>`;

            let finalRow = `<tr>
                                <td class="dt-type-numeric">
                                </td>
                                <td><select class="inline-select-configs" name="config_type"><option data-config-type="Gender" data-config-id="1" value="Gender" selected="">Gender</option><option data-config-type="Zone" data-config-id="1" value="Zone">Zone</option><option data-config-type="Area" data-config-id="1" value="Area">Area</option></select></td>
                                <td><span ><input type="text" name="config_name"></span></td>
                                <td class="dt-type-numeric"><input type="number" name="config_value"></td>
                                    <td>
                                    <button id="saveNewConfig"><i class="fa fa-check" aria-hidden="true"></i></button>
                                    <button id="cancelNewConfig"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </td>
                                </tr>`;
            let rowTemplate = null;
            $.ajax({
                url: "{{route('config.getNewDataRowInputTemplate')}}",
                method: 'GET',
                async: false,
                success: function(data) {
                    console.log(data);
                    rowTemplate = data.config_row_template
                },
                error: function(err) {
                    console.log(err)
                    Swal.fire("Error!", "Could not add config template", "error")

                }

            })
            // Insert the form row at the first position
            $('#configs-list-view-table tbody').prepend(rowTemplate);
            rowAddProcessing = true;
        }


        $(document.body).on('click', '#saveNewConfig', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Saving...',
                html: 'Please wait while we save your changes.', // Custom message
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading(); // Show loading spinner
                }
            });
            console.log('save data row');
            let ajaxDataInsert = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                /** any of two */
                // config_type: $('#configTypeAdd').find('option:selected').val(),
                // config_type: $('#configTypeAdd').val(),
                config_name: $('input[name="config_name_add"]').val(),
                config_value: $('input[name="config_value_add"]').val(),
                config_status: $('#configStatusAdd').find('option:selected').val(),
            }
            if (createNewConfigTypeProcessing) {
                ajaxDataInsert.config_type = $('#configTypeAdd').val();
            } else {
                ajaxDataInsert.config_type = $('#configTypeAdd').find('option:selected').val()
            }
            console.log('sent data', ajaxDataInsert);
            $.ajax({
                url: "{{route('config.storeConfig')}}",
                method: 'POST',
                async: true,
                data: ajaxDataInsert,
                success: function(data, textStatus, xhr) {
                    console.log(data);
                    if (xhr.status == 400) {
                        Swal.fire("Validation error!", data.data.message, "error");
                    }

                    if (xhr.status == 200) {
                        if (data.data.type == 'error') {
                            Swal.fire("Error!", data.data.message, "error");
                        } else {
                            Swal.fire("Saved!", data.data.message, "success");
                            toastr.success(data.data.message);
                            $('#configs-list-view-table').DataTable().ajax.reload();
                        }

                    } else {
                        Swal.fire("Error!", data.data.message, "error");
                    }
                },
                error: function(err) {
                    console.log(err)
                    Swal.fire("Error!", "Validation Error, Could not add config", "error")

                },
                complete: function() {
                    rowAddProcessing = false;
                    createNewConfigTypeProcessing = false;

                }

            })

        })

        $(document.body).on('click', '#cancelNewConfig', function(event) {
            event.preventDefault();
            $(this).closest('tr').remove();
            rowAddProcessing = false;
        })

        /** Create new config type */

        $(document.body).on('change', '#configTypeAdd', function(event) {
            event.preventDefault();
            console.log('new selection');
            var optionVal = $('#configTypeAdd option:selected').val();
            console.log('selected val', optionVal);
            if (optionVal == 'createNewType') {
                createNewConfigTypeProcessing = true;
                // copy the elem
                var container = $('.inline-select-config-data-row');
                var containerRestore = $('.inline-select-config-data-row').html();
                // console.log(container);
                container.html('');
                var span = $('<span class="form-control" style="display:flex">');
                var editableElem = $('<input name="config_type_add" id="configTypeAdd" class="inline-input" style="border:none;">');
                editableElem.prop('type', 'text');
                var editCancelBtn = $('<button id="restoreConfigTypeAdd" class="btn btn-sm btn-danger inline-editing-common">');
                var editCancelIcon = '<i class="fa fa-times" aria-hidden="true"></i>';
                editCancelBtn.html(editCancelIcon);
                span.html(editableElem)
                span.append(editCancelBtn);
                container.html(span);
                /** Child Event Emitter */
                $('#restoreConfigTypeAdd').click(function(event) {
                    event.preventDefault();
                    container.html(containerRestore);
                    createNewConfigTypeProcessing = false;
                })
            }
        })
        /** Create new config type */


        /**Delete */
        $(document.body).on('click', '.config-delete', function(event) {
            event.preventDefault();

            var deleteConfigId = $(this).data('id');

            Swal.fire({
                title: "Do you want to delete the record?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Delete",
                denyButtonText: `Don't Delete`,

            }).then((result) => {
                /* Handle isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    // Show loading spinner with a custom message
                    Swal.fire({
                        title: 'Removing Record...',
                        html: 'Please wait while we save your changes.', // Custom message
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading(); // Show loading spinner
                        }
                    });
                    let ajaxData = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        config_id: deleteConfigId,
                    }
                    $.ajax({
                        url: "{{route('config.deleteConfig')}}",
                        method: 'DELETE',
                        data: ajaxData,
                        success: function(data) {
                            console.log(data);
                            Swal.fire("Deleted!", data.data.message, "success");
                            toastr.success(data.data.message);
                            $('#configs-list-view-table').DataTable().ajax.reload();
                        },
                        error: function(err) {
                            console.log(err);;
                            Swal.fire("Error", "There was a problem saving your changes.", "error");
                            toastr.error(data.data.message);
                            $('#configs-list-view-table').DataTable().ajax.reload();
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        })

        /**End of App */
    })
</script>

@endpush
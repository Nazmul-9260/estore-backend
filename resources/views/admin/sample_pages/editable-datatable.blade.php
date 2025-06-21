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
                                        <button id="add-row-btn" class="add-row-btn btn btn-primary"><i class="fa fa-plus"></i> Add Row</button>
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Active</a>
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Deactivate</a>
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Delete</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Table for users -->
                            <div class="table-user-list custom-table">
                                <div class="table-responsive">
                                    <!--start editable datatable -->
                                    <table id="editable-table" class=" ">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input id="selectAll-ck" type="checkbox">
                                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>ID</th>
                                                <th>Config Tyle</th>
                                                <th>Config Name</th>
                                                <th>Config Value</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" class="select-row">
                                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <td class="edit-cell">1</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>Gender</option>
                                                        <option>Module Name</option>
                                                        <option>Gender</option>
                                                    </select>
                                                </td>
                                                <td class="edit-cell">Male</td>
                                                <td class="edit-cell">5</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>Active</option>
                                                        <option>Inactive</option>
                                                    </select>
                                                </td>
                                                <td><span class="remove-row-btn btn btn-danger btn-sm">Remove</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end editable datatable -->
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
    $(document).ready(function() {
        // Initialize DataTables
        var table = $('#editable-table').DataTable({
            paging: true,
            searching: true,
            ordering: true
        });

        // Select All functionality
        $('#selectAll-ck').click(function() {
            if ($(this).prop('checked')) {
                $('.select-row').prop('checked', true); // Check all row checkboxes
            } else {
                $('.select-row').prop('checked', false); // Uncheck all row checkboxes
            }
        });

        // When a row checkbox is clicked, update Select All checkbox
        $('#editable-table').on('click', '.select-row', function() {
            if ($('.select-row:checked').length === $('.select-row').length) {
                $('#selectAll-ck').prop('checked', true); // All rows are checked
            } else {
                $('#selectAll-ck').prop('checked', false); // Not all rows are checked
            }
        });

        // Inline cell editing functionality
        $('#editable-table').on('click', '.edit-cell', function() {
            var currentElement = $(this);
            var currentText = currentElement.text();
            var input = $('<input class="editable-field">', {
                type: 'text',
                value: currentText
            });

            currentElement.html(input);
            input.focus();

            input.on('blur', function() {
                var newValue = $(this).val();
                currentElement.text(newValue);
            });

            input.on('keypress', function(e) {
                if (e.which === 13) { // Enter key pressed
                    input.blur();
                }
            });
        });

        // Add a new row to the table
        $('#add-row-btn').click(function() {
            var rowCount = $('#editable-table tbody tr').length + 1;
            var newRow = `
                <tr>
                    <th style="width: 50px;">
                        <div class="checkbox-fade fade-in-primary">
                            <label>
                                <input type="checkbox" class="select-row">
                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            </label>
                        </div>
                    </th>
                    <td class="edit-cell">${rowCount}</td>
                    <td>
                        <select class="form-control">
                            <option>Gender</option>
                            <option>Module Name</option>
                            <option>Gender</option>
                        </select>
                    </td>
                    <td class="edit-cell">Config Name</td>
                    <td class="edit-cell">Config Value</td>
                    <td>
                        <select class="form-control">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </td>
                    <td><span class="remove-row-btn btn btn-danger btn-sm">Remove</span></td>
                </tr>
            `;
            table.row.add($(newRow)).draw(); // Add the new row to DataTables and redraw
        });

        // Remove a row from the table
        $('#editable-table').on('click', '.remove-row-btn', function() {
            table.row($(this).parents('tr')).remove().draw(); // Remove the row from DataTables and redraw
        });
    });
</script>

@endpush
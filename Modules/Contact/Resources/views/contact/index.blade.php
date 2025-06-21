@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <!-- <h5> Add Contact</h5> -->
                    <!-- <a href="{{url('contact/contacts/create')}}" class="btn waves-effect waves-light btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Add Contact</a> -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createContactModal">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add Contact
                    </button>
                    @include('layouts.partials.page-widget')
                </div>
                <div class="card-block table-border-style custom-table">
                    <div class="table-responsive">
                        <table id="contacts-list-view-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
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


    <!--Edit Contact Modal -->

    <div class="modal fade" id="editContactModal" tabindex="-4" aria-labelledby="editContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="edit-contact-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editContactModalLabel">Edit Contact</h5>
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
                                        <input id="edit-name" name="name" class="form-control custom-input-control @error('name') form-control-danger @enderror" type="text" value="{{old('name')}}">
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="edit-validation-error-name"></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input id="edit-phone" name="phone" class="form-control custom-input-control @error('phone') form-control-danger @enderror" type="number" placeholder="(+880)" value="{{old('phone')}}">
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong id="edit-validation-error-phone"></strong>
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


<!-- Modal Example -->
<!--
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createContactModal">
        <i class="fa fa-plus" aria-hidden="true"></i> Add Contact
    </button>
     <div class="modal fade" id="createContactModal" tabindex="-1" aria-labelledby="createContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createContactModalLabel">Create Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> -->





@endsection

@push('scripts')

<script>
    $(document).ready(function() {

        $('#contacts-list-view-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{url('contact/contacts/get-contacts-datatable')}}",
            lengthMenu: [5, 10, 20, 50, 100],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                }

            ],
            order: {
                name: 'id',
                dir: 'desc'
            }

        });

        var contactId;

        $('#create-contact-form').on('submit', function(e) {
            e.preventDefault();
            console.log('submitted');
            validationReset();
            let formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url: "{{route('contact.contacts.storeContactAjax')}}",
                method: 'POST',
                data: formData,
                success: function(data) {
                    console.log(data)
                    var response = data.data;
                    console.log(response.message);
                    if (response.type == 'error') {
                        var keys = Object.keys(response.message);
                        console.log(keys);
                        if (typeof response.message.name != undefined) {
                            $('#validation-error-name').html(response.message.name);
                        }
                        if (typeof response.message.phone != undefined) {
                            $('#validation-error-phone').html(response.message.phone);

                        }
                    }
                    if (response.type == 'success') {
                        toastr.success(response.message);
                        $('#createContactModal').modal('hide');
                        $('#contacts-list-view-table').DataTable().ajax.reload();
                        $('#create-contact-form').trigger('reset');

                    }
                },
                error: function(err) {
                    console.log(err)
                    toastr.error('Contact Create Error')
                }
            })
        })

        function validationReset() {
            $('#validation-error-name').empty();
            $('#validation-error-phone').empty();
            $('#edit-validation-error-name').empty();
            $('#edit-validation-error-phone').empty();

        }

        $('body').on('click', '.edit-btn', function(e) {
            e.preventDefault();
            contactId = $(this).data('id');
            console.log(contactId);
            $.ajax({
                url: '/contact/contacts/' + contactId + '/ajax',
                method: "GET",
                success: function(data) {
                    var response = data.data;
                    console.log(data);
                    $('#edit-name').val(response.contact.name);
                    $('#edit-phone').val(response.contact.phone);
                    $('#createContactModal').modal('hide');
                    $('#editContactModal').modal('show');

                }
            })
        })

        $('#edit-contact-form').on('submit', function(e) {
            e.preventDefault();
            console.log('edit submitted');
            validationReset();
            let formDataModified = $(this).serialize();
            $.ajax({
                url: "/contact/contacts/" + contactId + "/ajax",
                method: 'PUT',
                data: formDataModified,
                success: function(data) {
                    console.log(data)
                    var response = data.data;
                    console.log(response.message);
                    if (response.type == 'error') {
                        var keys = Object.keys(response.message);
                        console.log(keys);
                        if (typeof response.message.name != undefined) {
                            $('#edit-validation-error-name').html(response.message.name);
                        }
                        if (typeof response.message.phone != undefined) {
                            $('#edit-validation-error-phone').html(response.message.phone);
                        }
                    }
                    if (response.type == 'success') {
                        toastr.success(response.message);
                        $('#editContactModal').modal('hide');
                        $('#contacts-list-view-table').DataTable().ajax.reload();
                        $('#edit-contact-form').trigger('reset');
                        validationReset();

                    }
                },
                error: function(err) {
                    console.log(err)
                    toastr.error('Contact Update Error')
                }
            })
        })

        $('body').on('click', '.show-btn', function(e) {
            e.preventDefault();
            contactId = $(this).data('id');
            console.log(contactId);
            $.ajax({
                url: '/contact/contacts/' + contactId + '/ajax',
                method: "GET",
                success: function(data) {
                    var response = data.data;
                    console.log(data);
                    $('#show-name').val(response.contact.name);
                    $('#show-phone').val(response.contact.phone);
                    $('#show-name').prop('readonly', true);
                    $('#show-phone').prop('readonly', true);
                    $('#showContactModal').modal('show');

                }
            })
        })

        $('body').on('click', '.delete-btn', function(e) {
            e.preventDefault();
            contactId = $(this).data('id');
            console.log(contactId);
            $('#confirmDeleteContactModal').modal('show');
        })

        $('body').on('click', '#confirmDeleteBtn', function(e) {
            e.preventDefault();
            console.log('Confirmed');
            //return true;
            $.ajax({
                url: '/contact/contacts/' + contactId + '/ajax',
                method: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var response = data.data;
                    console.log(data);
                    $('#confirmDeleteContactModal').modal('hide');
                    $('#contacts-list-view-table').DataTable().ajax.reload();
                    toastr.success('Contact Deleted Successfully')
                },
                error: function(err) {
                    console.log(err);
                    toastr.error('Contact Delete Error');
                    $('#confirmDeleteContactModal').modal('hide');
                },
            })
        })





    })
</script>

@endpush
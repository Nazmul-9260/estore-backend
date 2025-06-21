@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <!-- <h5>Create Contact</h5> -->
                    <a href="{{url('acl/users/create')}}" class="btn waves-effect waves-light btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Create User</a>
                    @include('layouts.partials.page-widget')
                </div>
                <div class="card-block table-border-style custom-table">
                    <div class="table-responsive">
                        @if(count($users)>0)
                        <table id="contacts-list-view-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="action-col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $k => $user)
                                <tr>
                                    <td>{{$k + 1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>

                                    <td class="action-col">
                                        <div class="three-action-btn d-flex flex-nowrap notifications">
                                            <a href="{{url('acl/users/'.$user->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{url('acl/users/'.$user->id . '/edit')}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0)" class="btn-delete" data-id="{{$user->id}}" data-toggle="modal" data-target="#deleteModal">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end m-t-5">
                            {{$users->links()}}
                        </div>


                        @else
                        <p>No data found.</p>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this user?
                    </div>
                    <div class="modal-footer">
                        <form id="deleteForm" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Confirmation Modal -->
    </div>





</div>




@endsection

@push('scripts')

<script>
    $(document).ready(function() {

        // Capture the delete button click
        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            var url = '{{url("acl/users")}}/' + id;
            $('#deleteForm').attr('action', url); // Set form action
        });

    })
</script>

@endpush
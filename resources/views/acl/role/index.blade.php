@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <!-- <h5>Create Contact</h5> -->
                    @if(auth()->user()->can('create-roles'))
                    <a href="{{url('acl/roles/create')}}" class="btn waves-effect waves-light btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Create Role</a>
                    @endif
                    
                </div>
                <div class="card-block table-border-style custom-table">
                    <div class="table-responsive">
                        @if(count($roles)>0)
                        <table id="roles-list-view-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Account Type</th>
                                    <th>Users</th>
                                    <th>Description</th>
                                    <th class="action-col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $k => $role)
                                <tr>
                                    <td>{{$k + 1}}</td>
                                    <td><a class="clickable capitalize" href="{{url('acl/roles/'.$role->id . '/edit-details')}}">{{$role->name}}</a></td>
                                    <td>{{$role->users()->count()}}</td>
                                    <td>
                                        @php
                                        $descriptionWords = explode(' ',$role->description);
                                        $shortDescription = implode(' ', array_slice($descriptionWords, 0, 2)) ;
                                        @endphp
                                        {{ $shortDescription }}{{ count($descriptionWords) > 2 ? '...' : '' }}
                                        @if (count($descriptionWords) > 2)
                                        <a href="{{ url('acl/roles/'.$role->id) }}" class="see-more-link">See More</a>
                                        @endif
                                    </td>

                                    <td class="action-col">
                                        <div class="three-action-btn d-flex flex-nowrap notifications">
                                            <a href="{{url('acl/roles/'.$role->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{url('acl/roles/'.$role->id . '/edit-details')}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0)" class="btn-delete" data-id="{{$role->id}}" data-toggle="modal" data-target="#deleteModal">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end m-t-5">
                            <!-- $roles->links() -->
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
                        <h5 class="modal-title" id="deleteModalLabel">Delete role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this role?
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
            var url = '{{url("acl/roles")}}/' + id;
            $('#deleteForm').attr('action', url); // Set form action
        });

        // Init CSR datatable

        let table = new DataTable('#roles-list-view-table', {

            lengthMenu: [5, 10, 15, 20, 50],
            pageLength: 5,
            responsive: true,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var headerColumn = $(column.header());

                    if (headerColumn.text().trim() !== 'Actions') {

                        var input = $('<input type="text" placeholder="Search"/>')
                            .appendTo($(column.header()))
                            .on('keyup change', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                    }

                });
            },

        });

    })
</script>

@endpush
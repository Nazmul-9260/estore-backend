@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h5>Filter</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa-plus minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                
                <div class="card-block row custon-select" style="display: none;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Example Search</label>
                            <input class="form-control filter-search-control" type="search" placeholder="Search...">
                            <button type="submit" class="custon-select-icon"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group custon-select">
                            <label for="exampleFormControlSelect2">Example select</label>
                            <select class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group custon-select">
                            <label for="exampleFormControlSelect3">Example select</label>
                            <select class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Yajra Data Table (Server Side)</h5>
                </div>
                <div class="card-block table-border-style custom-table">
                    <div class="table-responsive">
                        <table id="users-list-view-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>#SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="action-col">Actions</th> -->
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <!-- <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th> -->
                                    <th class="action-col">Actions</th>

                                </tr>
                            </thead>
                        </table>

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

        $('#users-list-view-table').DataTable({
            processing: true,
            serverSide: true,
            //ajax: "{!!url('users-data-get-users') !!}", // Both are valids
            ajax: "{{url('users-data-get-users') }}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                // {
                //     data: 'view',
                //     name: 'view',
                //     orderable: false,
                //     searchable: false
                // },
                // {
                //     data: 'edit',
                //     name: 'edit',
                //     orderable: false,
                //     searchable: false
                // },
                // {
                //     data: 'delete',
                //     name: 'delete',
                //     orderable: false,
                //     searchable: false
                // },
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
    })
</script>
@endpush
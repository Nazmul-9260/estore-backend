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
                    <h5>Default Data Table (Client Side)</h5>
                </div>
                <div class="card-block table-border-style custom-table">
                    <div class="table-responsive">
                        @if(count($users)>0)
                        <table id="users-list-view-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="data-th-col1">#SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="action-col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sl = 1;@endphp
                                @foreach($users as $user)
                                <tr>
                                    <th class="data-th-col1" scope="row">{{$sl}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="action-col">
                                        <div class="three-action-btn d-flex flex-nowrap notifications">
                                            <a class="btn-noti" href="javascript:void(0)" data-type="success" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a class="btn-noti" href="javascript:void(0)" data-type="warning" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn-noti" href="javascript:void(0)" data-type="danger" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @php $sl++;@endphp
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No data found.</p>
                        @endif

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Normal Table Style</h5>
                </div>

                <div class="card-block table-border-style custom-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th class="action-col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Jahangir</td>
                                    <td>Alam</td>
                                    <td>jahangir@gmail.com</td>
                                    <td class="action-col">
                                        <div class="three-action-btn d-flex flex-nowrap notifications">
                                            <a class="btn-noti" href="javascript:void(0)" data-type="success" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a class="btn-noti" href="javascript:void(0)" data-type="warning" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn-noti" href="javascript:void(0)" data-type="danger" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Alam</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <td class="action-col">
                                        <div class="three-action-btn d-flex flex-nowrap notifications">
                                            <a class="btn-noti" href="javascript:void(0)" data-type="success" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a class="btn-noti" href="javascript:void(0)" data-type="warning" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn-noti" href="javascript:void(0)" data-type="danger" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>jahangir</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                    <td class="action-col">
                                        <div class="three-action-btn d-flex flex-nowrap notifications">
                                            <a class="btn-noti" href="javascript:void(0)" data-type="success" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a class="btn-noti" href="javascript:void(0)" data-type="warning" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn-noti" href="javascript:void(0)" data-type="danger" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="table-pagination justify-content-between align-items-center d-flex flex-wrap">
                            <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto"><div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div></div>
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



@endsection

@push('scripts')

<script>
    $(document).ready(function() {

        $('#users-list-view-table').DataTable({});
    })
</script>
@endpush
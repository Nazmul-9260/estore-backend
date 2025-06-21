    <div class="table-user-list custom-table">
        <div class="table-responsive">
            @if(count($users)>0)
            <form id="user-list-bulk-ops" method="" action="">
                @csrf
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
                            <th>#SL</th>
                            <th>Username</th>
                            <th>Display Name</th>
                            <th>Roles</th>
                            <th>Custom Permissions</th>
                            <th>Last Login</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $k => $user)
                        <tr>
                            <th scope="row">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input class="user-select" type="checkbox" name="users[]" id="{{$user->id}}" value="{{$user->id}}">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    </label>
                                </div>
                            </th>
                            <td>{{$k + 1}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                                <select class="multipleSelect2 form-control user-multirole-select" multiple="true" name="" id="" style="width:auto">
                                    @foreach($roles as $role)
                                    <option data-user-name="{{$user->name}}" data-user-id="{{$user->id}}" value="{{$role->id}}" {{in_array($role->name, $user->getRoleNames()->toArray())?'selected':''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="permission-items permission-tag  flex-wrap d-flex">
                                    <!-- <span>Edit Voucher</span> -->
                                    @if($user->permissions->count() > 0)
                                    @foreach($user->permissions as $permission)
                                    <span>{{$permission->name}}</span>
                                    @endforeach
                                    @else
                                    <span>Not granted</span>
                                    @endif
                                </div>
                            </td>
                            <!-- <td>Sep 14, 2024<br> 5:01 am</td> -->
                            <td>

                                {{ $user->last_login_at? date_format( date_create($user->last_login_at) , 'M d, Y'):'No Access' }}
                                <br>
                                {{ $user->last_login_at? date_format( date_create($user->last_login_at) , 'h:i a'):'' }}


                            </td>
                            <td>
                                <div class="permission-items">
                                    @if($user->is_active)
                                    <span class="btn btn-success">Active</span>
                                    @else
                                    <span class="btn btn-danger">Inactive</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            @else
            <p>No user found.</p>
            @endif

        </div>
    </div>
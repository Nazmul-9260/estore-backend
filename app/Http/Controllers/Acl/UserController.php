<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Module;
use App\Services\UserService;

class UserController extends Controller
{
    public $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::user()->hasPermissionTo('User.index')) {
            abort(403);
        }
        $users = User::orderBy('id', 'desc')->paginate(5);

        $roles = Role::orderBy('id', 'desc')->get();

        return view('acl.user.index', compact('users', 'roles'));
    }

    public function indexUsersAsync(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.indexUsersAsync')) {
            abort(403);
        }
        //

        //return 'OK';

        $users = $users = User::query()->orderBy('id', 'desc')->paginate(5);

        $roles = Role::orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            return response()->json([
                'user_list' => view('acl.user.partials.user-list', ['users' => $users, 'roles' => $roles])->render(),
                'users_pagination_links' => view('acl.user.partials.user-list-filter-pagination', ['users' => $users])->render(),

            ]);
        }
        return view('acl.user.index-async', compact('users', 'roles'));
    }

    public function searchUsersByEmail(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.searchUsersByEmail')) {
            abort(403);
        }
        //
        $email = $request->email;
        $users = User::query()->where('email', 'like', '%' . $email . '%')->paginate(5)->withQueryString();
        $roles = Role::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return response()->json([
                'user_list' => view('acl.user.partials.user-list', ['users' => $users, 'roles' => $roles])->render(),
                'users_pagination_links' => view('acl.user.partials.user-list-filter-pagination', ['users' => $users])->render(),

            ]);
        }
    }

    public function searchUsersByName(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.searchUsersByName')) {
            abort(403);
        }
        $name = $request->name;
        $users = User::query()->where('name', 'like', '%' . $name . '%')->paginate(5)->withQueryString();
        $roles = Role::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return response()->json([
                'user_list' => view('acl.user.partials.user-list', ['users' => $users, 'roles' => $roles])->render(),
                'users_pagination_links' => view('acl.user.partials.user-list-filter-pagination', ['users' => $users])->render(),

            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('User.create')) {
            abort(403);
        }
        //

        $modules = Module::with('submodules.permissions')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        return view('acl.user.create', compact('roles', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.store')) {
            abort(403);
        }
        //

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();

        $user->name = $request->name;

        $user->email = $request->email;

        $user->password = Hash::make($request->password);

        $user->save();

        // if ($request->has('role')) {
        //     $rolesToAssign[] = $request->role;
        //     $user->syncRoles($rolesToAssign);
        // }

        if ($request->has('role_id')) {
            $rolesToAssign[] = $request->role_id;
            $user->syncRoles($rolesToAssign);
        }

        session()->flash('message', 'User Created Successfully');

        session()->flash('type', 'success');

        return redirect('acl/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('User.edit')) {
            abort(403);
        }
        //

        $user = User::findOrFail($id);

        $userRoles = $user->getRoleNames();

        $userPermissions = $user->getAllPermissions()->pluck('name');

        $roles = Role::orderBy('id', 'desc')->get();

        $modules = Module::with('submodules.permissions')->get();

        return view('acl.user.edit', compact('user', 'userRoles', 'userPermissions', 'roles', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('User.update')) {
            abort(403);
        }
        //


        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'array']
        ]);

        $user = User::findOrFail($id);

        if ($request->has('name') && $request->name != $user->name) {
            $user->name = $request->name;
        }

        if ($request->has('password') && !is_null($request->password)) {
            $request->validate(
                [
                    'password' => [
                        'required',
                        'string',
                        'min:8',
                        'confirmed'
                    ],
                ]
            );
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $rolesId = $request->role_id;

        $roles = [];

        foreach ($rolesId as $roleId) {
            $role = Role::findOrFail($roleId);
            $roles[] = $role->name;
        }

        $user->syncRoles($roles);

        session()->flash('message', 'User Updated Successfully');

        session()->flash('type', 'success');

        return redirect('acl/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermissionTo('User.destroy')) {
            abort(403);
        }
        //

        $user = User::findOrFail($id);

        $user->delete();

        session()->flash('message', 'User Deleted Successfully');

        session()->flash('type', 'success');

        return redirect('acl/users');
    }

    public function editCustomPermissions($userId)
    {
        if (!Auth::user()->hasPermissionTo('User.editCustomPermissions')) {
            abort(403);
        }
        //

        $user = User::find($userId);

        $userDirectPermissions = $user->permissions->pluck('name');

        $modules = Module::with('submodules.permissions')->get();

        return view('acl.user.edit-custom-permissions', compact('user', 'userDirectPermissions', 'modules'));
    }

    public function updateCustomPermissions(Request $request, $userId)
    {
        if (!Auth::user()->hasPermissionTo('User.updateCustomPermissions')) {
            abort(403);
        }
        //

        $user = User::findOrFail($userId);

        $user->syncPermissions($request->permissions);

        session()->flash('message', 'User Custom Permissions Updated Successfully for ' . $user->name);

        session()->flash('type', 'success');

        return redirect()->route('acl.users.index');
    }

    public function updateUserRoleSingle(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.updateUserRoleSingle')) {
            abort(403);
        }
        //

        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);

        if ($request->action === 'add') {
            $user->assignRole($role->name);
            return response()->json(['message' => 'Role ' . $role->name . ' assigned to ' . $user->name], 200);
        }

        if ($request->action === 'remove') {
            $user->removeRole($role->name);
            return response()->json(['message' => 'Role ' . $role->name . ' removed from ' . $user->name], 200);
        }

        return response()->json(['message' => 'Invalid action'], 400);
    }

    public function getUsersByAccountStatus(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.getUsersByAccountStatus')) {
            abort(403);
        }
        // return $request->all();

        $accountStatus = $request->get('filter');
        $users = [];
        switch ($accountStatus) {
            case 'all':
                $users = User::query()->orderBy('id', 'desc')->paginate(5);
                break;
            case 'inactive':
                $users = User::query()->where('is_active', false)->orderBy('id', 'desc')->paginate(5);
                break;
            case 'banned':
                $users = User::query()->where('is_banned', true)->orderBy('id', 'desc')->paginate(5);
                break;
            case 'deleted':
                $users = User::onlyTrashed()->paginate(5);
                break;
            case 'role':
                $role = $request->get('role');
                $users = User::role($role)->paginate(5);
                break;
        }

        $roles = Role::orderBy('id', 'desc')->get();

        return response()->json([
            'user_list' => view('acl.user.partials.user-list', ['users' => $users, 'roles' => $roles])->render(),
            'users_pagination_links' => view('acl.user.partials.user-list-filter-pagination', ['users' => $users])->render(),

        ]);
    }

    public function activateUsers(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.activateUsers')) {
            abort(403);
        }
        //

        if ($request->has('users') && is_array($request->users)) {

            User::whereIn('id', $request->users)->update([
                'is_active' => true
            ]);

            session()->flash('message', 'User Updated Successfully');

            session()->flash('type', 'success');

            return redirect('acl/users');
        } else {

            session()->flash('message', 'User Update Failed');

            session()->flash('type', 'error');

            return redirect('acl/users');
        }
    }

    public function deactivateUsers(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.deactivateUsers')) {
            abort(403);
        }
        //
        if ($request->has('users') && is_array($request->users)) {

            User::whereIn('id', $request->users)->update([
                'is_active' => false
            ]);

            session()->flash('message', 'User Updated Successfully');

            session()->flash('type', 'success');

            return redirect('acl/users');
        } else {

            session()->flash('message', 'User Update Failed');

            session()->flash('type', 'error');

            return redirect('acl/users');
        }
    }

    public function deleteUsers(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('User.deleteUsers')) {
            abort(403);
        }
        //
        if ($request->has('users') && is_array($request->users)) {

            User::whereIn('id', $request->users)->delete();

            session()->flash('message', 'User Deleted Successfully');

            session()->flash('type', 'success');

            return redirect('acl/users');
        } else {

            session()->flash('message', 'User Delete Failed');

            session()->flash('type', 'error');

            return redirect('acl/users');
        }
    }
}

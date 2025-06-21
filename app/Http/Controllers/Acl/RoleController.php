<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if (!Auth::user()->hasPermissionTo('view-roles')) {
            abort(403);
        }

        // $roles = Role::orderBy('id', 'desc')->paginate(5);
        $roles = Role::orderBy('id', 'desc')->get();

        return view('acl.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if (!Auth::user()->hasPermissionTo('create-roles')) {
            abort(403);
        }

        $modules = Module::with('submodules.permissions')->get();

        return view('acl.role.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        if (!Auth::user()->hasPermissionTo('create-roles')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|unique:roles|min:1|max:100',
            'description' => 'required|min:1|max:250'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => 'web',
        ]);

        if ($request->has('permissions') && !is_null($request->permissions) && count($request->permissions) > 0) {
            $role->givePermissionTo($request->permissions);
        }

        session()->flash('message', 'Role Created Successfully');

        session()->flash('type', 'success');

        return redirect('acl/roles');
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

        if (!Auth::user()->hasPermissionTo('view-roles')) {
            abort(403);
        }

        $role = Role::findOrFail($id);

        return view('acl.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        if (!Auth::user()->hasPermissionTo('edit-roles')) {
            abort(403);
        }

        $role = Role::findOrFail($id);

        return view('acl.role.edit', compact('role'));
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
        //

        if (!Auth::user()->hasPermissionTo('edit-roles')) {
            abort(403);
        }

        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|min:1|max:100',
        ]);

        if ($request->has('name')) {
            $role->name = $request->name;
        }

        $role->save();

        session()->flash('message', 'Role Updated Successfully');

        session()->flash('type', 'warning');

        return redirect('acl/roles/' . $role->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        if (!Auth::user()->hasPermissionTo('delete-roles')) {
            abort(403);
        }

        $role = Role::findOrFail($id);

        $role->delete();

        session()->flash('message', 'Role Deleted Successfully');

        session()->flash('type', 'danger');

        return redirect('acl/roles');
    }

    public function editRoleDetails($roleId)
    {
        //

        if (!Auth::user()->hasPermissionTo('edit-roles')) {
            abort(403);
        }

        $role = Role::findOrFail($roleId);

        $roleAssocitedPermissionsNames = $role->permissions->pluck('name');

        $modules = Module::with('submodules.permissions')->get();

        return view('acl.role.edit-details', compact('role', 'roleAssocitedPermissionsNames', 'modules'));
    }

    public function updateRoleDetails(Request $request, $roleId)
    {
        /**
         * echo '<pre>';
         * var_dump($request->all());
         */

        if (!Auth::user()->hasPermissionTo('edit-roles')) {
            abort(403);
        }

        $validated = $request->validate([
            'description' => 'required|min:1|max:200'
        ]);

        $role = Role::findOrFail($roleId);

        if ($request->has('description') && $request->description != $role->description) {
            $role->description = $request->description;
            $role->save();
        }

        $role->syncPermissions($request->permissions);

        session()->flash('message', 'Role Updated Successfully');

        session()->flash('type', 'warning');

        return redirect('acl/roles');
    }

    public function getPermissionsByRolesId(Request $request)
    {
        $roles = $request->roles;
        $allPermissionsMerged = [];
        $allPermissionsUnique = [];
        $rolePermissions = NULL;
        foreach ($roles as $role) {
            $rolePermissions = $this->getPermissionsByRole($role);
            $allPermissionsMerged = array_merge($allPermissionsMerged, $rolePermissions->toArray());
        }
        $allPermissionsUnique = array_values(array_unique($allPermissionsMerged));
        return $allPermissionsUnique;
    }

    public function getPermissionsByRole($role)
    {

        $roleId = $role;

        $role = Role::findOrFail($roleId);

        $roleAssociatedPermissions = $role->permissions->pluck('name');

        return $roleAssociatedPermissions;
    }
}

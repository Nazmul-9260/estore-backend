<?php

namespace App\Http\Controllers\Acl;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $modules = Module::orderBy('id', 'desc')->paginate(5);

        return view('acl.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('acl.module.create');
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

        $validated = $request->validate([
            'name' => 'required|unique:modules|min:1|max:100',
        ]);

        Module::create([
            'name' => $request->name,
        ]);

        session()->flash('message', 'Module Created Successfully');

        session()->flash('type', 'success');

        return redirect('acl/modules');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //

        return view('acl.module.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        //

        return view('acl.module.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        //

        $validated = $request->validate([
            'name' => 'required|min:1|max:100',
        ]);

        if ($request->has('name')) {
            $module->name = $request->name;
        }

        $module->save();

        session()->flash('message', 'Module Updated Successfully');

        session()->flash('type', 'warning');

        return redirect('acl/modules/' . $module->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        //

        $module->delete();

        session()->flash('message', 'Contact Deleted Successfully');

        session()->flash('type', 'danger');

        return redirect('acl/modules/');
    }

    public function getAllModulesWithSubmodulesWithPermissions()
    {
        $role = Role::findOrFail(1);
        $roleAssocitedPermissionsNames = $role->permissions->pluck('name');
        $modules = Module::with('submodules.permissions')->get();


        $response = [
            'role' => $role,
            'modules' => $modules,
            'rolePermissions' => $roleAssocitedPermissionsNames
        ];

        return $response;
    }

    public function queryRelatedData($id)
    {
        $modules = Module::with('submodules.permissions')->get();

        $modules = Module::select('id', 'name') // Pick specific columns from the modules
            ->with(['submodules' => function ($query) {
                $query->select('id', 'name', 'module_id'); // Pick specific columns from submodules
            }, 'submodules.permissions' => function ($query) {
                $query->select('id', 'name', 'submodule_id'); // Pick specific columns from permissions
            }])
            ->get();

        $module = Module::select('id', 'name') // Select specific columns from module
            ->with(['submodules' => function ($query) {
                $query->select('id', 'name', 'module_id'); // Select specific columns from submodules
            }, 'submodules.permissions' => function ($query) {
                $query->select('id', 'name', 'submodule_id'); // Select specific columns from permissions
            }])
            ->find($id); // Fetch the module by ID

        return $module;
    }
}

<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Submodule;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use ReflectionClass;
use Illuminate\Support\Facades\Route;
use App\Models\Module;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\PermissionServiceProvider;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $permissions = Permission::orderBy('id', 'desc')->paginate(5);

        return view('acl.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $submodules = Submodule::orderBy('id', 'desc')->get();

        return view('acl.permission.create', compact('submodules'));
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
            'name' => 'required|unique:permissions|min:1|max:100',
            'submodule_id' => 'required|numeric'
        ]);

        Permission::create([
            'name' => $request->name,
            'submodule_id' => $request->submodule_id,
            'guard_name' => 'web'
        ]);

        session()->flash('message', 'Permission Created Successfully');

        session()->flash('type', 'success');

        return redirect('acl/permissions');
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

        $permission = Permission::with('submodule')->findOrFail($id);

        return view('acl.permission.show', compact('permission'));
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

        $permission = Permission::with('submodule')->findOrFail($id);

        $submodules = Submodule::orderBy('id', 'desc')->get();

        return view('acl.permission.edit', compact('permission', 'submodules'));
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

        $permission = Permission::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|min:1|max:100',
            'submodule_id' => 'required|numeric'
        ]);

        if ($request->has('name')) {
            $permission->name = $request->name;
        }
        if ($request->has('submodule_id')) {
            $permission->submodule_id = $request->submodule_id;
        }

        $permission->save();

        session()->flash('message', 'Permission Updated Successfully');

        session()->flash('type', 'warning');

        return redirect('acl/permissions/' . $permission->id);
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

        $permission = Permission::findOrFail($id);

        $permission->delete();

        session()->flash('message', 'Permission Deleted Successfully');

        session()->flash('type', 'danger');

        return redirect('acl/permissions');
    }

    public function generatePermissions()
    {
        $controllers = [];

        $methods = [];

        $controllerKeys = [];

        $controllersWithMethods = [];

        // Get all routes in the application
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            // Check if the action is a controller (formatted as Controller@method)
            $action = $route->getActionName();

            if (strpos($action, '@') !== false) {
                // Extract controller and method
                [$controller, $method] = explode('@', $action);

                if (!isset($controllers[$controller])) {
                    // Use ReflectionClass to get methods of the controller
                    try {
                        $reflection = new ReflectionClass($controller);
                        $methods = array_filter($reflection->getMethods(), function ($method) use ($reflection) {
                            // Filter out inherited methods from parent classes
                            return $method->class === $reflection->getName();
                        });

                        $controllers[$controller] = array_map(function ($method) {
                            return $method->name;
                        }, $methods);
                    } catch (\ReflectionException $e) {
                        // Handle case where the controller doesn't exist or is not accessible
                        continue;
                    }
                }
            }
        }

        // Create DS

        $controllersToSpare = [
            'CsrfCookie',
            'Login',
            'Register',
            'ForgotPassword',
            'ResetPassword',
            'ConfirmPassword',
            'RouteListing'
        ];

        $controllersArr =  collect(array_keys($controllers))->map(function ($controller) use ($controllersToSpare) {
            $controllerStringArr = explode('\\', $controller);
            $controllerName =  end($controllerStringArr);
            $modelName = str_replace('Controller', '', $controllerName);
            if (!in_array($modelName, $controllersToSpare)) {
                return $modelName;
            }
        });

        $controllersArr = array_unique(array_filter($controllersArr->toArray()));

        foreach (collect($controllers) as $k => $controller) {

            $methods = $controller;
            $controllerName = $k;
            $controllerStringArr = explode('\\', $k);
            $controllerName =  end($controllerStringArr);
            $modelName = str_replace('Controller', '', $controllerName);
            $valuesToDelete = ['__construct'];
            foreach ($valuesToDelete as $valueToDelete) {
                $keyToDelete = array_search($valueToDelete, $methods);
                if ($keyToDelete !== false) {
                    unset($methods[$keyToDelete]);
                }
            }
            if (!in_array($modelName, $controllersToSpare)) {
                $controllersWithMethods[$modelName] = $methods;
            }
        }

        $permissions = Permission::select('name')->get()->map(function ($permission) {
            return $permission->name;
        });

        // return [
        //     'controllers' => $controllersArr,
        //     'methods' => $controllersWithMethods,
        //     'permissions' => $permissions
        // ];

        return view('acl.permission.generate', ['controllers' => $controllers, 'controllersWithMethods' => $controllersWithMethods, 'permissionsExist' => $permissions]);
    }

    public function saveGeneratedPermissions(Request $request)
    {

        $permissions = $request->input('permissions');
        $successfullyInserted = 0;

        foreach ($permissions as $permissionToSave) {
            $controllerPermissionPair = explode('.', $permissionToSave);
            $controllerKey = current($controllerPermissionPair);
            $permissionKey = end($controllerPermissionPair);
            $submoduleName = $controllerKey;
            $subs = Submodule::query()->where('name', $submoduleName)->get('id');
            $submoduleIdToSave = null;
            if (count($subs) == 0) {
                $autoGeneratedModuleName = 'Auto Generated';
                $module = Module::query()->where('name', $autoGeneratedModuleName)->first();
                $moduleIdToSave = null;
                if (is_null($module)) {
                    $moduleToSave = Module::create([
                        'name' => $autoGeneratedModuleName
                    ]);
                    $moduleIdToSave = $moduleToSave->id;
                } else {
                    $moduleIdToSave = $module->id;
                }
                $submoduleToSave = Submodule::create([
                    'name' => $submoduleName,
                    'module_id' => $moduleIdToSave,
                ]);
                $submoduleIdToSave = $submoduleToSave->id;
            }
            if (count($subs) > 0) {
                $submoduleIdToSave = $subs[0]['id'];
            }
            $permissionInstanceForVerifyExistence = Permission::query()->where('name', $permissionToSave)->first();
            if (!$permissionInstanceForVerifyExistence) {
                Permission::create([
                    'name' => $permissionToSave,
                    'submodule_id' => $submoduleIdToSave
                ]);
                $successfullyInserted++;
            }
        }
        session()->flash('message', 'Successfully ' . $successfullyInserted . ' permissions inserted');
        session()->flash('type', 'success');
        return redirect('/acl/permissions');
    }

    public function saveGeneratedPermissionsDocumentation(Request $request)
    {
        // return $request->all();

        $permissions = $request->input('permissions');
        $successfullyInserted = 0;

        foreach ($permissions as $permissionToSave) {
            // echo $permissionToSave . '<br>';
            $controllerPermissionPair = explode('.', $permissionToSave);
            $controllerKey = current($controllerPermissionPair);
            $permissionKey = end($controllerPermissionPair);
            // echo ('Controller/Resource/Submodule: ' . $controllerKey . ' Permission: ' . $permissionKey);
            // echo '<br>';
            $submoduleName = $controllerKey;
            $subs = Submodule::query()->where('name', $submoduleName)->get('id');
            // echo 'sub id: ' . $subs;
            // echo 'number of occurences: ' . count($subs);
            $submoduleIdToSave = null;
            if (count($subs) == 0) {
                // if not exists
                // Create a module named auto generated if not any module for this already exists
                // Name: Auto Generated Hard Coded
                // insert new submodule
                // get id
                // save the permisssion along with submodule id
                $autoGeneratedModuleName = 'Auto Generated';
                $module = Module::query()->where('name', $autoGeneratedModuleName)->first();
                $moduleIdToSave = null;
                // echo 'module exists ? :' . $module . "<br>";
                if (is_null($module)) {
                    // echo 'module exists: No';
                    $moduleToSave = Module::create([
                        'name' => $autoGeneratedModuleName
                    ]);
                    $moduleIdToSave = $moduleToSave->id;
                } else {
                    // echo 'module exists: Yes';
                    $moduleIdToSave = $module->id;
                }
                // var_dump($module);
                // echo 'Module Id: ' . $moduleIdToSave;
                $submoduleToSave = Submodule::create([
                    'name' => $submoduleName,
                    'module_id' => $moduleIdToSave,
                ]);
                $submoduleIdToSave = $submoduleToSave->id;
            }
            if (count($subs) > 0) {
                // if exists
                // get the first array element id
                // save the permisson along with submodule id
                $submoduleIdToSave = $subs[0]['id'];
                // [["id" => XXX]]
            }
            // no exceptions expected
            // if any, continue here ..
            // ... expections
            // continue ...
            // check if the permission already exits
            $permissionInstanceForVerifyExistence = Permission::query()->where('name', $permissionToSave)->first();
            if (!$permissionInstanceForVerifyExistence) {
                Permission::create([
                    'name' => $permissionToSave,
                    'submodule_id' => $submoduleIdToSave
                ]);
                $successfullyInserted++;
            }
        }
        session()->flash('message', 'Successfully ' . $successfullyInserted . ' permissions inserted');
        session()->flash('type', 'success');
        return redirect('/acl/permissions');
    }
}

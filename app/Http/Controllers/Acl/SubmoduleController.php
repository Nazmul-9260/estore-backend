<?php

namespace App\Http\Controllers\Acl;

use App\Models\Submodule;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmoduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $submodules = Submodule::orderBy('id', 'desc')->with(['module'])->paginate(5);

        return view('acl.submodule.index', compact('submodules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $modules = Module::orderBy('id', 'desc')->get();

        return view('acl.submodule.create', compact('modules'));
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
            'name' => 'required|unique:submodules|min:1|max:100',
            'module_id' => 'required|numeric'
        ]);

        Submodule::create([
            'name' => $request->name,
            'module_id' => $request->module_id
        ]);

        session()->flash('message', 'Submodule Created Successfully');

        session()->flash('type', 'success');

        return redirect('acl/submodules');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submodule  $submodule
     * @return \Illuminate\Http\Response
     */
    public function show(Submodule $submodule)
    {
        //

        return view('acl.submodule.show', compact('submodule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submodule  $submodule
     * @return \Illuminate\Http\Response
     */
    public function edit(Submodule $submodule)
    {
        //
        $modules = Module::orderBy('id', 'desc')->get();

        return view('acl.submodule.edit', compact('submodule', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submodule  $submodule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submodule $submodule)
    {
        //

        $validated = $request->validate([
            'name' => 'required|min:1|max:100',
            'module_id' => 'required|numeric'
        ]);

        if ($request->has('name')) {
            $submodule->name = $request->name;
        }
        if ($request->has('module_id')) {
            $submodule->module_id = $request->module_id;
        }

        $submodule->save();

        session()->flash('message', 'Submodule Updated Successfully');

        session()->flash('type', 'warning');

        return redirect('acl/submodules/' . $submodule->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submodule  $submodule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submodule $submodule)
    {
        //

        $submodule->delete();

        session()->flash('message', 'Submodule Deleted Successfully');

        session()->flash('type', 'danger');

        return redirect('acl/submodules/');
    }
}

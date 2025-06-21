<?php
namespace Modules\Config\Http\Controllers;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\Unit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;




class UnitController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Unit.admin')) {
            abort(403);
        }
        if ($request->ajax()) {
            $dataGrid = DB::table('units')->orderBy('id', 'desc')->get();

            return DataTables::of($dataGrid)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    $dropdown = '<div class="dynamic-btn col-1 m-0 pb-2">
				<button class="f-button click-event"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
				<div class="dynamic-btn-wrap">
<ul>';
                    $dropdown .= '
<li>
   <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editData">Edit</a>
</li>
<li>
	 <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>
</li>
';
                    $dropdown .= '</ul></div></div>';
                    return $dropdown;

                })
                ->editColumn('status', function ($dataGrid) {
                    if ($dataGrid->status == '1')
                        return 'Active';
                    if ($dataGrid->status == '2')
                        return 'Inactive';
                    return 'Cancel';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('config::unit.admin');
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Unit.create')) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            //'status' => 'required',
        ]);

        Unit::insert([
            'title' => $request->title,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Date saved successfully.']);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Unit.edit')) {
            abort(403);
        }
        $data = Unit::find($id);
        $str = "<option value=''>Select One</option>";
        if ($data->status == 1) {
            $str .= "<option value='1' selected>Active</option><option value='2'>InActive</option>";
        } else {
            $str .= "<option value='1'>Active</option><option value='2' selected>InActive</option>";
        }
        return response()->json(['data' => $data, 'str' => $str]);
    }

    public function update(Request $request)
    {

        if (!Auth::user()->hasPermissionTo('Unit.update')) {
            abort(403);
        }
        $request->validate([
            'title' => 'required'
        ]);

        Unit::where('id', $request->data_id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Date Update successfully.']);
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('Unit.delete')) {
            abort(403);
        }
        Unit::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }

}

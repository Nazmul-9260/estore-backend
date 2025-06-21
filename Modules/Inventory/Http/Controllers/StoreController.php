<?php

namespace App\Http\Controllers\Inventory;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use DataTables;
use App\Model\Inventory\Store;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Store.admin')) {
            abort(403);
        }
        if ($request->ajax()) {
            $dataGrid = DB::table('stores')->orderBy('id', 'desc')->get();
            return Datatables::of($dataGrid)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $dropdown = '<div class="dynamic-btn col-1 m-0 pb-2">
				<button class="f-button click-event"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
				<div class="dynamic-btn-wrap">
<ul>';
                    $dropdown .= '
<li>
   <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editData">Edit</a>
</li>
<li>
	 <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" class="btn deleteData">Delete</a>
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
        return view('inventory.store.admin');
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Store.create')) {
            abort(403);
        }
        $validator = \Validator::make($request->all(), ['title' => 'required']);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Store::insert([
            'title' => $request->title,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Date saved successfully.']);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Store.edit')) {
            abort(403);
        }
        $data = Store::find($id);
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
        if (!Auth::user()->hasPermissionTo('Store.update')) {
            abort(403);
        }
        $validator = \Validator::make($request->all(), ['title' => 'required', 'status' => 'required']);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Store::where('id', $request->data_id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Date Update successfully.']);
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('Store.delete')) {
            abort(403);
        }
        Store::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }
}

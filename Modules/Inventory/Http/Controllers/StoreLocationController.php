<?php

namespace App\Http\Controllers\Inventory;
use Auth;
use App\Http\Controllers\Controller;
use App\Model\Inventory\Store;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use DataTables;
use App\Model\Inventory\StoreLocation;
use Carbon\Carbon;

class StoreLocationController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('StoreLocation.admin')) {
            abort(403);
        }
        if ($request->ajax()) {
            $dataGrid = DB::table('store_locations')
            ->join('stores', 'store_locations.store_id', '=', 'stores.id')
            ->select('store_locations.*', 'stores.title as store_name' )
            ->orderBy('store_locations.id','desc')->get();
            return Datatables::of($dataGrid)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
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
                        if ($dataGrid->status == '1') return 'Active';
                        if ($dataGrid->status == '2') return 'Inactive';
                        return 'Cancel';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('inventory.storeLocation.admin');
    }

    public function getStoreLists(){
        if (!Auth::user()->hasPermissionTo('StoreLocation.getStoreLists')) {
            abort(403);
        }
        $stores = Store::orderBy('title','asc')->get();
        $str = "<option value=''>Select Store</option>";
        foreach($stores as $data){
            $str .= "<option value='".$data->id."'>".$data->title."</option>";
        }
        return response()->json(['str' => $str]);
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('StoreLocation.create')) {
            abort(403);
        }
        $validator = \Validator::make($request->all(), ['title' => 'required', 'store_id'=>'required']);
        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        StoreLocation::insert([
            'title' => $request->title,
            'store_id' => $request->store_id,
            'details' => $request->details,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);
        return response()->json(['success'=>'Date saved successfully.']);
    }

    public function edit($id){
        if (!Auth::user()->hasPermissionTo('StoreLocation.edit')) {
            abort(403);
        }
        $data = StoreLocation::where('id', $id)->first();
        $str = Store::getDropDownList('title', $data->store_id);

        $status = "<option value=''>Select One</option>";
        if($data->status == 1){
            $status .= "<option value='1' selected>Active</option><option value='2'>InActive</option>";
        }
        else{
            $status .= "<option value='1'>Active</option><option value='2' selected>InActive</option>";
        }
        return response()->json(['data' => $data, 'str' => $str, 'status' => $status]);
    }

    public function update(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('StoreLocation.update')) {
            abort(403);
        }
        $validator = \Validator::make($request->all(), ['title' => 'required', 'store_id'=>'required', 'status' => 'required']);
        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        StoreLocation::where('id', $request->data_id)->update([
            'title' => $request->title,
            'store_id' => $request->store_id,
            'details' => $request->details,
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success'=>'Date Update successfully.']);
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('StoreLocation.delete')) {
            abort(403);
        }
        StoreLocation::where('id', $id)->delete();
        return response()->json(['success'=>'Date Deleted successfully.']);
    }
}

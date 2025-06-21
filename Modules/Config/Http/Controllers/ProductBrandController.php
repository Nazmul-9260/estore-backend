<?php

namespace Modules\Config\Http\Controllers;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\ProductBrand;
use Yajra\DataTables\Facades\DataTables;

class ProductBrandController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('ProductBrand.admin')) {
            abort(403);
        }

        if ($request->ajax()) {
            $dataGrid = DB::table('product_brands')->orderBy('id', 'desc')->get();
            return DataTables::of($dataGrid)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $dropdown = '<div class="dynamic-btn col-1 m-0 pb-2">
                                <button class="f-button click-event"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                <div class="dynamic-btn-wrap">
                                <ul>
                                    <li>
                                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editData">Edit</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn deleteData">Delete</a>
                                    </li></ul></div></div>';
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
        return view('config::productBrand.admin');
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('ProductBrand.create')) {
            abort(403);
        }
        $request->validate([
            'name' => 'required',
            //'status' => 'required',
        ]);

        ProductBrand::insert([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'website_url' => $request->website_url,
            'status' => 1,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Date saved successfully.']);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('ProductBrand.edit')) {
            abort(403);
        }
        $data = ProductBrand::find($id);
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
        if (!Auth::user()->hasPermissionTo('ProductBrand.update')) {
            abort(403);
        }
        $request->validate([
            'name' => 'required'
        ]);

        ProductBrand::where('id', $request->data_id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'website_url' => $request->website_url,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::user()->id,
        ]);

        return response()->json(['success' => 'Date Update successfully.']);
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('ProductBrand.delete')) {
            abort(403);
        }
        ProductBrand::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }
}

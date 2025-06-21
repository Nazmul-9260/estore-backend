<?php

namespace Modules\Config\Http\Controllers;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\ProductCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;



class ProductCategoryController extends Controller
{
    public function admin(Request $request)
    {

        if (!Auth::user()->hasPermissionTo('ProductCategory.admin')) {
            abort(403);
        }
        if ($request->ajax()) {
            $dataGrid = DB::table('product_categories')->orderBy('id', 'desc')->get();
            return Datatables::of($dataGrid)
                ->addIndexColumn()
                ->addColumn('action', function ($row): string {
                    $dropdown = '<div class="dynamic-btn col-1 m-0 pb-2">
				<button class="f-button click-event"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
				<div class="dynamic-btn-wrap">
<ul>';
                    $dropdown .= '
<li>
  <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editData">Edit</a>
</li>
<li>
	 <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn deleteData">Delete</a>
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
        return view('config::productCategory.admin');
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('ProductCategory.create')) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            //'status' => 'required',
        ]);

        ProductCategory::insert([
            'title' => $request->title,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Date saved successfully.']);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('ProductCategory.edit')) {
            abort(403);
        }
        $data = ProductCategory::find($id);
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
        if (!Auth::user()->hasPermissionTo('ProductCategory.update')) {
            abort(403);
        }

        $request->validate([
            'title' => 'required'
        ]);

        ProductCategory::where('id', $request->data_id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Date Update successfully.']);
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('ProductCategory.delete')) {
            abort(403);
        }
        ProductCategory::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }

}

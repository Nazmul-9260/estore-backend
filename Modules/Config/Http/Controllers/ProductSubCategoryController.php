<?php
namespace Modules\Config\Http\Controllers;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\ProductCategory;
use Modules\Config\Entities\ProductSubCategory;
use Modules\Config\Entities\SubCategoryAttribute;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProductSubCategoryController extends Controller
{
    public function admin(Request $request)
    {
        

        if ($request->ajax()) {
            $dataGrid = DB::table('product_sub_categories')
                ->join('product_categories', 'product_sub_categories.category_id', '=', 'product_categories.id')
                ->select('product_sub_categories.*', 'product_categories.title as category_name')
                ->orderBy('product_sub_categories.id', 'desc')
                ->get();

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
 <li><a href="' . url('config/productSubCategory/subCategoryAttributeAdd/') . '/' . $row->id . '"  data-original-title="Edit" class="edit editData">Attribute</a></li>
<li>
	 <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '"  data-original-title="Delete" class="btn deleteData">Delete</a>
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
        return view('config::productSubCategory.admin');
    }


    public function subCategoryAttributeAdd($id)
    {
        if (!Auth::user()->hasPermissionTo('ProductSubCategory.subCategoryAttributeAdd')) {
            abort(403);
        }
        $data = ProductSubCategory::findOrFail($id);
        $attrData = DB::table('sub_category_attributes')
            ->where('sub_cat_id', '=', $id)
            ->get();
        return view('config::productSubCategory.addSubCategoryAttribute', compact('data', 'attrData'));
    }

    public function subCategoryAttributeSave(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('ProductSubCategory.subCategoryAttributeSave')) {
            abort(403);
        }
        $validator = \Validator::make($request->all(), [
            'attribute_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $i = 0;
        foreach ($request->attribute_id as $attribute_id) {
            SubCategoryAttribute::insert([
                'sub_cat_id' => $request->sub_category_id,
                'attribute_id' => $attribute_id,
                'status' => 1,
                'remarks' => $request->remarks[$i],
            ]);
            $i++;
        }

        return view('config::productSubCategory.admin');
    }

    public function getCategoryLists()
    {
        if (!Auth::user()->hasPermissionTo('ProductSubCategory.getCategoryLists')) {
            abort(403);
        }
        $categories = ProductCategory::orderBy('title', 'asc')->get();
        $str = "<option value=''>Select One</option>";
        foreach ($categories as $category) {
            $str .= "<option value='" . $category->id . "'>" . $category->title . "</option>";
        }
        return response()->json(['str' => $str]);
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('ProductSubCategory.create')) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);

        ProductSubCategory::insert([
            'title' => $request->title,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['success' => 'Date saved successfully.']);
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('ProductSubCategory.delete')) {
            abort(403);
        }
        ProductSubCategory::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('ProductSubCategory.edit')) {
            abort(403);
        }
        $data = ProductSubCategory::where('id', $id)->first();
        $str = ProductCategory::getDropDownList('title', $data->category_id);

        $status = "<option value=''>Select One</option>";
        if ($data->status == 1) {
            $status .= "<option value='1' selected>Active</option><option value='2'>InActive</option>";
        } else {
            $status .= "<option value='1'>Active</option><option value='2' selected>InActive</option>";
        }
        return response()->json(['data' => $data, 'str' => $str, 'status' => $status]);
    }

    public function update(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('ProductSubCategory.update')) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);

        ProductSubCategory::where('id', $request->data_id)->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Date Update successfully.']);
    }
}

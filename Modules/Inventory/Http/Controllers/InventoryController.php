<?php
namespace Modules\Inventory\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Entities\Inventory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;


class InventoryController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Inventory.admin')) {
            abort(403);
        }
        if ($request->ajax()) {
            $dataGrid = DB::table('inventories')
                ->leftJoin('stores', 'inventories.store_id', '=', 'stores.id')
                ->leftJoin('store_locations', 'inventories.location_id', '=', 'store_locations.id')
                ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                ->select('inventories.*', 'products.title as product_name', 'products.code as product_code', 'stores.title as store_name', 'store_locations.title as store_location')
                ->orderBy('inventories.id', 'desc')->get();

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
	 <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>
</li>
';
                    $dropdown .= '</ul></div></div>';
                    return $dropdown;

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('inventory::inventory.admin');
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Inventory.create')) {
            abort(403);
        }
        $validator = \Validator::make($request->all(), ['product_id' => 'required', 'store_id' => 'required', 'location_id' => 'required', 'stock_type' => 'required', 'stock_qty' => 'required']);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if ($request->stock_type == 1) {
            $stockIn = $request->stock_qty;
            $stockOut = 0;
        } else if ($request->stock_type == 2) {
            $stockIn = 0;
            $stockOut = $request->stock_qty;
        } else {
            $stockIn = 0;
            $stockOut = 0;
        }

        if ($stockIn != 0 || $stockOut != 0) {
            Inventory::insert([
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'purchase_price' => $request->purchase_price,
                'code' => $request->code,
                'store_id' => $request->store_id,
                'location_id' => $request->location_id,
                'stock_in' => $stockIn,
                'stock_out' => $stockOut,
                'transaction_date' => $request->transaction_date,
                'month_year' => date('Y-m'),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            Toastr::success('Data Saved Successfully', 'Success');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('Inventory.delete')) {
            abort(403);
        }
        Inventory::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }
}

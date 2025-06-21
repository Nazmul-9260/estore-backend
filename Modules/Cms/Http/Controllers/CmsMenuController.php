<?php

namespace Modules\Cms\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cms\Entities\CmsMenu;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Carbon\Carbon;



class CmsMenuController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('CmsMenu.admin')) {
            abort(403);
        }
        if ($request->ajax()) {
            $dataGrid = DB::table('cms_menus as cm')
            ->leftJoin('cms_menus as parent', 'cm.parent_id', '=', 'parent.id')
            ->select('cm.*', 'parent.title as parent_name')
            ->orderBy('cm.id', 'desc')
            ->get();

            return DataTables::of($dataGrid)
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
        return view('cms::cmsMenu.admin');
    }



    public function create(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('CmsMenu.create')) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'icon_text' => 'required',
            'position' => 'required',
            'url' => 'required',
            'ordering' => 'required',
        ]);

        CmsMenu::insert([
            'title' => $request->title,
            'icon_text' => $request->icon_text,
            'position' => $request->position,
            'url' => $request->url,
            'status' => 1,
            'ordering' => $request->ordering,
            'parent_id' => $request->parent_id,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Date saved successfully.']);
    }

    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('CmsMenu.delete')) {
            abort(403);
        }
        CmsMenu::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('CmsMenu.edit')) {
            abort(403);
        }
        $data = CmsMenu::where('id', $id)->first();
        $str = CmsMenu::getDropDownList('title', $data->parent_id);

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
        if (!Auth::user()->hasPermissionTo('CmsMenu.update')) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'icon_text' => 'required',
            'position' => 'required',
            'url' => 'required',
            'ordering' => 'required',
        ]);

        CmsMenu::where('id', $request->data_id)->update([
            'title' => $request->title,
            'icon_text' => $request->icon_text,
            'position' => $request->position,
            'url' => $request->url,
            'status' => $request->status,
            'ordering' => $request->ordering,
            'parent_id' => $request->parent_id,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Date Update successfully.']);
    }
}

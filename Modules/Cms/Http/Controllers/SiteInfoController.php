<?php

namespace Modules\Cms\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cms\Entities\SiteInfo;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SiteInfoController extends Controller
{

    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('SiteInfo.admin')) {
            abort(403);
        }

        if ($request->ajax()) {
            $dataGrid = DB::table('site_infos')
                ->orderBy('site_infos.id', 'desc')
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
  <a href="' . url('cms/siteInfo/edit/') . '/' . $row->id . '"  data-original-title="Edit" class="edit editData">Edit</a>
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
        return view('cms::siteInfo.admin');
    }




    public function create()
    {

        if (!Auth::user()->hasPermissionTo('SiteInfo.create')) {
            abort(403);
        }
        return view('cms::siteInfo.create');
    }

    public function save(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('SiteInfo.save')) {
            abort(403);
        }

        $request->validate([
            'site_name' => 'required',
            'site_title' => 'required',
        ]);

        $siteLogo = null;
        if ($request->hasFile('logo')) {
            $get_logo = $request->file('logo');
            $logo_name = str::random(5) . time() . '.' . $get_logo->getClientOriginalExtension();
            Image::make($get_logo)->save(public_path('upload/cms/logo/' . $logo_name, 50));
            $siteLogo = "upload/cms/logo/" . $logo_name;
        }

        $siteFavicon = null;
        if ($request->hasFile('favicon')) {
            $get_favicon = $request->file('favicon');
            $favicon_name = str::random(5) . time() . '.' . $get_favicon->getClientOriginalExtension();
            Image::make($get_favicon)->save(public_path('upload/cms/favicon/' . $favicon_name, 50));
            $siteFavicon = "upload/cms/favicon/" . $favicon_name;
        }

        SiteInfo::insert([
            'site_name' => $request->site_name,
            'meta_type' => $request->meta_type,
            'moto' => $request->moto,
            'site_title' => $request->site_title,
            'logo' => $siteLogo,
            'favicon' => $siteFavicon,
            'domain_name' => $request->domain_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 1,
            'created_at' => Carbon::now(),
            'created_by' =>  Auth::user()->id,
        ]);

        Toastr::success("Data Saved Successfully", "Success");
        return redirect()->back();
    }


    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('SiteInfo.delete')) {
            abort(403);
        }
        SiteInfo::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('SiteInfo.edit')) {
            abort(403);
        }
        $data = SiteInfo::findOrFail($id);
        return view('config::product.update', compact('data'));
    }

    public function update(Request $request)
    {

        if (!Auth::user()->hasPermissionTo('SiteInfo.update')) {
            abort(403);
        }
        $validator = \Validator::make($request->all(), ['title' => 'required']);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $product_image = null;
        if ($request->hasFile('image')) {
            $get_image = $request->file('image');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            Image::make($get_image)->save(public_path('upload/cms/logo/' . $image_name, 50));

            $product_image = "upload/cms/logo/" . $image_name;
        }

        SiteInfo::where('id', $request->data_id)->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'code' => $request->code,
            'image' => $product_image,
            'unit_id' => $request->unit_id,
            'min_order_qty' => $request->min_order_qty,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'details' => $request->details,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('config.product.admin');
    }



}

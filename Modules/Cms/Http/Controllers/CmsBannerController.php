<?php
namespace Modules\Cms\Http\Controllers;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cms\Entities\CmsBanner;
use Modules\Config\Entities\Config;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CmsBannerController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('CmsBanner.admin')) {
            abort(403);
        }
        if ($request->ajax()) {
            $dataGrid = DB::table('cms_banners')
                ->select('cms_banners.*')
                ->orderBy('cms_banners.id', 'desc')
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
						<a href="' . url('cms/cmsBanner/edit/') . '/' . $row->id . '"  data-original-title="Edit" class="edit editData">Edit</a>
					</li>
                    <li>
						 <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" class="btn deleteData">Delete</a>
					</li>
                    ';
                    $dropdown .= '</ul></div></div>';
                    return $dropdown;
                })
                ->editColumn('ordering', function ($dataGrid) {
                    return Config::where('value', $dataGrid->ordering)->where('type', 'ordering')->first()->name;
                })
                ->editColumn('banner_position', function ($dataGrid) {
                    return Config::where('value', $dataGrid->banner_position)->where('type', 'banner_position')->first()->name;
                })
                ->editColumn('status', function ($dataGrid) {
                    return Config::where('value', $dataGrid->status)->where('type', 'active_status')->first()->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('cms::cmsBanner.admin');
    }



    public function create()
    {
        if (!Auth::user()->hasPermissionTo('CmsBanner.create')) {
            abort(403);
        }

        return view('cms::cmsBanner.create');
    }

    public function save(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('CmsBanner.save')) {
            abort(403);
        }

        $validator = \Validator::make($request->all(), 
        [
            'title' => 'required', 
            'width' => 'required', 
            'height'=>'required'] 
        );
        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
       

        $banner_image = null;
        if ($request->hasFile('banner_image')) {
            $get_banner_image = $request->file('banner_image');
            $banner_image_name = str::random(5) . time() . '.' . $get_banner_image->getClientOriginalExtension();
            Image::make($get_banner_image)->save(public_path('upload/cms/banner/' . $banner_image_name, 50));
            $banner_image = "upload/cms/banner/" . $banner_image_name;
        }
     
        CmsBanner::insert([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'content' => $request->content,
            'banner_image' => $banner_image,
            'width' => $request->width,
            'height' => $request->height,
            'ordering' => $request->ordering,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'remarks' => $request->remarks,
            'banner_position' => $request->banner_position,
            'status' => 1,
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        Toastr::success("Data Saved Successfully", "Success");
        return redirect()->back();
    }


    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('CmsBanner.delete')) {
            abort(403);
        }
        CmsBanner::where('id', $id)->delete();
        return response()->json(['success' => 'Date Deleted successfully.']);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('CmsBanner.edit')) {
            abort(403);
        }
        $data = CmsBanner::findOrFail($id);
        return view('config::product.update', compact('data'));
    }

    public function update(Request $request)
    {

        if (!Auth::user()->hasPermissionTo('CmsBanner.update')) {
            abort(403);
        }
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'width' => 'required',
            'height' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $banner_image = null;
        if ($request->hasFile('image')) {
            $get_banner_image = $request->file('image');
            $banner_image_name = str::random(5) . time() . '.' . $get_banner_image->getClientOriginalExtension();
            Image::make($get_banner_image)->save(public_path('upload/cms/banner/' . $banner_image_name, 50));

            $banner_image = "upload/cms/banner/" . $banner_image_name;
        }

        CmsBanner::where('id', $request->data_id)->update([
            'title' => $request->title,
            'banner_image' => $banner_image,
            'width' => $request->width,
            'height' => $request->height,
            'ordering' => $request->ordering,
            'content' => $request->content,
            'sub_content' => $request->sub_content,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'remarks' => $request->remarks,
            'banner_position' => $request->banner_position,
            'status' => $request->status,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('cms::cmsBanner.admin');
    }


}

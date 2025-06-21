<?php


namespace Modules\Config\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Config\Entities\Product;
use Modules\Config\Entities\ProductAttribute;
use Modules\Config\Entities\ProductDetails;
use Modules\Config\Entities\ProductFile;
use Modules\Config\Entities\ProductTag;
use Modules\Inventory\Entities\Inventory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
// use Alert;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.admin')) {  
            abort(403);
        }
        // alert()->info('Title','Lorem Lorem Lorem');
        if ($request->ajax()) {
            $dataGrid = DB::table('products')
                ->join('product_sub_categories', 'products.subcategory_id', '=', 'product_sub_categories.id')
                ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->select('products.*', 'product_sub_categories.title as subCategoryName', 'product_categories.title as categoryName')
                ->orderBy('products.id', 'desc')
                ->get();

            return Datatables::of($dataGrid)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dynamic-btn col-1 m-0 pb-2">
                    <button class="f-button click-event"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                     <div class="dynamic-btn-wrap">
                         <ul>
                           <li><a href="' . url('config/product/edit/') . '/' . $row->id . '"  data-original-title="Edit" class="edit editData"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a></li>
                           <li><a href="' . url('config/product/productImageAdd/') . '/' . $row->id . '"  data-original-title="Edit" class="edit editData"><i class="fa-image" aria-hidden="true"></i>Image</a></li>
                           <li><a href="' . url('config/product/productFileAdd/') . '/' . $row->id . '"  data-original-title="Edit" class="edit editData"><i class="fa-image" aria-hidden="true"></i>Files</a></li>
                           <li><a href="' . url('config/product/productAttributeAdd/') . '/' . $row->id . '"  data-original-title="Edit" class="edit editData"><i class="fa-image" aria-hidden="true"></i>Attribute</a></li>
                           <li><a href="' . url('config/product/productSpecAdd/') . '/' . $row->id . '"  data-original-title="Edit" class="edit editData"><i class="fa-image" aria-hidden="true"></i>Spec</a></li>
                           <li><a href="" class="button" data-id="' . $row->id . '" class="deleteData show_confirm"><i class="fa fa-remove" aria-hidden="true"></i>Delete</a></li>
                           
                            
                           </ul>
                      </div>
                  </div>';
                    return $btn;
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
        return view('config::product.admin');
    }



    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Product.create')) {
            abort(403);
        }
        return view('config::product.create');
    }

    public function save(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.save')) {
            abort(403);
        }
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'title' => 'required',
            'code' => 'required',
        ]);

        $product_image = null;
        if ($request->hasFile('image')) {
            $get_image = $request->file('image');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            Image::make($get_image)->save(public_path('upload/productFile/' . $image_name, 50));
            $product_image = "upload/productFile/" . $image_name;
        }

        $last_inserted_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'title' => $request->title,
            'code' => $request->code,
            'details' => $request->details,
            'image' => $product_image,
            'foreign_name' => $request->foreign_name,
            'unit_id' => $request->unit_id,
            'manufacturer' => $request->manufacturer,
            'country_id' => $request->country_id,
            'min_order_qty' => $request->min_order_qty,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'measurement' => $request->measurement,
            'features' => $request->features,
            'warranty' => $request->warranty,
            'sell_price' => $request->sell_price,
            'code_cat_id' => $request->code_cat_id,
            'model' => $request->model,
            'tax_class' => $request->tax_class,
            'weight' => $request->weight,
            'weight_unit_id' => $request->weight_unit_id,
            'width' => $request->width,
            'height' => $request->height,
            'length_unit_id' => $request->length_unit_id,
            'ordering' => $request->ordering,
            'created_by' => Auth::user()->id,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);

        if ($last_inserted_id > 0) {
            if ($request->has('product_tag')) {
                $tags = $request->input('product_tag');
                foreach ($tags as $tagId) {
                    ProductTag::insert([
                        'product_id' => $last_inserted_id,
                        'product_tag_id' => $tagId,
                        'status' => 1,
                    ]);
                }
            }
        }

        Toastr::success("Data Saved Successfully", "Success");
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.delete')) {
            abort(403);
        }
        Product::find($request->id)->delete();
        return response()->json(['message' => 'Product deleted successfully']);

    }

    public function deleteImg(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.delete')) {
            abort(403);
        }
        ProductDetails::find($request->id)->delete();
        return response()->json(['message' => 'Product image ndeleted successfully']);

    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Product.edit')) {
            abort(403);
        }
        $data = Product::findOrFail($id);
        return view('config::product.update', compact('data'));
    }

    public function update(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.update')) {
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
            Image::make($get_image)->save(public_path('upload/productFile/' . $image_name, 50));
            $product_image = "upload/productFile/" . $image_name;
        }

        Product::where('id', $request->data_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'title' => $request->title,
            'code' => $request->code,
            'details' => $request->details,
            'foreign_name' => $request->foreign_name,
            'unit_id' => $request->unit_id,
            'manufacturer' => $request->manufacturer,
            'country_id' => $request->country_id,
            'min_order_qty' => $request->min_order_qty,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'measurement' => $request->measurement,
            'features' => $request->features,
            'warranty' => $request->warranty,
            'sell_price' => $request->sell_price,
            'code_cat_id' => $request->code_cat_id,
            'model' => $request->model,
            'tax_class' => $request->tax_class,
            'weight' => $request->weight,
            'weight_unit_id' => $request->weight_unit_id,
            'width' => $request->width,
            'height' => $request->height,
            'length_unit_id' => $request->length_unit_id,
            'ordering' => $request->ordering,
            'status' => $request->status,
            'price_show_status' => $request->price_show_status,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::user()->id,
        ]);
        if ($product_image != null) {
            Product::where('id', $request->data_id)->update([
                'image' => $product_image
            ]);
        }
        return redirect()->route('config.product.admin');
    }



    public function productImageAdd($id)
    {
        if (!Auth::user()->hasPermissionTo('Product.productImageAdd')) {
            abort(403);
        } 
        $data = Product::findOrFail($id);
        $imgData = DB::table('product_details')
            ->where('product_id', '=', $id)
            ->get();
        return view('config::product.addProductImage', compact('data','imgData'));

    }


    public function productImageSave(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.productImageSave')) {
            abort(403);
        } 

        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:20048',
        ]);

        $uploadedFiles = [];
        if ($request->hasfile('images')) {
            $i = 0;
            foreach ($request->file('images') as $get_image) {
                $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
                Image::make($get_image)->save(public_path('upload/productFile/' . $image_name, 50));
                $product_image = "upload/productFile/" . $image_name;
                ProductDetails::insert([
                    'product_id' => $request->data_id,
                    'title' => $request->title[$i],
                    'subtitle' => $request->sub_title[$i],
                    'content' => $request->content[$i],
                    'product_image' => $product_image,
                    'created_by' => Auth::user()->id,
                    'status' => 1,
                    'created_at' => Carbon::now()
                ]);
                $i++;
            }
        }
        return redirect()->route('config.product.admin');
    }

    public function productFileAdd($id)
    {
        if (!Auth::user()->hasPermissionTo('Product.productFileAdd')) {
            abort(403);
        }
        $data = Product::findOrFail($id);
        $fileData = DB::table('product_files')
            ->where('product_id', '=', $id)
            ->get();

        return view('config::product.addProductFile', compact('data','fileData'));
    }


    public function productFileSave(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.productFileSave')) {
            abort(403);
        } 

        $request->validate([
            'pdf_files' => 'required|array',
            'pdf_files.*' => 'mimes:pdf|max:10240', // max file size 10MB
        ]);

        $uploadedFiles = $request->file('pdf_files');
        var_dump($uploadedFiles);exit;
        $i=0;
        foreach ($uploadedFiles as $file) {
            $rand = str::random(5) . time();
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fullFileName = $rand.$fileName . '.' . $extension;
            //exit;
            $filePaths = $file->move(public_path('upload/productDetailsFile/'), $fullFileName);
            ProductFile::insert([
                'product_id' => $request->data_id,
                'title' => $request->title[$i],
                'file_name' => $fullFileName,
                'created_by' => Auth::user()->id,
                'status' => 1,
                'created_at' => Carbon::now()
            ]);
            $i++;
        }
        return redirect()->route('config.product.admin');
    }

    public function productAttributeAdd($id)
    {
        if (!Auth::user()->hasPermissionTo('Product.productAttributeAdd')) {
            abort(403);
        } 
        $data = Product::findOrFail($id);
        return view('config::product.addProductAttribute', compact('data'));
    }


    public function productAttributeSave(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.productAttributeSave')) {
            abort(403);
        } 
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required',
            'product_attribute_type_id' => 'required',
            'attribute_value' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $i = 0;
        foreach ($request->product_attribute_type_id as $product_attribute_type_id) {
            ProductAttribute::insert([
                'product_id' => $request->product_id,
                'product_attribute_type_id' => $product_attribute_type_id,
                'attribute_value' => $request->attribute_value[$i],
                'status' => 1,
                'remarks' => $request->remarks[$i],
            ]);
            $i++;
        }
        return redirect()->route('config.product.admin');
    }


    public function productSpecAdd($id)
    {
        if (!Auth::user()->hasPermissionTo('Product.productSpecAdd')) {
            abort(403);
        } 
        $data = Product::findOrFail($id);
        return view('config::product.addProductSpec', compact('data'));
    }

    public function productSpecSave(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.productSpecSave')) {
            abort(403);
        } 
        $validator = \Validator::make($request->all(), [
            'specification' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        // dd($request);
        Product::where('id', $request->product_id)->update([
            'specification' => $request->specification,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('config.product.admin');
    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function upload(Request $request): JsonResponse
    {
        if (!Auth::user()->hasPermissionTo('Product.upload')) {
            abort(403);
        } 

        if ($request->hasFile('upload')) {

            $originName = $request->file('upload')->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);

            $extension = $request->file('upload')->getClientOriginalExtension();

            $fileName = $fileName . '_' . time() . '.' . $extension;



            $request->file('upload')->move(public_path('upload/productFile'), $fileName);



            $url = asset('upload/productFile/' . $fileName);



            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);

        }

    }





    public function searchProductInfo(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.searchProductInfo')) {
            abort(403);
        } 
        if ($request->ajax()) {

            $data = DB::table('products')
                ->leftJoin('product_purchase_prices as pp', 'pp.product_id', '=', 'products.id')
                ->leftJoin('product_sell_prices as ps', 'ps.product_id', '=', 'products.id')

                ->where('code', 'LIKE', $request->product . "%")
                ->select('products.*', 'pp.purchase_price as purchase_price', 'ps.sell_price as sell_price')
                ->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul style="position:absolute;top:0px;left:-40px;z-index: 1;width:100%">';
                foreach ($data as $row) {
                    $output .= '<li data-purchase-price = "' . $row->purchase_price . '"data-sale-price = "' . $row->sell_price . '"  data-product-id = "' . $row->id . '"  data-product-detail = "' . $row->title . '(' . $row->code . ')" data-product-code = "' . $row->code . '" style="background:#dfe6e9;color:#2d3436;width:"130px;"padding-top:3px;padding:3px 10px;cursor:pointer;list-style:none" class="searchResultProduct">' . $row->title . ' (' . $row->code . ')</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= null;
            }
            return $output;
        }
    }

    public function getProductInfo(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.getProductInfo')) {
            abort(403);
        } 
        if ($request->ajax()) {
            $data = DB::table('products')->where('code', $request->product_code)->first();
            $stockQty = Inventory::stockQtyOfThisModel($data->id);
            return response()->json(['productId' => $data->id, 'productName' => $data->title, 'stockQty' => $stockQty]);
        }
    }

    public function getProductWithStock(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Product.getProductWithStock')) {
            abort(403);
        } 
        if ($request->ajax()) {
            $storeId = $request->store_id;
            $data = DB::table('products')->where('code', $request->product_code)->first();
            $stockQty = Inventory::stockQtyOfThisModelInStore($data->id, $storeId);
            return response()->json(['productId' => $data->id, 'productName' => $data->title, 'productCode' => $data->code, 'stockQty' => $stockQty]);
        }
    }
}

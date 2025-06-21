<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Modules\Config\Entities\Product;
use Modules\Config\Entities\ProductCategory;

class WebShopController extends Controller
{
    public function getAllProducts()
    {
        $products = ProductResource::collection(Product::orderBy('id', 'desc')->get());

        $data =
            [
                'products' => $products
            ];
        $response =
            [
                'status' => 'success',
                'success' => true,
                'message' => 'Web shop products fetched successfully. ',
                'data' => $data
            ];

        return response()->json($response, 200);
    }
    public function getAllCategoriesWithSubcategoriesWithAttachedProducts()
    {
        $categories = ProductCategoryResource::collection(ProductCategory::with(['productSubCategories.products'])->get());

        $data =
            [
                'categories' => $categories
            ];
        $response =
            [
                'status' => 'success',
                'success' => true,
                'message' => 'Web shop products fetched successfully. ',
                'data' => $data
            ];
        return response()->json($response, 200);
    }
}

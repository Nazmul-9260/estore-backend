<?php

use Illuminate\Support\Facades\Route;
use Modules\Config\Http\Controllers\ConfigController;
use Modules\Config\Http\Controllers\ConfigExportController;
use Modules\Config\Http\Controllers\ConfigImportController;
use Modules\Config\Http\Controllers\ProductBrandController;
use Modules\Config\Http\Controllers\UnitController;
use Modules\Config\Http\Controllers\ProductCategoryController;
use Modules\Config\Http\Controllers\ProductSubCategoryController;
use Modules\Config\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth'], 'prefix' => 'config', 'as' => 'config.'], function () {
    //
    Route::get('/configs', [ConfigController::class, 'index'])->name('index');
    Route::get('/configs/get-configs-datatable', [ConfigController::class, 'getConfigsDatatable'])->name('getConfigsDatatable');
    Route::post('/configs/update-config-type', [ConfigController::class, 'updateConfigType'])->name('updateConfigType');
    Route::post('/configs/update-config-name', [ConfigController::class, 'updateConfigName'])->name('updateConfigName');
    Route::post('/configs/update-config-value', [ConfigController::class, 'updateConfigValue'])->name('updateConfigValue');
    Route::post('/configs/update-config-status', [ConfigController::class, 'updateConfigStatus'])->name('updateConfigStatus');
    Route::get('/configs/get-config-row-template', [ConfigController::class, 'getNewDataRowInputTemplate'])->name('getNewDataRowInputTemplate');
    Route::post('/configs/store-config', [ConfigController::class, 'storeConfig'])->name('storeConfig');
    Route::delete('/configs/delete-config', [ConfigController::class, 'deleteConfig'])->name('deleteConfig');
    /**
     * Exports & Imports
     */
    Route::get('/configs/export/csv', [ConfigExportController::class, 'exportCsv'])->name('exportCsv');
    Route::post('/configs/import/csv', [ConfigImportController::class, 'importCsv'])->name('importCsv');
    Route::get('/configs/export/json', [ConfigExportController::class, 'exportJson'])->name('exportJson');
    Route::post('/configs/import/json', [ConfigImportController::class, 'importJson'])->name('importJson');

    //unit route

    Route::get('/unit/admin', [UnitController::class, 'admin']);
    Route::post('/unit/create', [UnitController::class, 'create']);
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit']);
    Route::post('/unit/update', [UnitController::class, 'update']);
    Route::get('/unit/delete/{id}', [UnitController::class, 'delete']);


    Route::get('/productCategory/admin', [ProductCategoryController::class, 'admin']);
    Route::post('/productCategory/create', [ProductCategoryController::class, 'create']);
    Route::get('/productCategory/edit/{id}', [ProductCategoryController::class, 'edit']);
    Route::post('/productCategory/update', [ProductCategoryController::class, 'update']);
    Route::get('/productCategory/delete/{id}', [ProductCategoryController::class, 'delete']);

    Route::get('/productSubCategory/admin', [ProductSubCategoryController::class, 'admin']);
    Route::post('/productSubCategory/create', [ProductSubCategoryController::class, 'create']);
    Route::get('/productSubCategory/edit/{id}', [ProductSubCategoryController::class, 'edit']);
    Route::post('/productSubCategory/update', [ProductSubCategoryController::class, 'update']);
    Route::get('/productSubCategory/delete/{id}', [ProductSubCategoryController::class, 'delete']);
    Route::get('/productSubCategory/subCategoryAttributeAdd/{id}', [ProductSubCategoryController::class, 'subCategoryAttributeAdd']);
    Route::post('/productSubCategory/subCategoryAttributeSave', [ProductSubCategoryController::class, 'subCategoryAttributeSave']);

    Route::get('/productBrand/admin', [ProductBrandController::class, 'admin']);
    Route::post('/productBrand/create', [ProductBrandController::class, 'create']);
    Route::get('/productBrand/edit/{id}', [ProductBrandController::class, 'edit']);
    Route::post('/productBrand/update', [ProductBrandController::class, 'update']);
    Route::get('/productBrand/delete/{id}', [ProductBrandController::class, 'delete']);

    Route::get('/product/admin', [ProductController::class, 'admin'])->name('product.admin');
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/save', [ProductController::class, 'save']);
    Route::post('/product/delete/{id}', [ProductController::class, 'delete']);
    Route::post('/product/deleteImg/{id}', [ProductController::class, 'deleteImg']);
    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/product/update', [ProductController::class, 'update']);
    Route::get('/search/product', [ProductController::class, 'searchProductInfo']);
    Route::get('/product/productImageAdd/{id}', [ProductController::class, 'productImageAdd']);
    Route::post('/product/productImageSave', [ProductController::class, 'productImageSave']);
    Route::get('/product/productFileAdd/{id}', [ProductController::class, 'productFileAdd']);
    Route::post('/product/productFileSave', [ProductController::class, 'productFileSave']);
    Route::get('/product/productAttributeAdd/{id}', [ProductController::class, 'productAttributeAdd']);
    Route::post('/product/productAttributeSave', [ProductController::class, 'productAttributeSave']);
    Route::get('/product/productSpecAdd/{id}', [ProductController::class, 'productSpecAdd']);
    Route::post('/product/productSpecSave', [ProductController::class, 'productSpecSave']);
    Route::get('/getProduct/prodCode/{code}', [ProductController::class, 'getProductInfo']);
    Route::get('/getProduct/prodCodeWithQty/{code}', [ProductController::class, 'getProductWithStock']);

    Route::post('/product/upload', [ProductController::class, 'upload'])->name('product.upload');
});

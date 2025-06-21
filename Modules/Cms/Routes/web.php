<?php

use Modules\Cms\Http\Controllers\CmsBannerController;
use Modules\Cms\Http\Controllers\CmsMenuController;
use Modules\Cms\Http\Controllers\SiteInfoController;

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


Route::group(['middleware' => ['auth'], 'prefix' => 'cms', 'as' => 'cms.'], function () {
    //Site Info
    Route::get('/siteInfo/admin', [SiteInfoController::class, 'admin'])->name('siteInfo.admin');
    Route::get('/siteInfo/create', [SiteInfoController::class, 'create']);
    Route::post('/siteInfo/save', [SiteInfoController::class, 'save']);
    Route::get('/siteInfo/delete/{id}', [SiteInfoController::class, 'delete']);
    Route::get('/siteInfo/edit/{id}', [SiteInfoController::class, 'edit']);
    Route::post('/siteInfo/update', [SiteInfoController::class, 'update']);

    Route::get('/cmsMenu/admin', [CmsMenuController::class, 'admin']);
    Route::post('/cmsMenu/create', [CmsMenuController::class, 'create']);
    Route::get('/cmsMenu/edit/{id}', [CmsMenuController::class, 'edit']);
    Route::post('/cmsMenu/update', [CmsMenuController::class, 'update']);
    Route::get('/cmsMenu/delete/{id}', [CmsMenuController::class, 'delete']);

    Route::get('/cmsBanner/admin', [CmsBannerController::class, 'admin']);
    Route::get('/cmsBanner/create', [CmsBannerController::class, 'create']);
    Route::post('/cmsBanner/save', [CmsBannerController::class, 'save']);
    Route::get('/cmsBanner/edit/{id}', [CmsBannerController::class, 'edit']);
    Route::post('/cmsBanner/update', [CmsBannerController::class, 'update']);
    Route::get('/cmsBanner/delete/{id}', [CmsBannerController::class, 'delete']);
});
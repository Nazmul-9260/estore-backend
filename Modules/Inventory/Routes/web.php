<?php

use Modules\Inventory\Http\Controllers\InventoryController;

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

Route::group(['middleware' => ['auth'], 'prefix' => 'inventory', 'as' => 'inventory.'], function () {
    Route::get('/inventory/admin', [InventoryController::class, 'admin']);
    Route::post('/inventory/create', [InventoryController::class, 'create']);
    Route::get('/inventory/edit/{id}', [InventoryController::class, 'edit']);
    Route::post('/inventory/update', [InventoryController::class, 'update']);
    Route::get('/inventory/delete/{id}', [InventoryController::class, 'delete']);
});

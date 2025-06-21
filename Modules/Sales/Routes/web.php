<?php

use Modules\Sales\Http\Controllers\SalesOrderController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth'], 'prefix' => 'sales', 'as' => 'sales.'], function () {
    //Site Info
    Route::get('/salesOrder/admin', [SalesOrderController::class, 'admin']);
    Route::get('/salesOrder/delete/{id}', [SalesOrderController::class, 'delete']);
    Route::get('/salesOrder/get-order-status-dropdown-list/{salesOrderId}', [SalesOrderController::class, 'getOrderStatusWithDropdownList']);
    Route::post('/salesOrder/update-order-status', [SalesOrderController::class, 'updateOrderStatus']);
    Route::get('/salesOrder/get-delivery-form-view/{salesOrderId}', [SalesOrderController::class, 'getDeliveryFormView']);
    Route::post('/salesOrder/deliver', [SalesOrderController::class, 'deliver']);
});

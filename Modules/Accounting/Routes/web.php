<?php

use Illuminate\Support\Facades\Route;
use Modules\Accounting\Http\Controllers\PaymentReceiveController;

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

Route::group(['middleware' => ['auth'], 'prefix' => 'accounting', 'as' => 'accounting.'], function () {
    Route::get('salesOrder/payment-receive/admin', [PaymentReceiveController::class, 'admin'])->name('salesOrder.paymentReceive.admin');
    Route::get('salesOrder/get-payment-receive-form-view/{customerId}', [PaymentReceiveController::class, 'getPaymentReceiveFormView'])->name('salesOrder.getPaymentReceiveFormView');
    Route::post('salesOrder/paymentReceives', [PaymentReceiveController::class, 'storePaymentReceive'])->name('salesOrder.paymentReceive.store');
});

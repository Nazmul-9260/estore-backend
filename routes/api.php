<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [App\Http\Controllers\Api\AuthenticationController::class, 'login']);


Route::post('register', [App\Http\Controllers\Api\AuthenticationController::class, 'register']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    /** User Details */
    Route::get('/user-details', [App\Http\Controllers\Api\AuthenticationController::class, 'getUserDetails']);
    /** */
    /** User Refresh Token */
    Route::get('/refresh-token', [App\Http\Controllers\Api\AuthenticationController::class, 'refreshToken']);
    /** */

    /** User Logout */
    Route::get('/logout', [App\Http\Controllers\Api\AuthenticationController::class, 'logout']);
    /** User Logout From All Devices */
    Route::get('/logout-from-all-devices', [App\Http\Controllers\Api\AuthenticationController::class, 'logoutFromAllDevices']);
});


/** Web Shop Endpoints */

Route::group(['middleware' => [], 'prefix' => 'v1'], function () {
    /** OTP */
    Route::group(['middleware' => ['throttle:otp']], function () {
        Route::post('generate-otp', [App\Http\Controllers\Api\CustomerAuthController::class, 'generateOtp']);
        Route::post('verify-otp', [App\Http\Controllers\Api\CustomerAuthController::class, 'verifyOtp']);
    });
    Route::get('login', [App\Http\Controllers\Api\CustomerAuthController::class, 'login']);
    /**
     * Open Public Site API
     */
    // CMS 
    Route::get('site-info', [App\Http\Controllers\Api\CmsController::class, 'getSiteInfo']);
    Route::get('top-menu', [App\Http\Controllers\Api\CmsController::class, 'getTopMenu']);
    Route::get('topbar-info', [App\Http\Controllers\Api\CmsController::class, 'getTopbarInfo']);
    Route::get('footer-menu', [App\Http\Controllers\Api\CmsController::class, 'getFooterMenu']);
    Route::get('hero-sliders', [App\Http\Controllers\Api\CmsController::class, 'getHeroSliders']);
    Route::get('productCategories-with-subcategories-with-attached-products', [App\Http\Controllers\Api\CmsController::class, 'getAllCategoriesWithSubcategoriesWithAttachedProducts']);
    Route::get('products/filter', [App\Http\Controllers\Api\CmsController::class, 'getProductsFilterByTag']);
    Route::get('products', [App\Http\Controllers\Api\CmsController::class, 'getAllProducts']);
    Route::get('customer-address-types', [App\Http\Controllers\Api\CmsController::class, 'getCustomerAddessTypes']);
    Route::get('product-tags', [App\Http\Controllers\Api\CmsController::class, 'getAllProductTags']);
    Route::get('order-status-types', [App\Http\Controllers\Api\CmsController::class, 'getOrderStatusTypes']);


    /**Protected */
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('customer-details', [App\Http\Controllers\Api\CustomerAuthController::class, 'getCustomerDetails']);
        Route::get('customer-logout', [App\Http\Controllers\Api\CustomerAuthController::class, 'logout']);
        Route::get('customer-logout-all-devices', [App\Http\Controllers\Api\CustomerAuthController::class, 'logoutAllDevices']);
        Route::post('customer-profile/add-address', [App\Http\Controllers\Api\CustomerProfileController::class, 'addAddress']);
        Route::put('customer-profile/edit-address/{customerAddressId}', [App\Http\Controllers\Api\CustomerProfileController::class, 'editAddress']);
        Route::post('customer-profile/add-personal-info', [App\Http\Controllers\Api\CustomerProfileController::class, 'addPersonalInfo']);
        Route::put('customer-profile/update-personal-info', [App\Http\Controllers\Api\CustomerProfileController::class, 'updatePersonalInfo']);
        Route::put('customer-profile/address/set-default', [App\Http\Controllers\Api\CustomerProfileController::class, 'setDefaultAddress']);

        /** Customer Order Checkout */
        Route::get('customer-orders', [App\Http\Controllers\Api\CmsController::class, 'getCustomerOrders']);
        Route::post('confirm-order', [App\Http\Controllers\Api\CmsController::class, 'confirmOrder']);

        Route::post('pay-ssl', [SslCommerzPaymentController::class, 'payViaAjaxApi']);
        Route::post('success', [SslCommerzPaymentController::class, 'success']);
        Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
        Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

        Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

        /** Product QA */
        Route::get('product-qas/{productId}', [App\Http\Controllers\Api\CmsController::class, 'getProductQasByProductId']);
        Route::post('product-qas', [App\Http\Controllers\Api\CmsController::class, 'createProductQasFromCustomer']);
        /** Product Review */
        Route::get('product-reviews/{productId}', [App\Http\Controllers\Api\CmsController::class, 'getProductReviewByProductId']);
        Route::post('product-reviews', [App\Http\Controllers\Api\CmsController::class, 'createProductReviewFromCustomer']);
        /** Customer Reviews */
        Route::get('customer-reviews', [App\Http\Controllers\Api\CmsController::class, 'getCustomerReviews']);
        /** Customer QAs */
        Route::get('customer-qas', [App\Http\Controllers\Api\CmsController::class, 'getCustomerQas']);
        /** Customer Payments History */
        Route::get('customer/payments', [App\Http\Controllers\Api\CmsController::class, 'getCustomerPayments']);
    });
});

Route::get('/test-jwt', [App\Http\Controllers\JwtTestController::class, 'index']);
Route::get('/test-mail', [App\Http\Controllers\EmailTestController::class, 'sendTestMail']);

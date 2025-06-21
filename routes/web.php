<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;
// use Illuminate\Support\Facades\URL;

// if (env('APP_ENV') === 'production') {
//     URL::forceScheme('https');
// }

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

Route::get('/', function () {
    return view('auth.login');
});

/**
 * Theme Routes
 * 
 */

Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin-sample-page', [App\Http\Controllers\AdminSamplePageController::class, 'getSamplePage']);

    Route::get('/admin-content-page', [App\Http\Controllers\AdminSamplePageController::class, 'getContentPage']);

    Route::get('/admin-demo-page', [App\Http\Controllers\AdminSamplePageController::class, 'getDemoPage']);

    Route::get('/dashboard', [App\Http\Controllers\AdminSamplePageController::class, 'getDashboardPage']);

    Route::get('/components', [App\Http\Controllers\AdminSamplePageController::class, 'getComponentsPage']);

    Route::get('/summer-note', [App\Http\Controllers\AdminSamplePageController::class, 'getSummerNotePage']);

    Route::get('/default-datatables', [App\Http\Controllers\AdminSamplePageController::class, 'getDatatablesPage']);

    Route::get('/yajra-datatables', [App\Http\Controllers\AdminSamplePageController::class, 'getYajraDatatablesPage']);

    Route::get('/users-data-get-users', [App\Http\Controllers\AdminSamplePageController::class, 'getUsersDataUserList']);

    Route::get('/admin-module-settings', [App\Http\Controllers\AdminSamplePageController::class, 'getModuleSettingsPage']);

    Route::get('/admin-user-settings', [App\Http\Controllers\AdminSamplePageController::class, 'getUserSettingsPage']);

    Route::get('/admin-dashboard-1', [App\Http\Controllers\AdminSamplePageController::class, 'getAdminDashboardPageOne']);
    Route::get('/admin-dashboard-2', [App\Http\Controllers\AdminSamplePageController::class, 'getAdminDashboardPageTwo']);
    Route::get('/admin-dashboard-3', [App\Http\Controllers\AdminSamplePageController::class, 'getAdminDashboardPageThree']);
    Route::get('/admin-dashboard-4', [App\Http\Controllers\AdminSamplePageController::class, 'getAdminDashboardPageFour']);

    Route::get('/patient-dashboard', [App\Http\Controllers\AdminSamplePageController::class, 'getPatientDashboard']);
    Route::get('/patient-profile', [App\Http\Controllers\AdminSamplePageController::class, 'getPatientProfile']);
    Route::get('/editable-datatable', [App\Http\Controllers\AdminSamplePageController::class, 'getEditableDatatable']);
    Route::get('/employee-create', [App\Http\Controllers\AdminSamplePageController::class, 'EmployeeCreate']);
});

Route::get('/login-via-phone', [App\Http\Controllers\AdminSamplePageController::class, 'getLoginViaPhonePage']);
Route::get('/appointment', [App\Http\Controllers\AdminSamplePageController::class, 'getAppointment']);
Route::get('/step-form', [App\Http\Controllers\AdminSamplePageController::class, 'getStepForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Production Routes
 * 
 */

/** Access Control List */

Route::group(['prefix' => 'acl', 'middleware' => ['auth', 'validate'], 'as' => 'acl.'], function () {

    // Test 
    Route::get('modules/modules-with-permissions', [\App\Http\Controllers\Acl\ModuleController::class, 'getAllModulesWithSubmodulesWithPermissions']);

    Route::get('route-list', [\App\Http\Controllers\Acl\RouteListingController::class, 'getAllControllersWithMethodsGrouped']);

    Route::get('route-list-pg', [\App\Http\Controllers\Acl\RouteListingController::class, 'permissionGeneration']);

    // Invokable : Both are valid syntax as namespace set in route service provider.
    Route::get('invoke', SingleActionController::class);
    Route::get('invoke', '\App\Http\Controllers\SingleActionController');
    Route::get('exe', [\App\Http\Controllers\TaskController::class, 'exe']);
    // Ends


    // End of tests


    /** Roles */
    Route::get('roles/{role}/edit-details', [\App\Http\Controllers\Acl\RoleController::class, 'editRoleDetails'])->name('role.edit_deatils');
    Route::post('roles/{role}/update-details', [\App\Http\Controllers\Acl\RoleController::class, 'updateRoleDetails'])->name('role.update_deatils');
    Route::get('roles/get-permissions-by-roles', [\App\Http\Controllers\Acl\RoleController::class, 'getPermissionsByRolesId'])->name('role.get_permissions_by_roles');

    /** Permissions */

    Route::get('permissions/generate', [\App\Http\Controllers\Acl\PermissionController::class, 'generatePermissions'])->name('permission.generate_permissions');
    Route::post('permissions/generate', [\App\Http\Controllers\Acl\PermissionController::class, 'saveGeneratedPermissions'])->name('permission.save_generated_permissions');

    /** Users  */
    Route::get('users/list/search-by-email', [\App\Http\Controllers\Acl\UserController::class, 'searchUsersByEmail'])->name('user.search_users_by_email');
    Route::get('users/list/search-by-name', [\App\Http\Controllers\Acl\UserController::class, 'searchUsersByName'])->name('user.search_users_by_name');
    Route::get('users/list', [\App\Http\Controllers\Acl\UserController::class, 'indexUsersAsync'])->name('user.index_users_async');
    Route::post('users/activate-users', [\App\Http\Controllers\Acl\UserController::class, 'activateUsers'])->name('user.active_users');
    Route::post('users/deactivate-users', [\App\Http\Controllers\Acl\UserController::class, 'deactivateUsers'])->name('user.deactive_users');
    Route::post('users/delete-users', [\App\Http\Controllers\Acl\UserController::class, 'deleteUsers'])->name('user.delete_users');
    Route::get('users/filter-by-account-status', [\App\Http\Controllers\Acl\UserController::class, 'getUsersByAccountStatus'])->name('user.filter_by_account_status');
    Route::post('users/update-user-role-single', [\App\Http\Controllers\Acl\UserController::class, 'updateUserRoleSingle'])->name('user.update_user_role_single');
    Route::get('users/{user}/edit-custom-permissions', [\App\Http\Controllers\Acl\UserController::class, 'editCustomPermissions'])->name('user.edit_custom_permissions');
    Route::post('users/{user}/update-custom-permissions', [\App\Http\Controllers\Acl\UserController::class, 'updateCustomPermissions'])->name('user.update_custom_permissions');
    
    /** Resource Routes */
    Route::resource('modules', \Acl\ModuleController::class);
    Route::resource('submodules', \Acl\SubmoduleController::class);
    Route::resource('roles', \Acl\RoleController::class);
    Route::resource('permissions', \Acl\PermissionController::class);
    Route::resource('users', \Acl\UserController::class);
});



// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay-via-ajax-done', [SslCommerzPaymentController::class, 'redirectSFront'])->name('sslpay.redirectSFront');


Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

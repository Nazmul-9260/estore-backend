<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactController;

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

Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
    //Route::get('/', 'DemoController@index');
    /**
     * Ajax CRUD Endpoints
     */
    Route::delete('contacts/{contact}/ajax', [Modules\Contact\Http\Controllers\ContactController::class, 'destroyContactAjax'])->name('contacts.updateContactAjax');
    Route::put('contacts/{contact}/ajax', [Modules\Contact\Http\Controllers\ContactController::class, 'updateContactAjax'])->name('contacts.updateContactAjax');
    Route::get('contacts/{contact}/ajax', [Modules\Contact\Http\Controllers\ContactController::class, 'showContactAjax'])->name('contacts.showContactAjax');
    Route::post('contacts/contact/ajax', [Modules\Contact\Http\Controllers\ContactController::class, 'storeContactAjax'])->name('contacts.storeContactAjax');
    /** Get Contacts Listings */
    Route::get('/contacts/get-contacts-datatable', [Modules\Contact\Http\Controllers\ContactController::class, 'getContactsDatatable'])->name('contacts.getContactsDatatable')->middleware('auth');
    Route::get('/contacts-scoped-view', [Modules\Contact\Http\Controllers\ContactController::class, 'getScopedLayoutViewPage'])->name('getScopedLayoutViewPage')->middleware('auth');
    /** SSR CRUD */
    Route::resource('contacts', Modules\Contact\Http\Controllers\ContactController::class)->middleware('auth');
});

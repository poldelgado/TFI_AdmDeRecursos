<?php

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
    return view('home');
});

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/providers/associate_technician', 'ProviderController@associateTechnician')->middleware('auth');

Route::get('/providers/technicians/{provider_id}', 'ProviderController@techniciansList')->middleware('auth');

Route::post('/providers/detach_technician', 'ProviderController@detachTechnician')->middleware('auth');

Route::resource('/providers', 'ProviderController')->middleware('auth');

Route::resource('/technicians', 'TechnicianController')->middleware('auth');

Route::resource('/users', 'UserController')->middleware('auth');

Route::get('/is_admin', 'UserController@is_admin')->name('is_admin');

Route::get('/is_logged_in', 'UserController@is_logged_in')->name('is_logged_in');

Route::resource('/products', 'ProductController')->middleware('auth');

Route::post('/products_providers/detach_product', 'ProductProviderController@detachProduct')->middleware('auth');

Route::get('/products_providers/find/{provider_id}', 'ProductProviderController@find')->middleware('auth');

Route::resource('/products_providers', 'ProductProviderController')->middleware('auth');

Route::get('/purchase_orders/graph', 'PurchaseOrderController@graphic1')->middleware('auth');

Route::resource('/purchase_orders', 'PurchaseOrderController')->middleware('auth');

Route::get('/purchase_orders/getSinCalificar', 'PurchaseOrderController@getSinCalificar')->middleware('auth');

Route::get('/findProductName', 'ProductController@findProductName')->name('findProductName');

Route::get('/purchase_orders/qualify/{order_id}', 'PurchaseOrderController@qualifyPurchaseOrder')->name('qualifyPurchaseOrder')->middleware('auth');

Route::put('purchase_orders/qualify_update/{buy_order_qualification_id}', 'PurchaseOrderController@updateQualification')->name('qualificationOrderUpdate')->middleware('auth');

Route::get('/export_users', 'ExcelController@exportUsers')->middleware('auth');
Route::get('/export_providers', 'ExcelController@exportProviders')->middleware('auth');
Route::get('/export_products', 'ExcelController@exportProducts')->middleware('auth');
Route::get('/export_purchase_orders', 'ExcelController@exportPurchaseOrders')->middleware('auth');
Route::get('/export_technicians', 'ExcelController@exportTechnicians')->middleware('auth');
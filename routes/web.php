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

Route::resource('/providers', 'ProviderController')->middleware('auth');

Route::resource('/tecnicos', 'TechnicianController')->middleware('auth');

Route::resource('/products', 'ProductController')->middleware('auth');

Route::resource('/prod_provs', 'ProductProviderController')->middleware('auth');

Route::resource('/buy_orders', 'PurchaseOrderController')->middleware('auth');

Route::get('/findProductName', 'ProductController@findProductName')->name('findProductName');

Route::get('/buy_orders/qualificate/{order_id}', 'PurchaseOrderController@qualificatePurchaseOrder')->name('qualificatePurchaseOrder')->middleware('auth');

Route::put('buy_orders/qualificate/{buy_order_qualification_id}', 'PurchaseOrderController@updateQualification')->name('qualificationOrderUpdate')->middleware('auth');
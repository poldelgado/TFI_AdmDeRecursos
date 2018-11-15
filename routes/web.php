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

Route::resource('/technicians', 'TechnicianController')->middleware('auth');

Route::resource('/users', 'UserController')->middleware('auth');

Route::get('/users/is_admin', 'UserController@is_admin')->name('is_admin');

Route::get('/users/is_logged_in', 'UserController@is_logged_in')->name('is_logged_in');

Route::resource('/products', 'ProductController')->middleware('auth');

Route::resource('/products_providers', 'ProductProviderController')->middleware('auth');

Route::resource('/purchase_orders', 'PurchaseOrderController')->middleware('auth');

Route::get('/purchase_orders/getSinCalificar', 'PurchaseOrderController@getSinCalificar')->middleware('auth');

Route::get('/findProductName', 'ProductController@findProductName')->name('findProductName');

Route::get('/purchase_orders/qualify/{order_id}', 'PurchaseOrderController@qualifyPurchaseOrder')->name('qualifyPurchaseOrder')->middleware('auth');

Route::put('purchase_orders/qualify_update/{buy_order_qualification_id}', 'PurchaseOrderController@updateQualification')->name('qualificationOrderUpdate')->middleware('auth');
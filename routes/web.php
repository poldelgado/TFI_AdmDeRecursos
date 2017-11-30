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

Route::resource('/providers', 'ProviderController');

Route::resource('/tecnicos', 'TecnicoController');

Route::resource('/products', 'ProductController');

Route::resource('/prod_provs', 'ProductProviderController');

Route::resource('/buy_orders', 'BuyOrderController');

Route::get('/findProductName', 'ProductController@findProductName')->name('findProductName');
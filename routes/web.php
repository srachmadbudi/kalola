<?php

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('transaction', 'Business\TransactionController');
Route::resource('customer', 'Business\CustomerController');
Route::resource('order', 'OrderController');
Route::resource('category', 'Business\ProductCategoryController')->except(['create', 'show']);
Route::resource('product', 'Business\ProductController')->except(['show']);
Route::resource('pegawai', 'Business\PegawaiController')->except(['create', 'show']);
Route::resource('supplier', 'Business\SupplierController')->except(['create', 'show']);
Route::resource('capital', 'CapitalController');
Route::resource('asset', 'AssetController');
Route::resource('debt', 'DebtController');
Route::get('/get/cities', 'Business\CustomerController@getCity')->name('get-city');
Route::get('/get/districts', 'Business\CustomerController@getDistrict')->name('get-district');

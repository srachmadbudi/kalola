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

Route::group(['prefix' => 'transactions', 'namespace' => 'Business'], function() {
    Route::get('/', 'TransactionController@index')->name('transaction.list');
    Route::get('/{id}', 'TransactionController@show')->name('transaction.show');
    Route::get('/add', 'TransactionController@create')->name('transaction.add');
    Route::post('/add', 'TransactionController@store')->name('transaction.post_add');
    Route::get('/edit/{id}', 'TransactionController@edit')->name('transaction.edit');
    Route::post('/edit/{id}', 'TransactionController@update')->name('transaction.post_edit');
    Route::post('/delete/{id}', 'TransactionController@destroy')->name('transaction.delete');
});

// Route::group(['prefix' => 'category', 'namespace' => 'Business'], function() {
//     Route::get('/', 'ProductCategoryController@index')->name('category.list');
//     Route::post('/add', 'ProductCategoryController@store')->name('category.store');
//     Route::get('/edit/{id}', 'ProductCategoryController@edit')->name('category.edit');
//     Route::post('/edit/{id}', 'ProductCategoryController@update')->name('category.post_edit');
//     Route::post('/delete/{id}', 'ProductCategoryController@destroy')->name('category.delete');
// });

Route::resource('category', 'ProductCategoryController')->except(['create', 'show']);
Route::resource('product', 'ProductController')->except(['show']);
Route::resource('pegawai', 'PegawaiController')->except(['create', 'show']);

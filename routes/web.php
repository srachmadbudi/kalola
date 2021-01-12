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

Route::group(['prefix' => 'employees', 'namespace' => 'Business'], function() {
    Route::get('/', 'EmployeeController@index')->name('employee.list');
    Route::get('/{id}', 'EmployeeController@show')->name('employee.show');
    Route::get('/add', 'EmployeeController@create')->name('employee.create');
    Route::post('/add', 'EmployeeController@store')->name('employee.store');
    Route::get('/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
    Route::post('/edit/{id}', 'EmployeeController@update')->name('employee.update');
    Route::post('/delete/{id}', 'EmployeeController@destroy')->name('employee.destroy');
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
Route::resource('supplier', 'SupplierController')->except(['create', 'show']);
Route::resource('debt', 'DebtController')->except(['create', 'show']);
Route::resource('asset', 'AssetController')->except(['create', 'show']);
Route::resource('modal', 'ModalController')->except(['create', 'show']);
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
    Route::post('/add', 'TransactionController@store')->name('transaction.store');
    Route::get('/edit/{id}', 'TransactionController@edit')->name('transaction.edit');
    Route::post('/edit/{id}', 'TransactionController@update')->name('transaction.update');
    Route::delete('/delete/{id}', 'TransactionController@destroy')->name('transaction.destroy');
});

Route::group(['prefix' => 'employees', 'namespace' => 'Business'], function() {
    Route::get('/', 'EmployeeController@index')->name('employee.list');
    Route::get('/{id}', 'EmployeeController@show')->name('employee.show');
    Route::get('/add', 'EmployeeController@create')->name('employee.create');
    Route::post('/add', 'EmployeeController@store')->name('employee.store');
    Route::get('/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
    Route::post('/edit/{id}', 'EmployeeController@update')->name('employee.update');
    Route::post('/delete/{id}', 'EmployeeController@destroy')->name('employee.destroy');
});
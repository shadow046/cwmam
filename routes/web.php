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

Auth::routes();

Route::get('/', 'HomeController@index');
//Route::get('service_center', 'BranchController@index');
Route::get('customer', 'HomeController@customer');
Route::get('service_units', 'HomeController@service_units');
Route::get('spare_parts', 'HomeController@spare_parts');
Route::get('return', 'HomeController@return');



Route::get('request', 'StockRequestController@index')->name('stock.index');

Route::get('users', 'UserController@getUsers')->name('get.users');
Route::get('user', 'UserController@index')->name('user.index');
Route::get('getBranchName', 'UserController@getBranchName')->name('user.getBranch');
Route::post('user_add', 'UserController@store')->name('user.add');
Route::put('user_update/{id}', 'UserController@update')->name('user.update');

Route::get('branches', 'BranchController@getBranches')->name('get.branches');
Route::get('branch', 'BranchController@index')->name('branch.index');
Route::post('branch_add', 'BranchController@store')->name('branch.add');
Route::put('branch_update/{id}', 'BranchController@update')->name('branch.update');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


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




Route::get('show', 'StockController@show')->name('stocks.show');
Route::get('stocks', 'StockController@index')->name('stocks.index');

Route::put('update/{id}', 'StockRequestController@update')->name('stock.update');
Route::get('getstock', 'StockRequestController@getStock')->name('stock.get');
Route::get('getserials', 'StockRequestController@getSerials')->name('stock.serials');
Route::get('itemcode', 'StockRequestController@getItemCode')->name('stock.get.itemcode');
Route::get('read/{id}', 'StockRequestController@read')->name('stock.read');
Route::delete('delete/{id}', 'StockRequestController@destroy')->name('stock.delete');
Route::get('send/{id}', 'StockRequestController@getsendDetails')->name('stock.send');
Route::get('requests/{id}', 'StockRequestController@getRequestDetails')->name('get.reqdetails');
Route::get('requests', 'StockRequestController@getRequests')->name('get.requests');
Route::get('request', 'StockRequestController@index')->name('stock.index');
Route::get('view', 'StockRequestController@view')->name('stock.view');

Route::get('users', 'UserController@getUsers')->name('get.users');
Route::get('user', 'UserController@index')->name('user.index');
Route::get('getBranchName', 'UserController@getBranchName')->name('user.getBranch');
Route::post('user_add', 'UserController@store')->name('user.add');
Route::put('user_update/{id}', 'UserController@update')->name('user.update');

Route::get('stocks/{id}', 'BranchController@getStocks')->name('get.stocks');
Route::get('branches', 'BranchController@getBranches')->name('get.branches');
Route::get('branch', 'BranchController@index')->name('branch.index');
Route::post('branch_add', 'BranchController@store')->name('branch.add');
Route::put('branch_update/{id}', 'BranchController@update')->name('branch.update');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


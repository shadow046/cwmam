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


Route::put('rep-update', 'StockController@update')->name('stocks.update');
Route::get('pull-details1/{id}', 'StockController@pulldetails1')->name('stocks.details1.pullout');
Route::get('pull-details/{id}', 'StockController@pulldetails')->name('stocks.details.pullout');
Route::put('service-in', 'StockController@servicein')->name('stock.service-in');
Route::get('serial', 'StockController@serial')->name('stock.serial');
Route::get('description', 'StockController@description')->name('stock.description');
Route::get('category', 'StockController@category')->name('stock.category');
Route::get('service-unit', 'StockController@service')->name('stock.service-unit');
Route::get('sUnit', 'StockController@serviceUnit')->name('stock.sUnit');
Route::get('pclient-autocomplete', 'StockController@pautocompleteClient')->name('pclient.autocomplete');
Route::get('pcustomer-autocomplete', 'StockController@pautocompleteCustomer')->name('pcustomer.autocomplete');
Route::get('client-autocomplete', 'StockController@autocompleteClient')->name('client.autocomplete');
Route::get('customer-autocomplete', 'StockController@autocompleteCustomer')->name('customer.autocomplete');
Route::put('service-out', 'StockController@serviceOut')->name('stocks.out');
Route::post('pull-out', 'StockController@pullOut')->name('stocks.pullout');
Route::post('upload', 'StockController@import')->name('stocks.upload');
Route::post('additem', 'StockController@addItem')->name('add.item');
Route::post('addcategory', 'StockController@addCategory')->name('add.category');
Route::post('store', 'StockController@store')->name('stocks.store');
Route::get('viewStock', 'StockController@viewStocks')->name('stocks.view');
Route::get('show', 'StockController@show')->name('stocks.show');
Route::get('stocks', 'StockController@index')->name('stocks.index');

Route::get('gen', 'StockRequestController@generateBarcodeNumber')->name('stock.gen');
Route::put('update', 'StockRequestController@update')->name('stock.update');
Route::post('storerequest', 'StockRequestController@store')->name('stock.store.request');
Route::delete('remove', 'StockRequestController@dest')->name('stock.remove');
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


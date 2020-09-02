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
Route::get('service_center', 'HomeController@service_center');
Route::get('customer', 'HomeController@customer');
Route::get('stock_request', 'HomeController@stock_request');
Route::get('service_units', 'HomeController@service_units');
Route::get('spare_parts', 'HomeController@spare_parts');
Route::get('return', 'HomeController@return');
Route::get('users', 'HomeController@users');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

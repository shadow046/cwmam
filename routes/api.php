<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('global', 'SearchController@global')->middleware('ajax');
    Route::get('search', 'SearchController@show')->middleware('ajax');
    Route::get('lcc', 'SearchController@getLCC')->middleware('ajax');;
    Route::get('mspg', 'SearchController@getMSPG')->middleware('ajax');
    Route::get('puregold', 'SearchController@getPUREGOLD')->middleware('ajax');
    Route::get('shoemart', 'SearchController@getSHOEMART')->middleware('ajax');
    Route::get('smma', 'SearchController@getSMMA')->middleware('ajax');
});
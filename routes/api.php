<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('login', 'Auth\AuthenticateController@authenticate');
Route::post('login-refresh', 'Auth\AuthenticateController@refreshToken');
Route::get('me', 'Auth\AuthenticateController@getAuthenticatedUser');


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::resource('home', 'HomeController');
//Route::group(['middleware' => ['apiJwt']], function () {
//   Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {
//    Route::group(['middleware' => ['api']], function () {

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {


    Route::get('H100/{id}/H101', 'H100APIController@H101');
    Route::get('H100/{D009_Id},{Status}/getSaldo', 'H100APIController@getSaldo');
    Route::resource('H100', 'H100APIController');  



    Route::get('H101/{id}/H100', 'H101APIController@H100');
    Route::resource('H101', 'H101APIController');

    Route::get('purchaseHistOrders/{id}/H101', 'H100APIController@H101');
    Route::get('purchaseHistOrders/{D009_Id},{Status}/getSaldo', 'H100APIController@getSaldo');
    Route::resource('purchaseHistOrders', 'PurchaseHistOrdersAPIController');    

    Route::resource('purchaseHistIncomingInvoices', 'PurchaseHistIncomingInvoiceAPIController');

});



























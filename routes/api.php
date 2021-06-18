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

Route::post('login', 'Auth\AuthenticateController@authenticate');
Route::post('login-refresh', 'Auth\AuthenticateController@refreshToken');
Route::get('me', 'Auth\AuthenticateController@getAuthenticatedUser');

#    Route::group(['namespace' => 'Api', 'middleware' => 'auth:api','scheme' => 'https'], function () {

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {

    Route::get('purchaseHistOrders/{D009_Id},{Status}/getpurchaseHistOrdersProducts', 'PurchaseHistOrdersAPIController@getpurchaseHistOrdersProducts');
    Route::get('purchaseHistOrders/{T011_Id}/purchaseHistIncomingInvoicesJoin', 'PurchaseHistOrdersAPIController@purchaseHistIncomingInvoicesJoin');
    Route::get('purchaseHistOrders/{T012_Id},{Status}/getpurchaseHistOrdersItens', 'PurchaseHistOrdersAPIController@getpurchaseHistOrdersItens');
    Route::get('purchaseHistOrders/{T011_Id}/purchaseHistIncomingInvoices', 'PurchaseHistOrdersAPIController@purchaseHistIncomingInvoices');
    Route::get('purchaseHistOrders/{D009_Id},{Status}/getSaldoTotal', 'PurchaseHistOrdersAPIController@getSaldoTotal');
    Route::get('purchaseHistOrders/{T012_Id},{T012_D009_Id},{T011_C004_Id},{T012_Valor_Custo_Unitario},{Status}/getId', 'PurchaseHistOrdersAPIController@getId');
    Route::get('purchaseHistOrders/{T012_Id},{Status}/getSaldoT012Id', 'PurchaseHistOrdersAPIController@getSaldoT012Id');
    Route::resource('purchaseHistOrders', 'PurchaseHistOrdersAPIController');    

    Route::get('purchaseHistIncomingInvoices/{HRD_T014_Id}/getpurchaseHistIncomingInvoices', 'PurchaseHistIncomingInvoiceAPIController@getpurchaseHistIncomingInvoices');
    Route::get('purchaseHistIncomingInvoices/{PHO_Id},{HRD_T014_Id},{HRD_Flag_Cancelado}/getphiiCancel', 'PurchaseHistIncomingInvoiceAPIController@getphiiCancel');
    Route::get('purchaseHistIncomingInvoices/{id},{Status}/getSaldoId', 'PurchaseHistIncomingInvoiceAPIController@getSaldoId');
    Route::get('purchaseHistIncomingInvoices/{id}/purchaseHistOrders', 'PurchaseHistIncomingInvoiceAPIController@purchaseHistOrders');
    Route::resource('purchaseHistIncomingInvoices', 'PurchaseHistIncomingInvoiceAPIController');
});



























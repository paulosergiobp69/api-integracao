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


//Route::group(['middleware' => ['apiJwt']], function () {
//   Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {
//    Route::group(['middleware' => ['api']], function () {

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {

    //Rota de Documentos de Clientes
    Route::get('clientes/{id}/documento', 'Api\ClienteApiController@documento');
    Route::get('clientes/{id}/telefone', 'Api\ClienteApiController@telefone');
    Route::resource('clientes', 'ClienteApiController');

    //Rota de Documentos de Clientes
    Route::get('documento/{id}/cliente', 'Api\DocumentoApiController@cliente');
    Route::resource('documento', 'Api\DocumentoApiController');


    //Rota de Telefone de Clientes
    Route::get('telefone/{id}/cliente', 'Api\TelefoneApiController@cliente');
    Route::resource('telefone', 'Api\TelefoneApiController');
});

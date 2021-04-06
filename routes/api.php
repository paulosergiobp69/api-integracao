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

//Route::get('filmes', 'Api\FilmeAPIController@index');

Route::post('login', 'Auth\AuthenticateController@authenticate');
Route::post('login-refresh', 'Auth\AuthenticateController@refreshToken');
Route::get('me', 'Auth\AuthenticateController@getAuthenticatedUser');

//Route::resource('telefones', 'Api\TelefoneApiController');

Route::delete('H100/{id}','Api\H100APIController@destroy');
Route::resource('H100', 'Api\H100APIController');  



//Route::group(['middleware' => ['apiJwt']], function () {
//   Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {
//    Route::group(['middleware' => ['api']], function () {
/*
Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {

    //Rota de Documentos de Clientes
    Route::get('clientes/{id}/documento', 'ClienteApiController@documento');
    Route::get('clientes/{id}/telefone', 'ClienteApiController@telefone');
    Route::resource('clientes', 'ClienteApiController');

    //Rota de Documentos de Clientes
    Route::get('documento/{id}/cliente', 'DocumentoApiController@cliente');
    Route::resource('documento', 'DocumentoApiController');


    //Rota de Telefone de Clientes
    Route::get('telefone/{id}/cliente', 'TelefoneApiController@cliente');
    Route::resource('telefone', 'TelefoneApiController');

    Route::resource('filmes', 'FilmeAPIController');

    Route::resource('arnos', 'ArnoAPIController');    

    Route::resource('cors', 'CorAPIController');

    Route::get('H100/{id}/H101', 'H100APIController@H101');
    Route::get('H100/{D009_Id},{Status}/getSaldo', 'H100APIController@getSaldo');
    Route::resource('H100', 'H100APIController');  

    Route::get('H101/{id}/H100', 'H101APIController@H100');
    Route::resource('H101', 'H101APIController');

    Route::resource('telefones', 'TelefoneAPIController');

});

*/












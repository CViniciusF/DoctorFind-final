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
Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('auth/{provider}', 'AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');

Route::get('imoveis/novo', 'ImovelController@cadastrarImovel');
Route::get('imoveis/ver-imovel/{id}', 'ImovelController@listarImovel');

Route::post('imoveis/enviar', 'ImovelController@store');
Route::post('imoveis/atualizar', 'ImovelController@update');

//Route::get('/teste', 'AuthController@teste');

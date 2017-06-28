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
Route::get('/', 'AuthController@landing');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/home/verNotificacoes', 'HomeController@verNotificacoes');
Route::get('/home/novosDepoimentos', 'BuscaController@novosDepoimentos');
Route::get('/home/novasPerguntas', 'BuscaController@novasPerguntas');
Route::get('/home/perguntas', 'HomeController@verPerguntasPaciente');
Route::post('/home/responder', 'BuscaController@responderPergunta');

Route::get('auth/{provider}', 'AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');

Route::get('/cadastro/especialista', 'AuthController@redEspecialista');
Route::get('/cadastro/paciente', 'AuthController@redPaciente');
Route::post('/buscar-especialista', 'BuscaController@buscarEspecialista');
Route::get('/especialistas/ver-perfil/{id}', 'BuscaController@verPerfil');
Route::get('/especialistas/indicar/{id}', 'BuscaController@indicarEspecialista');
Route::get('/especialistas/verTelefone/{id}', 'BuscaController@verTelefone');
Route::get('/especialistas/escreverDepoimento/{id}', 'BuscaController@escreverDepoimento');
Route::post('/especialistas/enviarDepoimento', 'BuscaController@enviarDepoimento');
Route::get('/especialistas/escreverPergunta/{id}', 'BuscaController@escreverPergunta');
Route::post('/especialistas/enviarPergunta', 'BuscaController@enviarPergunta');

Route::get('/depoimentos/autorizarDepoimento/{id}', 'BuscaController@autorizarDepoimento');
Route::get('/depoimentos/excluirDepoimento/{id}', 'BuscaController@excluirDepoimento');

Route::get('/meu-perfil', 'AuthController@editarPerfil');
Route::post('/meu-perfil/alterarAvatar', 'AuthController@alterarAvatar');
Route::post('/meu-perfil/alterarSenha', 'AuthController@alterarSenha');
Route::post('/meu-perfil/alterarEmail', 'AuthController@alterarEmail');
Route::post('/meu-perfil/alterarInfosEspecialista', 'AuthController@alterarInfosEspecialista');



//Route::get('/teste', 'AuthController@teste');

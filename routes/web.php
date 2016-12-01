<?php


////////////////////////////////////////////////////////////////
//
//                          Login
///////////////////////////////////////////////////////////////

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::get('/', 'HomeController@index');


////////////////////////////////////////////////////////////////
//
//  Adiciona campos ao form Departamento Pessoal
///////////////////////////////////////////////////////////////

Route::post('/addCidade', 'DepartamentoPessoal@storeCidade');
Route::post('/addCnhCategoria', 'DepartamentoPessoal@storeCategoria');
Route::post('/addCargo', 'DepartamentoPessoal@storeCargo');
Route::resource('dp', 'DepartamentoPessoal');


////////////////////////////////////////////////////////////////
//
//  Adiciona campos ao form CoordenadorTransporte
///////////////////////////////////////////////////////////////

Route::get('coordenador_transporte', 'CoordenadorTransporte@index');


Route::resource('nota', 'CadastrarNota');

Route::resource('rota', 'CadastrarRota');


Route::post('/addVeiculo', 'CadastrarRota@storeVeiculo');

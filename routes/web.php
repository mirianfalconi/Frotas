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

Route::get('rota', 'CadastrarRota@index');
Route::get('rota', 'CadastrarRota@showMotorista');

Route::resource('nota', 'CadastrarNota');

Route::post('rota', 'CadastrarRota@create');

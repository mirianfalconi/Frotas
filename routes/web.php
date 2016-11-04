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

Route::get('/departamentoPessoal', 'DepPessoalController@index');
Route::post('/addCidade', 'Auth\RegisterController@storeCidade');
Route::post('/addCnhCategoria', 'Auth\RegisterController@storeCategoria');
Route::post('/addCargo', 'Auth\RegisterController@storeCargo');

Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

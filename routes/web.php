<?php

use Routes\Route;

Route::get('/','App\Controllers\UserController@index');
Route::get('users','App\Controllers\UserController@index');
Route::get('user/create','App\Controllers\UserController@create');
Route::post('user/store','App\Controllers\UserController@store');
Route::get('user/{user_id}/edit','App\Controllers\UserController@edit');
Route::post('user/{user_id}/update','App\Controllers\UserController@update');

Route::post('user/{user_id}/delete','App\Controllers\UserController@delete');

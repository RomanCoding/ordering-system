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

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/admin', 'AdminController@index');
Route::get('/departments', 'DepartmentController@index');
Route::post('/departments', 'DepartmentController@store');
Route::patch('/departments/{department}', 'DepartmentController@update');
Route::delete('/departments/{department}', 'DepartmentController@destroy');
Route::get('/workers', 'WorkerController@index');
Route::post('/workers', 'WorkerController@store');
Route::patch('/workers/{user}', 'WorkerController@update');

Route::get('/orders', 'OrderController@index');
Route::post('/orders', 'OrderController@store');
Route::post('/orders/{order}', 'MessageController@store');
Route::get('/files/{order}/{file}', 'FileController@show');
Route::post('/files/{order}/', 'FileController@store');

Auth::routes();

Route::get('/profile', 'ProfileController@index');

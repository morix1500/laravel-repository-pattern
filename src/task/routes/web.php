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

Auth::routes();

Route::get('/', 'TaskController@index')->name('home');
Route::post('/tasks', 'TaskController@create')->name('tasks.create');

Route::get('/tasks/{id}/edit', 'TaskController@edit')->name('tasks.edit');
Route::post('/tasks/{id}/edit', 'TaskController@editComplete')->name('tasks.complete');
Route::get('/tasks/{id}/delete', 'TaskController@delete')->name('tasks.delete');

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
use App\Task;
use Illuminate\Http\Request;

// root
Route::get('/', 'TaskController@index');

// Authentication Routes
Auth::routes();

// Task routes
Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::put('/task/{task}', 'TaskController@update');
Route::delete('/task/{task}', 'TaskController@destroy');
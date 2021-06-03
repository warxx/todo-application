<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

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
    return view('welcome');
})->name('welcome');

//projects
Route::get('/projects', 'ProjectController@index')->name('projects.index');
Route::get('/projects/create', 'ProjectController@create')->name('projects.create')->middleware('auth');
Route::post('/projects', 'ProjectController@store')->middleware('auth');
Route::get('/projects/{id}', 'ProjectController@show');

//tasks
Route::get('/tasks', 'TaskController@index')->name('tasks.index');
Route::get('/tasks/{id}', 'TaskController@show')->name('tasks.show');
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create')->middleware('auth');
Route::post('/tasks', 'TaskController@store')->middleware('auth');
Route::post('/tasks/change-status', 'TaskController@changeTaskStatus')->name('tasks.change-status')->middleware('auth');
Route::get('/tasks/edit/{id}', 'TaskController@edit')->name('tasks.edit')->middleware('auth');
Route::put('/tasks/{id}', 'TaskController@update')->name('tasks.update')->middleware('auth');
Route::delete('/tasks/{id}', 'TaskController@destroy')->name('tasks.destroy')->middleware('auth');

Auth::routes();
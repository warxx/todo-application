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
Route::post('/projects', 'ProjectController@store');
Route::get('/projects/{id}', 'ProjectController@show');

//tasks
Route::get('/tasks', 'TaskController@index')->name('tasks.index');
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create')->middleware('auth');
Route::post('/tasks', 'TaskController@store');

Auth::routes();
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

Route::get('/', function () {
    return view('welcome');
});
//   ->Tasks
Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/create', 'TasksController@create');
Route::get('/tasks/{task}', 'TasksController@show');
Route::post('/tasks', 'TasksController@store');
Route::post('/tasks/{task}/comment', 'CommentsController@store');

//   ->Courses
Route::get('/courses', 'CoursesController@index');
Route::get('/courses/create', 'CoursesController@create');
Route::get('/courses/{course}', 'CoursesController@show');
Route::post('/courses', 'CoursesController@store');
Route::post('/courses/{course}/comment', 'CommentsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index');

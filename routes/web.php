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
Route::delete('/tasks/{task}', 'TasksController@delete');
Route::post('/tasks/{task}/comment', 'CommentsController@store');

//   ->Courses
Route::get('/courses', 'CoursesController@index');
Route::get('/courses/create', 'CoursesController@create');
Route::get('/courses/{course}', 'CoursesController@show');
Route::post('/courses', 'CoursesController@store');
Route::delete('/courses/{course}', 'CoursesController@delete');
Route::post('/courses/{course}/comment', 'CommentsController@store');

//   ->Roles
Route::get('/roles', 'RolesController@index');
Route::get('/roles/create', 'RolesController@create');
Route::get('/roles/{role}', 'RolesController@show');
Route::post('/roles', 'RolesController@store');
Route::delete('/roles/{role}', 'RolesController@delete');


Auth::routes();

Route::get('/home', 'HomeController@index');

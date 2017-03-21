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
Route::get('/courses/{course}/edit', 'CoursesController@edit');
Route::put('/courses/{course}', 'CoursesController@update');
Route::post('/courses', 'CoursesController@store');
Route::delete('/courses/{course}', 'CoursesController@destroy');
Route::post('/courses/{course}/comment', 'CommentsController@store');

//   ->Roles
Route::get('/roles', 'RolesController@index');
Route::get('/roles/create', 'RolesController@create');
Route::get('/roles/{role}', 'RolesController@show');
Route::get('/roles/{role}/edit', 'RolesController@edit');
Route::put('/roles/{role}', 'RolesController@update');
Route::post('/roles', 'RolesController@store');
Route::delete('/roles/{role}', 'RolesController@destroy');

//   ->Groups
Route::get('/groups', 'GroupsController@index');
Route::get('/groups/create', 'GroupsController@create');
Route::get('/groups/{group}', 'GroupsController@show');
Route::get('/groups/{group}/edit', 'GroupsController@edit');
Route::put('/groups/{group}', 'GroupsController@update');
Route::post('/groups', 'GroupsController@store');
Route::delete('/groups/{group}', 'GroupsController@destroy');

Route::get('/your-groups', 'GroupsController@indexIn');

//   ->Users
Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::get('/users/{user}', 'UsersController@show');
Route::get('/users/{user}/edit', 'UsersController@edit');
Route::put('/users/{user}', 'UsersController@update');
Route::post('/users', 'UsersController@store');
Route::delete('/users/{user}', 'UsersController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/info', function () {
    $enabled = true;
    return view('info', compact('enabled'));
});

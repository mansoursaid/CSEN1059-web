<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('projects','ProjectsController@index');
Route::get('projects/create','ProjectsController@create');
Route::get('projects/{id}','ProjectsController@show');
Route::post('projects/store','ProjectsController@store');
Route::delete('projects/{id}','ProjectsController@destroy');
Route::get('projects/{id}/edit','ProjectsController@edit');
Route::post('projects/{id}/edited','ProjectsController@update');

Route::get('mentions', 'TweetsController@index');


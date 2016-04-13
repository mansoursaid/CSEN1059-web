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

Route::get('tickets','TicketsController@index');
Route::get('tickets/create','TicketsController@create');
Route::get('tickets/{id}','TicketsController@show');
Route::post('tickets/store','TicketsController@store');
Route::delete('tickets/{id}','TicketsController@destroy');
Route::get('tickets/{id}/edit','TicketsController@edit');
Route::post('tickets/{id}/edited','TicketsController@update');

Route::get('projects','ProjectsController@index');
Route::get('projects/create','ProjectsController@create');
Route::get('projects/{id}','ProjectsController@show');
Route::post('projects/store','ProjectsController@store');
Route::delete('projects/{id}','ProjectsController@destroy');
Route::get('projects/{id}/edit','ProjectsController@edit');
Route::post('projects/{id}/edited','ProjectsController@update');

Route::get('mentions', 'TweetsController@index');

Route::get('users','UsersController@index');
Route::get('users/create','UsersController@create');
Route::post('users','UsersController@store');
Route::get('users/{id}','UsersController@show');
Route::delete('users/{id}','UsersController@destroy');
Route::get('users/{id}/edit','UsersController@edit');
Route::PATCH('users/{id}','UsersController@update');
Route::DELETE('users','UsersController@delete');

Route::get('admin', function () {
    return view('admin_template');
});

Route::controllers([
    'auth' => '\App\Http\Controllers\Auth\AuthController',
    'password' => '\App\Http\Controllers\Auth\PasswordController',
]);

Route::get('/paypal', 'GenLinkPaypalController@handleTransaction');
Route::get('/genlink', 'GenLinkPaypalController@generateLink');
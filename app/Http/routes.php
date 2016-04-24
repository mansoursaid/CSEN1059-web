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

//Route::get('mentions', 'TweetsController@index');

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



//Route::get('/conv/{id}', 'TweetsController@getConversation');
//Route::get('/reply/{id}/{status}', 'TweetsController@replyToTweet');

Route::get('home', 'HomeController@getHome');



Route::get('/mail', function() {
    $user = new \App\User();
    $user->email = "asktajweed@gmail.com";
    $ticket = new \App\Ticket();
    $ticket->id = 5;
    \App\MailNotification::mailClaim([$user], $ticket);
    echo 'hello';
});


Route::get('app_settings', 'AppSettingsController@showSettings');

Route::post('change_twitter_consumer_key', 'AppSettingsController@changeTwitterConsumerKey');
Route::post('change_twitter_consumer_key_secret', 'AppSettingsController@changeTwitterConsumerKeySecret');
Route::post('change_twitter_access_token', 'AppSettingsController@changeTwitterAccessToken');
Route::post('change_twitter_access_token_secret', 'AppSettingsController@changeTwitterAccessTokenSecret');

Route::post('change_paypal_client_id', 'AppSettingsController@changePaypalClientID');
Route::post('change_paypal_secret_key', 'AppSettingsController@changePaypalSecretKey');




Route::get('fire', function () {
    // this fires the event
    event(new App\Events\NotificationsEvent());
    return "event fired";
});


Route::resource('notifications', 'NotificationsController',
    ['only' => ['index']]);




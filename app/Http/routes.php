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

/**
*
*   Route::resource('users', 'UsersController');
*
*   Gives you these named routes:
*
*       Verb    Path                        Action  Route Name
*       GET     /users                      index   users.index
*       GET     /users/create               create  users.create
*       POST    /users                      store   users.store
*       GET     /users/{user}               show    users.show
*       GET     /users/{user}/edit          edit    users.edit
*       PUT     /users/{user}               update  users.update
*       DELETE  /users/{user}               destroy users.destroy
*
*   The generated routes can be checked using 'php artisan route:list' command
*/

Route::get('/', function(){
    return view('auth/login');
});


Route::resource('tickets', 'TicketsController');
Route::resource('projects', 'ProjectsController');
Route::resource('users', 'UsersController');
Route::get('/supervisors', 'UsersController@usersAddAndIndex');
Route::get('/agents', 'UsersController@usersAddAndIndex');
Route::get('/admins', 'UsersController@usersAddAndIndex');
Route::get('/projects', 'ProjectsController@projectsAddAndIndex');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('mentions', 'TweetsController@index');
Route::post('reply', 'TweetsController@replyToTicket');

Route::get('/paypal', 'GenLinkPaypalController@handleTransaction');
Route::get('/paypal/create', 'GenLinkPaypalController@create');
Route::post('/paypal/store', 'GenLinkPaypalController@store');


//Route::get('/conv/{id}', 'TweetsController@getConversation');
//Route::get('/reply/{id}/{status}', 'TweetsController@replyToTweet');

Route::get('home', 'HomeController@getHome');
Route::get('get_tweets/{maxId}', 'TweetsController@getTweets');

Route::get('/mail', function() {
    $user = new \App\User();
    $user->email = "asktajweed@gmail.com";
    $ticket = App\Ticket::first();
    \App\MailNotification::mailClaim([$user], $ticket);
    echo 'hello';
});


Route::get('app_settings', 'AppSettingsController@showSettings');

Route::post('change_twitter_consumer_key', 'AppSettingsController@changeTwitterConsumerKey');
Route::post('change_twitter_consumer_key_secret', 'AppSettingsController@changeTwitterConsumerKeySecret');
Route::post('change_twitter_access_token', 'AppSettingsController@changeTwitterAccessToken');
Route::post('change_twitter_access_token_secret', 'AppSettingsController@changeTwitterAccessTokenSecret');
Route::post('changeApplicationColor', 'AppSettingsController@changeApplicationColor');


Route::post('change_paypal_client_id', 'AppSettingsController@changePaypalClientID');
Route::post('change_paypal_secret_key', 'AppSettingsController@changePaypalSecretKey');


Route::get('fire', function () {
    // this fires the event
    event(new App\Events\NotificationsEvent("koko"));
    return "event fired";
});


Route::resource('notifications', 'NotificationsController',
    ['only' => ['index']]);
Route::resource('customers', 'CustomerController');
Route::patch('/tickets/{id}/assign','TicketsController@assign_to');
Route::get('/tickets/{id}/claim','TicketsController@claim');

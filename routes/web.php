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

Auth::routes();

Route::get('/', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('register');
});

// Users Routes

Route::get('login', array('uses' => 'UserController@login'));
Route::post('signup', ['as'=>'signup.store','uses'=>'UserController@registerUser']);
Route::post('signin', ['as'=>'login.store','uses'=>'UserController@doLogin']);
Route::get('logout', array('uses' => 'UserController@doLogout'));
Route::get('dashboard', ['middleware' => 'auth', 'uses' => 'UserController@dashboard']);
Route::get('editPassword', ['middleware' => 'auth', 'uses' => 'UserController@editPassword']);
Route::post('editUserPass', ['middleware' => 'auth', 'uses' => 'UserController@editUserPass']);
Route::get('profile', ['middleware' => 'auth', 'uses' => 'UserController@userProfile']);
Route::get('editProfile', ['middleware' => 'auth', 'uses' => 'UserController@getUserProfile']);
Route::post('editUserProfile/{id}', ['middleware' => 'auth', 'uses' => 'UserController@editUserProfile']);
Route::get('profileImage', ['middleware' => 'auth', 'uses' => 'UserController@profileImage']);
Route::post('editProfileImage/{id}', ['middleware' => 'auth', 'uses' => 'UserController@editProfileImage']);

//Calendar Route

Route::get('calendar', 'UserController@calendar');

// Ticket Routes

Route::get('newTicket', ['middleware' => 'auth', 'uses' => 'TicketController@newTicket']);
Route::post('saveTicket', ['as'=>'saveticket.store','uses'=>'TicketController@saveTicketData']);
Route::get('openTickets', ['middleware' => 'auth', 'uses' => 'TicketController@getOpenTickets']);
Route::get('editTicket/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@editTicket']);
Route::post('editTicketData/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@editTicketData']);
Route::get('delTicket/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@deleteTicket']);
Route::get('closedTickets', 'TicketController@getClosedTickets');

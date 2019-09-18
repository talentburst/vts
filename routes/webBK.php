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
	if (Auth::user()) {
            return redirect('dashboard');
        }
    return view('login');
});

Route::get('/signup', function () {
    return view('register');
});

Route::get('/reset', function () {
    return view('reset');
});

// Users Routes

Route::get('login', array('as' => 'login', 'uses' => 'UserController@login'));

Route::post('signup', ['as'=>'signup.store', 'uses'=>'UserController@registerUser']);
Route::post('signin', ['as'=>'login.store', 'uses'=>'UserController@doLogin']);
Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@doLogout'));

Route::get('dashboard', ['middleware' => 'auth', 'uses' => 'UserController@dashboard']);
Route::get('editPassword', ['middleware' => 'auth', 'uses' => 'UserController@editPassword']);
Route::post('editUserPass', ['middleware' => 'auth', 'uses' => 'UserController@editUserPass']);
Route::get('profile', ['middleware' => 'auth', 'uses' => 'UserController@userProfile']);
Route::get('editProfile', ['middleware' => 'auth', 'uses' => 'UserController@getUserProfile']);
Route::post('editUserProfile/{id}', ['middleware' => 'auth', 'uses' => 'UserController@editUserProfile']);
Route::get('profileImage', ['middleware' => 'auth', 'uses' => 'UserController@profileImage']);
Route::post('editProfileImage/{id}', ['middleware' => 'auth', 'uses' => 'UserController@editProfileImage']);
Route::post('viewUserProfile/{id}', ['middleware' => 'auth', 'uses' => 'UserController@viewUserProfile']);

Route::get('userDetails', ['middleware' => 'auth', 'uses' => 'UserController@userDetails']);
Route::get('delUser/{id}', ['middleware' => 'auth', 'uses' => 'UserController@deleteUser']);
Route::get('editUser/{id}', ['middleware' => 'auth', 'uses' => 'UserController@editUserStatus']);

Route::get('viewUserProfile/{id}', ['middleware' => 'auth', 'uses' => 'UserController@viewUserProfile']);

//Calendar Route

Route::get('calendar', 'UserController@calendar');

// Ticket Routes

Route::get('newTicket', ['middleware' => 'auth', 'uses' => 'TicketController@newTicket']);
Route::post('saveTicket', ['as'=>'saveticket.store','uses'=>'TicketController@saveTicketData']);
Route::get('openTickets', ['middleware' => 'auth', 'uses' => 'TicketController@getOpenTickets']);
Route::get('editTicket/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@editTicket']);
Route::post('editTicketData/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@editTicketData']);
Route::get('delTicket/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@deleteTicket']);
Route::get('closedTickets', ['middleware' => 'auth', 'uses' => 'TicketController@getClosedTickets']);

Route::get('pendingApplications', ['middleware' => 'auth', 'uses' => 'TicketController@pendingApplications']);
Route::get('replyApplication/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@replyApplication']);
Route::post('replyApplicationData/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@replyApplicationData']);
Route::get('closedApplications', ['middleware' => 'auth', 'uses' => 'TicketController@closedApplications']);
Route::get('viewApplication/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@viewApplication']);

//Leave Route

Route::get('leaveDetails', ['middleware' => 'auth', 'uses' => 'LeaveController@leaveDetails']);
Route::get('editLeave/{id}', ['middleware' => 'auth', 'uses' => 'LeaveController@editLeave']);
Route::post('editUserLeave/{id}', ['middleware' => 'auth', 'uses' => 'LeaveController@editLeaveData']);

//Reports Route

Route::get('leaveReports', ['middleware' => 'auth', 'uses' => 'ReportsController@leaveReports']);
Route::post('exports/{id}', ['middleware' => 'auth', 'uses' => 'ReportsController@exports']);


//Reset PasswordEmail

 Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('reset', ['as'=>'reset.store', 'uses'=>'UserController@doReset']);
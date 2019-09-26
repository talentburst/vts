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
Route::get('editProfile', ['middleware' => 'auth', 'uses' => 'UserController@getEditProfile']);
Route::post('editUserProfile/{id}', ['middleware' => 'auth', 'uses' => 'UserController@editUserProfile']);
Route::get('profileImage', ['middleware' => 'auth', 'uses' => 'UserController@profileImage']);
Route::post('editProfileImage/{id}', ['middleware' => 'auth', 'uses' => 'UserController@editProfileImage']);

Route::get('editAddress', ['middleware' => 'auth', 'uses' => 'UserController@getUserAddress']);
Route::post('editUserAddress/{id}', ['middleware' => 'auth', 'uses' => 'UserController@editUserAddress']);

// Password Reset Routes...

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Ticket Routes

Route::get('newTicket', ['middleware' => 'auth', 'uses' => 'TicketController@newTicket']);
Route::post('saveTicket', ['as'=>'saveticket.store','uses'=>'TicketController@saveTicketData']);
Route::get('openTickets', ['middleware' => 'auth', 'uses' => 'TicketController@getOpenTickets']);
Route::get('editTicket/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@editTicket']);
Route::post('editTicketData/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@editTicketData']);
Route::get('delTicket/{id}', ['middleware' => 'auth', 'uses' => 'TicketController@deleteTicket']);
Route::get('closedTickets', ['middleware' => 'auth', 'uses' => 'TicketController@getClosedTickets']);

// HR Admin Controller

Route::get('pendingApplications', ['middleware' => 'auth', 'uses' => 'HrAdminController@pendingApplications']);
Route::get('replyApplication/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@replyApplication']);
Route::post('replyApplicationData/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@replyApplicationData']);
Route::get('closedApplications', ['middleware' => 'auth', 'uses' => 'HrAdminController@closedApplications']);
Route::get('viewApplication/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@viewApplication']);

Route::get('hrViewUserProfile/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@hrViewUserProfile']);

Route::get('hrEditUserProfile/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@hrEditUserProfile']);

Route::get('hrUserProfileIdImage/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@hrUserProfileIdImage']);

Route::get('hrEditUserAddress/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@hrEditUserAddress']);

Route::get('userDetails', ['middleware' => 'auth', 'uses' => 'HrAdminController@userDetails']);
Route::get('delUser/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@deleteUser']);
Route::get('editUser/{id}', ['middleware' => 'auth', 'uses' => 'HrAdminController@editUserStatus']);

//Leave Routes

Route::get('leaveDetails', ['middleware' => 'auth', 'uses' => 'LeaveController@leaveDetails']);
Route::get('editLeave/{id}', ['middleware' => 'auth', 'uses' => 'LeaveController@editLeave']);
Route::post('editUserLeave/{id}', ['middleware' => 'auth', 'uses' => 'LeaveController@editLeaveData']);

//Reports Routes

Route::get('leaveReports', ['middleware' => 'auth', 'uses' => 'LeaveController@leaveReports']);
Route::post('exports/{id}', ['middleware' => 'auth', 'uses' => 'LeaveController@exports']);


//Calendar Route

Route::get('calendar', 'UserController@calendar');

//Cron Routes
Route::get('cron', 'CronController@updateLeaves');
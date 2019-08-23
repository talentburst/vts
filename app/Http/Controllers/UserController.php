<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Mail;

class UserController extends Controller
{
	public function login()
	{
	   return view('/');
	}		

	public function dashboard()
	{ 
		$tickets = User::select('td.id','td.ticket_id','td.subject','td.status','td.created_at','users.name','users.email')
	    ->join('ticket_details as td','users.id','=','td.user_id')
	    ->where('td.status', '<>', 3)
	    ->where('td.user_id', '=', Auth::user()->id)
	    ->orderBy('td.created_at', 'desc')
	    ->limit(5)
	    ->get();

	    $leaves = User::select('ld.id','ld.paid_leave','ld.sick_leave','ld.casual_leave','ld.created_at','users.name','users.email')
	    ->join('leave_details as ld','users.id','=','ld.user_id')
	    ->where('ld.user_id', '=', Auth::user()->id)
	    ->first();
	    
	    return view('home',['tickets'=>$tickets, 'leaves'=>$leaves]);	  
	}

	public function registerUser(Request $request)
	{
	   $this->validate($request, [
	    'email' => 'required|email|unique:users',
	    'phone_number' => 'required|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
	    'name'=>'required|min:6|max:20|unique:users',
	    'password' => 'required|confirmed|min:6',
	    ]);

	    $password = Hash::make($request->input('password'));

		$userdata = array(		  
          'email' => $request->input('email'),
          'phone_number' => $request->input('phone_number'),
          'name' => $request->input('name'),
          'password' => $password
        ); 

        //print_r($userdata); exit;

	   //User::create($request->all());
	   if(User::create($userdata))
	   {

	   /*Mail::send('email',
       array(
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'user_message' => $request->get('message')
       ), function($message)
	   {
	       $message->from('Arvind.asarvindsingh1@gmail.com');
	       $message->to('Arvind.asarvindsingh1@gmail.com', 'Admin')->subject('Feedback');
	   });*/
	   
	  	// return back()->with('success', 'Thanks for contacting us!');

	   	return redirect('/')->with('success', 'Thanks for signup with us!');
		}
		else
		{
			return redirect('/signup')->with('success', 'Ops! Pleas try again later');
		}
	}

	public function doLogin(Request $request)
	{
	   $this->validate($request, [	   
	    'email' => 'required|email',
	    'user_pass'=>'required|min:6'
	    ]);
        
        $userdata = array(
          'email' => $request->input('email'),
          'password' => $request->input('user_pass')
        ); 

    //echo $password = Hash::make($request->input('user_pass')); exit;
    //print_r(Auth::attempt($userdata,true)); exit;

		if(Auth::attempt($userdata,true))
		{
			return redirect('dashboard');
		}
		else
		{
			// validation not successful, send back to login form
			return redirect('/')->with('success', 'Wrong Email Id or Password!');
		}

        /*$email = $request->input('email');
	  	$user_pass = md5($request->input('user_pass'));

	    $users = User::select('id','email','name')->where('email', '=', $email)->where('user_pass', '=', $user_pass)->first(); 

	    //print_r(Auth::user()); exit;
       // echo $user = Auth::user(); exit;

        if($users->count() > 0)
        {
        	$request->session()->put('user_id', $users->id);
        	$request->session()->put('user_email', $users->email);
        	$request->session()->put('user_name', $users->name);
        	return redirect('dashboard');
		}
		else
		{
			return redirect('/')->with('success', 'Wrong Email Id or Password!');
		}*/
	}

	public function doLogout()
	{
		$userdata = array(	      
			  'last_login' => NOW()         
			); 

        User::where('id', '=', Auth::user()->id)->update($userdata);

	    //Session::flush();
	    Auth::logout();
	    return redirect('/')->with('success', 'You are successfully logout!'); 
	}

	public function userProfile()
	{
		$users = User::select('id','emp_id','name','email','phone_number','created_at','dob','doj','role','profile_image','location','last_login')
		->where('id', '=', Auth::user()->id)
	    ->first();
		return view('profile',['users'=>$users]);		
	}

	public function getUserProfile()
	{
		$users = User::select('id','emp_id','name','email','phone_number','dob','doj','role','profile_image','location')
		->where('id', '=', Auth::user()->id)
	    ->first();
		return view('editProfile',['users'=>$users]);		
	}

	public function editUserProfile(Request $request)
	{
	    $this->validate($request, [
	    'employee_id' => 'required',
	    'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
	    'name'=>'required|min:6|max:50',
	    'role'=>'required',
	    'dob'=>'required|date|date_format:Y-m-d',
	    'doj' => 'required|date|date_format:Y-m-d',
	    'location' => 'required'
	    ]);

	     $userdata = array(	      
          'emp_id' => $request->input('employee_id'),
          'phone_number' => $request->input('phone_number'),
          'name' => $request->input('name'),
          'role' => $request->input('role'),
          'dob' => $request->input('dob'),
          'doj' => $request->input('doj'),
          'location' => $request->input('location')
        ); 

	  	User::where('id', '=', Auth::user()->id)->update($userdata);
	   	return redirect('profile')->with('success', 'Profile updated successfully.');
	}

	public function editPassword()
	{
	   return view('/editPassword');
	}

	public function editUserPass(Request $request)
	{
	    $this->validate($request, [
	    'old_password' => 'required',
	    'new_password' => 'required||min:6|max:15',
	    'verify_new_password'=>'required|min:6|max:15|same:new_password'
	    ]);        
        
         $new_password = Hash::make($request->input('new_password'));
         $existing_password = Auth::user()->password; 

	     $userdata = array(	      
          'password' => $new_password          
        ); 

		if(!Hash::check($request->input('old_password'), $existing_password))
		{
			return redirect('editPassword')->with('success','The specified password does not match the database password');
		}
		else
		{
			User::where('id', '=', Auth::user()->id)->update($userdata);
			return redirect('editPassword')->with('success', 'Your password updated successfully.');
		}
	  	
	}

	public function profileImage()
	{
	   return view('/profileImage');
	}

	public function editProfileImage(Request $request)
	{
	    $this->validate($request, [
	    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);       
        
        if ($files = $request->file('image')) {
			@unlink('resources/assets/images/avatars/'.Auth::user()->profile_image); 
			$destinationPath = 'resources/assets/images/avatars/'; // upload path
			$profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
			$files->move($destinationPath, $profileImage);
			$insert['image'] = "$profileImage";

			$userdata = array(	      
			  'profile_image' => $profileImage         
			); 

           User::where('id', '=', Auth::user()->id)->update($userdata);
           return redirect('profile')->with('success','Great! Image has been successfully uploaded.');
        }
        else
        {
        	return redirect('profileImage')->with('success','Ops! Image not uploaded..Try again later'); 	
        } 
	  	
	}

	public function deleteUser($id)
	{
	    User::where('id', '=', $id)->delete();
	    return back()->with('success', 'Record deleted successfully.');
	}

	public function calendar()
	{
	   return view('/calendar');
	}	

}

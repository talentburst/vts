<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\UsersActivityLog;
use App\UsersLoginsLog;
use App\Address;
use App\Profile;
use App\Leaves;
use App\Status;
use App\User;
use Mail;


class UserController extends Controller
{
	public function login()
	{
		if (Auth::user()) {
            return redirect('dashboard');
        }
	   return view('/login');
	}		

	public function registerUser(Request $request)
	{
	   $validation = $this->validate($request, [
	    'email' => 'required|email|unique:users',
	    'phone_number' => 'required|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
	    'name'=>'required',
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
	   if($validation)
	   {
	   	$user=User::create($userdata);
	   	$user_id=$user->id;

	   	$leaveData = array(		  
          'user_id' => $user_id,
          'paid_leave' => 0,
          'sick_leave' => 0, 
          'casual_leave' => 0,
          'other_leave' => 0,         
        ); 

        $profileData = array(		  
          'user_id' => $user_id, 
          'phone_number' => $request->input('phone_number'),                 
        );
        $addressData = array(		  
          'user_id' => $user_id,                  
        );

	   	$leaves=Leaves::create($leaveData);
	   	$profile=Profile::create($profileData);
	   	$address=Address::create($addressData);

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

        $userdata = array(
          'email' => $request->input('email'),
          'password' => $request->input('user_pass'),
          'status' => 1
        );

    //echo $password = Hash::make($request->input('user_pass')); exit;
    //print_r(Auth::attempt($userdata,true)); exit;

		if(Auth::attempt($userdata,true))
		{
			$userAgent  = \Request::header('user-agent');		
			$clientIP   = \Request::ip();
			$sessionkey = $request->session()->get('_token', 'default');		
			//print_r($userAgent); exit;
			$agent     = new Agent();
			$browser   = $agent->browser(); 
			$languages = $agent->languages();			
			$device    = $agent->device(); 
			$platform  = $agent->platform();
			$bVersion  = $agent->version($browser);
			$pVersion  = $agent->version($platform);
			$isRobot   = $agent->isRobot();
			$isDesktop = $agent->isDesktop();
			$isPhone   = $agent->isPhone();

			$userLogData = array(
			  'user_id' => Auth::user()->id,
			  'sessionid' => $sessionkey,
			  'loginDateTime' => NOW(),
			  'ip' => $clientIP,
			  'browser' => $browser,
			  'browser_version' => $bVersion,
			  'platform' => $platform,
			  'platform_version' => $pVersion,
			  'device' => $device,
			  'isDesktop' => $isDesktop,
			  'isPhone' => $isPhone,
			  'isRobot' => $isRobot,
			  'full_user_agent_string' => $userAgent,
			);

			usersLoginsLog::create($userLogData);

			return redirect('dashboard');
		}
		else
		{
			// validation not successful, send back to login form
			return redirect('/')->with('success', 'Wrong login credentials or user deactivated!');
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

	public function doReset(Request $request)
	{	
		$this->validate($request, [	   
		    'email' => 'required|email'		   
		    ]);	

		$sessionkey = Session::get('_token', 'default');
		//$password = rand(100000,999999);
		$password = 123456;
		$password = Hash::make($password);

		$user = User::where('email', '=', $request->input('email'))->first();
		

		if ($user === null) {
		   // user doesn't exist
			 return redirect('/reset')->with('success', 'User does not exist.');
		}
		else 
		{
			$toName = $user->name; 
			$toEmail = $user->email; 
			$userdata = array(	      
			  'password' => $password         
			);

	        User::where('id', '=', $request->input('email'))->update($userdata);

	        Mail::send('email',['name','Ripon Uddin Arman'],
	          
	       function($message)
		   {
		       $message->from('asarvindsingh1@gmail.com', 'System Admin');
		       $message->to('$toEmail')->subject('Reset Password');
		   });

		    return redirect('/login')->with('success', 'Reset password send on your register email.');

		}
		 
	}

	public function doLogout()
	{
		$userdata = array(	      
		  'last_login' => NOW()         
		); 

		$userLoginData = array(	      
		  'logoutDateTime' => NOW()         
		);

		$sessionkey = Session::get('_token', 'default');

        User::where('id', '=', Auth::user()->id)->update($userdata);
        UsersLoginsLog::where('user_id', '=', Auth::user()->id)->where('sessionid', '=', $sessionkey)->Orderby('id', 'desc')->limit(1)->update($userLoginData);

	    Session::flush();
	    Auth::logout();
	    return redirect('/')->with('success', 'You are successfully logout!'); 
	}

	public function dashboard()
	{ 
		$tickets = User::select('td.id','td.ticket_id','td.subject','td.leave_no','td.status','td.created_at','users.name','users.email','status.status_name')
	    ->join('ticket_details as td','users.id','=','td.user_id')
	    ->join('status','status.id','=','td.status')
	    ->where('td.status', '<>', 7)
	    ->where('td.user_id', '=', Auth::user()->id)
	    ->orderBy('td.created_at', 'desc')
	    ->limit(5)
	    ->get();

	    $applications = User::select('td.id')
	    ->join('ticket_details as td','users.id','=','td.user_id')
	    ->join('status','status.id','=','td.status')
	    ->where('td.status', '<>', 7)
	    ->where('td.user_id', '=', Auth::user()->id)
	    ->count();

	    $leaves = User::select('ld.id','ld.paid_leave','ld.sick_leave','ld.casual_leave','ld.created_at','users.name','users.email')
	    ->join('leave_details as ld','users.id','=','ld.user_id')
	    ->where('ld.user_id', '=', Auth::user()->id)
	    ->first();
	    
	    return view('home',['tickets'=>$tickets, 'leaves'=>$leaves, 'applications'=>$applications]);	  
	}

	public function userProfile()
	{
		$users = User::select('users.id','emp_id','name','email','users.phone_number','dob','doj','title','department','total_exp','relevant_exp','location','users.profile_image','status','last_login')
		->join('users_profile','users.id','=','users_profile.user_id')
		->where('user_id', '=', Auth::user()->id)
	    ->first();
		return view('profile',['users'=>$users]);		
	}

	public function getEditProfile()
	{
		$users = Profile::select('user_id','emp_id','emp_ctc','phone_number','dob','doj','title','department','total_exp','relevant_exp','location')
		->where('id', '=', Auth::user()->id)
	    ->first();
		return view('editProfile',['users'=>$users]);		
	}

	public function editUserProfile(Request $request, $id)
	{
	    $this->validate($request, [
	    'employee_id' => 'required',
	    'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',	    
	    'title'=>'required',
	    'department'=>'required',
	    'dob'=>'required|date|date_format:Y-m-d',
	    'doj' => 'required|date|date_format:Y-m-d',
	    'total_exp'=>'required',
	    'relevant_exp'=>'required',
	    'location' => 'required'
	    ]);

	    $userData = array(	      
          'emp_id' => $request->input('employee_id'),
          'phone_number' => $request->input('phone_number'),         
          'title' => $request->input('title'),
          'department' => $request->input('department'),
          'dob' => $request->input('dob'),
          'doj' => $request->input('doj'),
          'total_exp' => $request->input('total_exp'),
          'relevant_exp' => $request->input('relevant_exp'),
          'location' => $request->input('location'),
          'emp_ctc' => $request->input('emp_ctc')
        ); 

	    $activityJson = json_encode($userData);
	    $user_id = $id;

        $logData = array(		  
          'user_id' => Auth::user()->id,
          'log' => "User @$user_id profile updated",
          'activity' => $activityJson
        );
		
		$user = User::where('id', '=', $user_id)->update(['is_profile' => 1]);
	  	$userProfile = Profile::where('user_id', '=', $user_id)->update($userData);
	  	if($userProfile)
	  	{
	  		UsersActivityLog::create($logData);
	  		return back()->with('success', 'Profile updated successfully.');	
	  	}
	  	else
	  	{
	  		return back()->with('success', 'Ops!! Please try again later.');	
	  	}
	   	
	}

	public function editPassword()
	{
	   return view('/editPassword');
	}

	public function editUserPass(Request $request)
	{
	    $this->validate($request, [
	    'old_password' => 'required',
	    'new_password' => 'required||min:6|max:15|different:old_password',
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
			$user_id = Auth::user()->id;
			$activityJson = json_encode($userdata);
	        $logData = array(		  
	          'user_id' => Auth::user()->id,
	          'log' => "User @$user_id password updated",
	          'activity' => $activityJson
	        );

			UsersActivityLog::create($logData);
			User::where('id', '=', Auth::user()->id)->update($userdata);
			return redirect('editPassword')->with('success', 'Your password updated successfully.');
		}
	  	
	}

	public function profileImage()
	{
		$user = Profile::select('user_id','aadhar_no','pan_no','aadhar_image','pan_image','profile_image','location')
		->where('id', '=', Auth::user()->id)
	    ->first();	  
	   return view('profileImage',['user'=>$user]);	
	}

	public function editProfileImage(Request $request)
	{
	    $this->validate($request, [
	    'aadhar_no' => 'required|unique:users_profile',
	    'pan_no' => 'required|unique:users_profile|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
	    'aadhar_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    'pan_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]); 

	    $user = Profile::select('aadhar_no','pan_no','aadhar_image','pan_image','profile_image')
		->where('id', '=', Auth::user()->id)
	    ->first();

	    if ($files = $request->file('aadhar_image')) {
			@unlink('resources/assets/images/aadharcard/'.$user->aadhar_image); 
			$aadharPath = 'resources/assets/images/aadharcard/'; // upload path
			$aadharImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
			$files->move($aadharPath, $aadharImage);
			$insert['aadhar_image'] = "$aadharImage";			
        }

        if ($files = $request->file('pan_image')) {
			@unlink('resources/assets/images/pancard/'.$user->pan_image); 
			$panPath = 'resources/assets/images/pancard/'; // upload path
			$panImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
			$files->move($panPath, $panImage);
			$insert['pan_image'] = "$panImage";			
        }

        if ($files = $request->file('image')) {
			@unlink('resources/assets/images/avatars/'.$user->profile_image); 
			$imagePath = 'resources/assets/images/avatars/'; // upload path
			$profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
			$files->move($imagePath, $profileImage);
			$insert['image'] = "$profileImage";			
        }

	    $profileData = array(
	    	'aadhar_no' => $request->input('aadhar_no'),
	    	'pan_no' => $request->input('pan_no'),
	    	'aadhar_image' => $profileImage,
	    	'pan_image' => $profileImage,						      
			'profile_image' => $profileImage         
			);


	    $userData = array(
	    	'is_id_proof' => 1,	    						      
			'profile_image' => $profileImage         
		);

           $profile = Profile::where('id', '=', Auth::user()->id)->update($profileData); 
           $user = User::where('id', '=', Auth::user()->id)->update($userData);              
        
        if ($profile ) {
        		$user_id = Auth::user()->id;
        	    $activityJson = json_encode($userData);
		        $logData = array(		  
		          'user_id' => Auth::user()->id,
		          'log' => "User @$user_id profile image/id proof updated",
		          'activity' => $activityJson
		        );

			UsersActivityLog::create($logData);			
			return back()->with('success','Great! Id has been successfully updated.');		
        }
        else
        {
        	return back()->with('success','Ops! Id not updated..Try again later'); 	
        } 
	  	
	}

	public function getUserAddress()
	{
		$users = Address::select('user_id','address','city','state','country','pincode','landmark','cur_address','cur_city','cur_state','cur_country','cur_pincode','cur_landmark','is_same_address')
		->where('id', '=', Auth::user()->id)
	    ->first();
		return view('editAddress',['users'=>$users]);		
	}

	public function editUserAddress(Request $request)
	{
	    $this->validate($request, [
	    'address' => 'required',
	    'city' => 'required',
	    'state'=>'required',
	    'country'=>'required',
	    'pincode'=>'required|min:6|max:6'
	    ]);

	    $userData = array(	      
          'address' => $request->input('address'),
          'city' => $request->input('city'),
          'state' => $request->input('state'),
          'country' => $request->input('country'),
          'pincode' => $request->input('pincode'),
          'landmark' => $request->input('landmark')
        ); 

	    $is_same_address = $request->input('is_same_address');

	    if($is_same_address==1)
	    {
		    $userData2 = array(	      
	          'cur_address' => $request->input('address'),
	          'cur_city' => $request->input('city'),
	          'cur_state' => $request->input('state'),
	          'cur_country' => $request->input('country'),
	          'cur_pincode' => $request->input('pincode'),
	          'cur_landmark' => $request->input('landmark')
	        ); 

	        $userData=array_merge($userData,$userData2);
	    }
	    else
	    {
	    	$this->validate($request, [
		    'current_address' => 'required',
		    'current_city' => 'required',
		    'current_state'=>'required',
		    'current_country'=>'required',
		    'current_pincode'=>'required|min:6|max:6'
		    ]);

		    $userData2 = array(	      
	          'cur_address' => $request->input('current_address'),
	          'cur_city' => $request->input('current_city'),
	          'cur_state' => $request->input('current_state'),
	          'cur_country' => $request->input('current_country'),
	          'cur_pincode' => $request->input('current_pincode'),
	          'cur_landmark' => $request->input('current_landmark')
	        );

            $userData=array_merge($userData,$userData2);
	    }	
	   // print_r($userData); exit;     

	    $activityJson = json_encode($userData);
	    $user_id = Auth::user()->id;

        $logData = array(		  
          'user_id' => Auth::user()->id,
          'log' => "User @$user_id profile updated",
          'activity' => $activityJson
        );        
          
        $user = User::where('id', '=', Auth::user()->id)->update(['is_address' => 1]);
        $userAddress = Address::where('id', '=', Auth::user()->id)->update($userData);        
        if($user && $userAddress)
        {
        	UsersActivityLog::create($logData);
        	return back()->with('success', 'Address updated successfully.');
        }
        else
        {
        	return back()->with('success', 'Ops!! Please try again later.');
        }
	   	
	}

	public function calendar()
	{
	   return view('/calendar');
	}	

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mailers\AppMailer;
use App\UsersActivityLog;
use App\CrDrLeaves;
use App\Address;
use App\Profile;
use App\Tickets;
use App\Status;
use App\User;
use App\Leaves;

use App\Exports;
use Maatwebsite\Excel\Facades\Excel;


class HrAdminController extends Controller
{
	public function pendingApplications()
	{
	    $tickets = Tickets::select('ticket_details.id','ticket_details.ticket_id','ticket_details.subject','ticket_details.leave_no','ticket_details.message','ticket_details.status','ticket_details.created_at','users.name','users.email','status.status_name')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->join('status','status.id','=','ticket_details.status')
	    ->whereIn('ticket_details.status', [1, 5])
	    ->orderBy('ticket_details.id','DESC')
	    ->get();
	    return view('pendingApplications',['tickets'=>$tickets]);
	}

	public function replyApplication($id)
	{
	    $ticket = Tickets::select('id','user_id','ticket_id','subject','leave_no','from_date','message','responce','remark')
	    ->where('ticket_id', '=', $id)
	    ->whereIn('status', [1, 5])
	    ->first(); 

	    $status = Status::select('id','status_name')->where('is_visible', '=', 1)->get();

	    return view('replyApplication',['ticket'=>$ticket,'status'=>$status]);
	}

	public function replyApplicationData(Request $request, $id)
	{
	  $this->validate($request, [
	  	'ticket_id'=>'required', 
	  	'leave_days'=>'required',    
	    'status'=>'required',
	    'responce' => 'required|min:10'	    
	    ]);

	  	$status = $request->input('status');
	    $leave_days = $request->input('leave_days');
		if($status==2)
		{
			Leaves::where('user_id', '=', $request->input('user_id'))->decrement('paid_leave', $leave_days);
			$leave_type = 'Debit PL';
		}
		elseif($status==3)
		{			
			Leaves::where('user_id', '=', $request->input('user_id'))->decrement('sick_leave', $leave_days);
			$leave_type = 'Debit SL';
		}
		else
		{
			$action=NULL;
			$leave_type = 'LWP';
		}

	  	$ticketData = array(          
          'status' => $request->input('status'),
          'responce' => $request->input('responce'),
          'responce_by' => Auth::user()->id,
          'responce_at' => NOW(),
        );	   

		$ceditDebitData = array( 
			'user_id' => $request->input('user_id'), 			
			'ticket_id' => $request->input('ticket_id'),
			'updated_by' => Auth::user()->id,        
			'leave_type' => $leave_type,
			'debit_leave' => $leave_days,
			'remark' => $request->input('responce'),
		);					

	  	$ticketResp = Tickets::where('ticket_id', '=', $id)->update($ticketData);
	  	$crDrLeaves = CrDrLeaves::create($ceditDebitData);

      	if($ticketResp && $crDrLeaves)
      	{
      		$activityJson = json_encode($ceditDebitData);
	        $logData = array(		  
	          'user_id' => Auth::user()->id,
	          'log' => "$id apllication responded",
	          'activity' => $activityJson
	        );
      		UsersActivityLog::create($logData);

      		// send reply mail 

			/*if($ticketResp) {			    
			    $mailer->replyTicket(Auth::user(), $ticket);
			}*/

	   		return redirect('closedApplications')->with('success', 'Ticket details updated successfully.');
		}
		else
      	{
	   		return redirect('pendingApplications')->with('success', 'Ops!..Somthing went wrong, Please try again later.');
		}
	}

	public function closedApplications()
	{
	    $tickets = Tickets::select('ticket_details.id','ticket_details.ticket_id','ticket_details.subject','ticket_details.leave_no','ticket_details.message','ticket_details.status','ticket_details.responce','ticket_details.created_at','ticket_details.responce_at','users.name','users.email','status.status_name')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->join('status','status.id','=','ticket_details.status')
	    ->whereNotIn('ticket_details.status', [1, 5])	   
	    ->orderBy('ticket_details.responce_at','DESC')
	    ->get();
	    return view('closedApplications',['tickets'=>$tickets]);
	}

	public function viewApplication($id)
	{
	    $tickets = Tickets::select('ticket_details.id','ticket_details.ticket_id','ticket_details.subject','ticket_details.leave_no','ticket_details.from_date','ticket_details.message','ticket_details.remark','ticket_details.responce','ticket_details.created_at','ticket_details.responce_at','users.name','users.email','users.phone_number','users2.name as responce_by_name','status.status_name')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->join('status','status.id','=','ticket_details.status')
	    ->leftJoin('users as users2','users2.id','=','ticket_details.responce_by')	   
	    ->where('ticket_details.ticket_id', '=', $id)
	    ->first();
	    return view('viewApplication',['tickets'=>$tickets]);
	}

	public function userDetails()
	{
		$users = User::select('users.id','emp_id','name','email','dob','doj','title','location','last_login','status')
		->join('users_profile','users.id','=','users_profile.user_id')
		->where('status', '<>', 2)
	    ->get();
		return view('userDetails',['users'=>$users]);		
	}

	public function editUserStatus($id)
	{ 
		$user = User::select('status')->where('id', '=', $id)->first();
		if($user->status==1)
		{
        	$status=0;
        	$msg="User Deactivated successfully."; 
		}
		else
		{
        	$status=1; 
        	$msg="User Activated successfully.";   
		}

		$userData = array(          
          'status' => $status,
          'updated_at' => NOW()
        );
	    User::where('id', '=', $id)->update($userData);	
	    return back()->with('success', $msg);
	}

	public function deleteUser($id)
	{
		$userData = array(          
          'status' => 2,
          'deleted_at' => NOW()
        );

	    //User::where('id', '=', $id)->delete();
	    User::where('id', '=', $id)->update($userData);	    
	    return back()->with('success', 'User deleted successfully.');
	}

	public function hrViewUserProfile($id)
	{
		$users = User::select('users.id','emp_id','name','email','users.phone_number','dob','doj','title','department','total_exp','relevant_exp','location','users.profile_image','status','last_login')
		->join('users_profile','users.id','=','users_profile.user_id')
		->where('users.id', '=', $id)
	    ->first();
		return view('hrViewUserProfile',['users'=>$users]);		
	}

	public function hrEditUserProfile($id)
	{
		$users = User::select('user_id','emp_id','emp_ctc','name','email','users.phone_number','dob','doj','title','department','total_exp','relevant_exp','location')
		->join('users_profile','users.id','=','users_profile.user_id')
		->where('users.id', '=', $id)
	    ->first();
		return view('hrEditUserProfile',['users'=>$users]);		
	}

	public function hrUserProfileIdImage($id)
	{
		$user = Profile::select('user_id','aadhar_no','pan_no','aadhar_image','pan_image','profile_image','location')
		->where('id', '=', $id)
	    ->first();	  
	   return view('hrUserProfileIdImage',['user'=>$user]);	
	}

	public function hrEditUserAddress($id)
	{
		$users = Address::select('user_id','address','city','state','country','pincode','landmark','cur_address','cur_city','cur_state','cur_country','cur_pincode','cur_landmark','is_same_address')
		->where('id', '=', $id)
	    ->first();
		return view('hrEditUserAddress',['users'=>$users]);		
	}		

}

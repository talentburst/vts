<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\UsersActivityLog;
use App\CrDrLeaves;
use App\Tickets;
use App\Leaves;
use App\Status;
use App\User;

use App\Exports;
use Maatwebsite\Excel\Facades\Excel;

class LeaveController extends Controller
{
	public $timestamps = false;

	public function leaveDetails()
	{
	    $leaves = Leaves::select('leave_details.user_id','leave_details.paid_leave','leave_details.sick_leave','leave_details.casual_leave','users_profile.emp_id','users.name','users.email')
	    ->join('users','users.id', '=', 'leave_details.user_id')
	    ->join('users_profile','users.id', '=', 'users_profile.user_id')
	    ->where('users.status', '<>', 2)
	    ->orderBy('users.id', 'asc')
	    ->get();
	    return view('leaveDetails',['leaves'=>$leaves]);
	}

	public function editLeave($id)
	{
	     $leaves = Leaves::select('leave_details.user_id','leave_details.paid_leave','leave_details.sick_leave','leave_details.casual_leave','users_profile.emp_id','users.name','users.email')
	    ->join('users','users.id', '=', 'leave_details.user_id')
	    ->join('users_profile','users.id', '=', 'users_profile.user_id')
	    ->where('users.id', '=', $id)
	    ->first();
	    return view('editLeave',['leaves'=>$leaves]);
	}

	public function editLeaveData(Request $request, $id)
	{
		$this->validate($request, [	    
			'leave_type'=>'required',
			'leave_days' => 'required|between:0,30.99'	    
		]);

		$leave_type = $request->input('leave_type');
		$leave_days = $request->input('leave_days');

		if($leave_type=='Credit PL' || $leave_type=='Debit PL')
		{
			$leave_col ='paid_leave';
		}
		else
		{
			$leave_col='sick_leave';
		}

		$leaveData = array( 
			'updated_by' => Auth::user()->id,					 	  
		);

        if($leave_type=='Credit PL' || $leave_type=='Credit SL')
        {
        	$credit_debit_leave = array('credit_leave' => $leave_days);
        	$upd="increment($leave_col,$leave_days)";
        }
        else
        {
        	$credit_debit_leave = array('debit_leave' => $leave_days);
        	$upd="decrement($leave_col,$leave_days)";
        }        

		$ceditDebitData = array(  
			'user_id' => $id,
			'updated_by' => Auth::user()->id,        
			'leave_type' => $request->input('leave_type'),
			'remark' => $request->input('remark'),
		);
        
        $ceditDebitData=array_merge($ceditDebitData,$credit_debit_leave);

        //print_r($ceditDebitData); exit;
		
		if($leave_type=='Credit PL' || $leave_type=='Credit SL')
        {        	
        	$editEmpLeave = Leaves::where('user_id', '=', $id)->increment($leave_col,$leave_days);
        }
        else
        {        	
        	//$editLeave = Leaves::where('user_id', $id)->where($leave_col, '>=', $leave_days)->decrement($leave_col,$leave_days);
        	$editEmpLeave = Leaves::where('user_id', '=', $id)->decrement($leave_col,$leave_days);
        }

        if($editEmpLeave)
        {
        	$crDrLeaves = CrDrLeaves::create($ceditDebitData);
        }

		if ($editEmpLeave && $crDrLeaves)
		{
			$activityJson = json_encode($ceditDebitData);
	        $logData = array(		  
	          'user_id' => Auth::user()->id,
	          'log' => "User @$id leave account updated",
	          'activity' => $activityJson
	        );

			UsersActivityLog::create($logData);	

			return redirect('leaveDetails')->with('success', 'Leaves updated successfully.');
		}
		else 
		{
			return redirect('leaveDetails')->with('success', 'Ops!..Try again later.');
		}		
		
	}

	public function leaveReports()
	{
	    $status = Status::select('id','status_name')->where('is_visible', '=', 1)->get();
	    $users = User::select('id','email')->where('status', '=', 1)->get();
	    return view('leaveReports',['status'=>$status,'users'=>$users]);
	}	

	public function exports(Request $request, $id)
    {
    	$this->validate($request, [	    
			'from_date'=>'required',
			'to_date' => 'required'	    
		]);

		//print_r($request); exit;

		$from_date = $request->input('from_date');
		$to_date   = $request->input('to_date');
		$user_id   = $request->input('user_id');
		$status    = $request->input('status');

    	$tickets = Tickets::select('ticket_details.ticket_id','users.name','users.email','ticket_details.subject','ticket_details.leave_no','status.status_name','ticket_details.created_at','ticket_details.responce','ticket_details.responce_at')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->join('status','status.id','=','ticket_details.status')
	    ->whereNotIn('ticket_details.status', [1, 5])
		->when($user_id, function ($query) use ($user_id) {
		        return $query->where('ticket_details.user_id', $user_id);
		    })
		->when($status, function ($query) use ($status) {
		        return $query->where('ticket_details.status', $status);
		    })
		->when($from_date, function ($query) use ($from_date) {
		        return $query->where('ticket_details.created_at', '>=', $from_date);;
		    })
		->when($to_date, function ($query) use ($to_date) {
		        return $query->where('ticket_details.created_at', '<=', $to_date);;
		    })
	     ->get();

	    foreach ($tickets as $ticket) {
	        $ticketsArray[] = $ticket->toArray();
	    }

	    if(empty($ticketsArray))
	    {
	    	return redirect('leaveReports')->with('success', 'Data not exist! please select another date range .');
	    	exit;
		}
		else
		{
	        $activityData = array(		  
	          'from_date' => $from_date,
	          'to_date' => $to_date,
	          'user_id' => $request->input('user_id'),
	          'status' => $request->input('status')
	        );
	        $activityJson = json_encode($activityData);

	        $logData = array(		  
	          'user_id' => Auth::user()->id,
	          'log' => 'Leave applications report downloaded',
	          'activity' => $activityJson
	        );

			UsersActivityLog::create($logData);
	    	$export = new Exports($ticketsArray);
	        return Excel::download($export, 'applications.xlsx');
	    }
    }	

}

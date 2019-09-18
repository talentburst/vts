<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\UsersActivityLog;
use App\CrDrLeaves;
use App\Tickets;
use App\Status;
use App\Leaves;
use Mail;

class TicketController extends Controller
{
	public function newTicket()
	{
	   return view('/newTicket');
	}

	public function getOpenTickets()
	{
	    $tickets = Tickets::select('ticket_details.id','ticket_details.ticket_id','ticket_details.subject','ticket_details.leave_no','ticket_details.message','ticket_details.created_at','users.name','users.email','status.status_name')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->join('status','status.id','=','ticket_details.status')
	    ->where('ticket_details.user_id', '=', Auth::user()->id)
	    ->whereIn('ticket_details.status', [1, 5])
	    ->orderBy('ticket_details.id','DESC')
	    ->get();
	    return view('openTickets',['tickets'=>$tickets]);
	}

	public function getClosedTickets()
	{
	    $tickets = Tickets::select('ticket_details.id','ticket_details.ticket_id','ticket_details.subject','ticket_details.leave_no','ticket_details.message','ticket_details.responce','ticket_details.created_at','ticket_details.responce_at','users.name','users.email','status.status_name')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->join('status','status.id','=','ticket_details.status')
	    ->where('ticket_details.user_id', '=', Auth::user()->id)
	    ->whereNotIn('ticket_details.status', [1, 5, 7])
	    ->orderBy('ticket_details.id','DESC')
	    ->get();
	    return view('closedTickets',['tickets'=>$tickets]);
	}

	public function saveTicketData(Request $request)
	{
	   $this->validate($request, [	    
	    'subject'=>'required|min:10',
	    'leave_days'=>'required|numeric',
	    'from_date'=>'required',
	    'message' => 'required|min:20'	    
	    ]);
	   	
		$random_number = mt_rand(1000000, 9999999);
		$ticket_id='TB'.$random_number;
		$user_id = Auth::user()->id;

	   $ticketData = array(		  
          'user_id' => $user_id,
          'ticket_id' => $ticket_id,
          'subject' => $request->input('subject'),
          'leave_no' => $request->input('leave_days'),
          'from_date' => $request->input('from_date'),
          'message' => $request->input('message'),
          'remark' => $request->input('remark')
        );

	   $activityJson = json_encode($ticketData);

        $logData = array(		  
          'user_id' => Auth::user()->id,
          'log' => "$ticket_id New apllication created",
          'activity' => $activityJson
        );

		UsersActivityLog::create($logData);
	    Tickets::create($ticketData);

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
	   
	   return redirect('openTickets')->with('success', 'Thanks for contacting us, we will reply you soon..');
	}

	public function editTicket($id)
	{
	    $tickets = Tickets::select('id','ticket_id','subject','leave_no','from_date','message','responce','remark')->where('ticket_id', '=', $id)->get(); 
	    return view('editTicket',['tickets'=>$tickets]);
	}

	public function editTicketData(Request $request, $id)
	{
		$this->validate($request, [	    
		'subject'=>'required|min:10',
		'leave_days'=>'required|numeric',
		'from_date'=>'required',
		'message' => 'required|min:20'	    
		]);

		$ticketData = array(          
		  'subject' => $request->input('subject'),
		  'leave_no' => $request->input('leave_days'),
		  'from_date' => $request->input('from_date'),
		  'message' => $request->input('message'),
		  'remark' => $request->input('remark')
		);

		$activityJson = json_encode($ticketData);

        $logData = array(		  
          'user_id' => Auth::user()->id,
          'log' => "$id apllication updated",
          'activity' => $activityJson
        );

		UsersActivityLog::create($logData);	  
	   Tickets::where('ticket_id', '=', $id)->update($ticketData);
	   return redirect('openTickets')->with('success', 'Apllication details updated successfully.');
	}

	public function deleteTicket($id)
	{
		$ticketData = array(          
          'status' => 7,
          'deleted_at' => NOW()
        );

	    //Tickets::where('ticket_id', '=', $id)->delete();
	    Tickets::where('ticket_id', '=', $id)->update($ticketData);
	    return redirect('closedTickets')->with('success', 'Ticket deleted successfully.');
	}	

}

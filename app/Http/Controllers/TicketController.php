<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Tickets;
use Mail;

class TicketController extends Controller
{
	public function newTicket()
	{
	   return view('/newTicket');
	}

	/*public function getNewTicket()
	{
	    $users = Tickets::select('ticket_details.id','ticket_details.ticket_id','ticket_details.subject','ticket_details.message','ticket_details.created_at','users.name','users.email')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->where('ticket_details.status', '=', 0)
	    ->get();
	    return view('newTickets',['users'=>$users]);
	}*/

	public function getOpenTickets()
	{
	    $tickets = Tickets::select('ticket_details.id','ticket_details.ticket_id','ticket_details.subject','ticket_details.message','ticket_details.created_at','users.name','users.email')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->where('ticket_details.status', '=', 0)
	    ->get();
	    return view('openTickets',['tickets'=>$tickets]);
	}

	public function getClosedTickets()
	{
	    $tickets = Tickets::select('ticket_details.id','ticket_details.ticket_id','ticket_details.subject','ticket_details.message','ticket_details.responce','ticket_details.created_at','ticket_details.closed_at','users.name','users.email')
	    ->join('users','users.id','=','ticket_details.user_id')
	    ->where('ticket_details.status', '=', 1)
	    ->get();
	    return view('closedTickets',['tickets'=>$tickets]);
	}

	public function saveTicketData(Request $request)
	{
	   $this->validate($request, [	    
	    'subject'=>'required|min:10',
	    'message' => 'required|min:20'	    
	    ]);
	   	
		$random_number = mt_rand(100000, 999999);
		$ticket_id='TB'.$random_number;
		$user_id = Auth::user()->id;

	   $ticketData = array(		  
          'user_id' => $user_id,
          'ticket_id' => $ticket_id,
          'subject' => $request->input('subject'),
          'message' => $request->input('message'),
          'remark' => $request->input('remark')
        );

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
	   
	  // return back()->with('success', 'Thanks for contacting us!');
	   return redirect('openTickets')->with('success', 'Thanks for contacting us, we reply you soon..');
	}

	public function editTicket($id)
	{
	    $tickets = Tickets::select('id','subject','message','responce','remark')->where('id', '=', $id)->get(); 
	    return view('editTicket',['tickets'=>$tickets]);
	}

	public function editTicketData(Request $request, $id)
	{
	  $this->validate($request, [	    
	    'subject'=>'required|min:10',
	    'message' => 'required|min:20'	    
	    ]);

	  $ticketData = array(          
          'subject' => $request->input('subject'),
          'message' => $request->input('message'),
          'remark' => $request->input('remark')
        );
	   //echo $request;
       //echo $id;exit;
	  Tickets::where('id', '=', $id)->update($ticketData);
	   return redirect('openTickets')->with('success', 'Ticket details updated successfully.');
	}

	public function deleteTicket($id)
	{
		$ticketData = array(          
          'status' => 3,
          'deleted_at' => NOW()
        );

	    //Tickets::where('id', '=', $id)->delete();
	    Tickets::where('id', '=', $id)->update($ticketData);
	    return back()->with('success', 'Ticket deleted successfully.');
	}	

}

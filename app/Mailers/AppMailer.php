<?php
 
namespace App\Mailers;
 
use App\Tickets;
use Illuminate\Contracts\Mail\Mailer;
 
class AppMailer
{
    protected $mailer;
    protected $fromAddress = 'no-reply@talentburst.com';
    protected $fromName = 'HR Admin';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];
 
    /**
     * AppMailer constructor.
     * @param $mailer
     */

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
 
    public function sendTicketInformation($user, Tickets $ticket)
    {
        $this->to = $user->email;
 
        $this->subject = "[Application ID: $ticket->ticket_id] $ticket->subject";
 
        $this->view = 'emails.ticket_info';
 
        $this->data = compact('user', 'tickets');
 
        return $this->deliver();
    }

    public function sendTicketInformationHr($user, $ticketOwner, Tickets $ticket)
    {
        $this->to = $ticketOwner;
 
        $this->subject = "[Application ID: $ticket->ticket_id] $ticket->subject";
 
        $this->view = 'emails.ticket_info_hr';
 
        $this->data = compact('user', 'tickets');
 
        return $this->deliver();
    }
 
    public function replyTicket($user, Tickets $ticket)
    {
        $this->to = $user->email;;
 
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
 
        $this->view = 'emails.ticket_reply';
 
        $this->data = compact('user', 'tickets');
 
        return $this->deliver();
    }
 
    public function sendTicketStatusNotification($ticketOwner, Tickets $ticket)
    {
        
    }
 
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message){
 
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);
 
        });
    }
}
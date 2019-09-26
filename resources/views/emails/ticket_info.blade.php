<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Leave Application Information</title>
</head>
<body>
<p>
Thank you {{ ucfirst($user->name) }} for contacting our HR Admin. A leave application ID {{$ticket->ticket_id}} has been opened for you. You will be notified when a response is made by email. The details of your application are shown below:
</p>
 
<p>Title: {{ $ticket->subject }}</p>
<p>No. of leave's: {{ $ticket->leave_no }}</p>
<p>Leave from: {{ $ticket->from_date }}</p>
<p>Message: {{ $ticket->message }}</p>
<p>Status: Pending</p>
<p>Remark: {{ $ticket->remark }}</p>
 
<p>
You can view the ticket at any time at {{ url('viewApplication/'. $ticket->ticket_id) }}
</p>
 
</body>
</html>
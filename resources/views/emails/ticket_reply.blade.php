<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave Application</title>
</head>
<body>

<p>
    {{ {{ $ticket->status }} }}
</p>
 
---

<p>Replied by: {{ $user->name }}</p>
 
<p>Title: {{ $ticket->subject }}</p>
<p>Application ID: {{ $ticket->ticket_id }}</p>
<p>Status: {{ $ticket->status }}</p>
<p>Responce: {{ $ticket->responce }}</p>

<p>
    You can view the application at any time at {{ url('tickets/'. $ticket->ticket_id) }}
</p>
 
</body>
</html>
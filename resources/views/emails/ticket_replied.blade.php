Hello, there is a reply on this ticket.

<h3>Ticket</h3>
<table class="table table-striped table-sm">
    <tbody>

        <tr>
            <td><b>ID</b></td>
            <td>{{ $ticket->id }}</td>
        </tr>
        <tr>
            <td><b>Title</b></td>
            <td>{{ $ticket->title }}</td>
        </tr>
        <tr>
            <td><b>Status</b></td>
            <td>{{ $ticket->status }}</td>
        </tr>                   
    </tbody>
</table>

<h3>Message</h3>
<table class="table table-striped table-sm">
    <tbody>

        <tr>
            <td><b>Message</b></td>
            <td>{{$message->message}}</td>
        </tr>
        <tr>
            <td><b>Name</b></td>
            <td>{{$message->user->name}}</td>
        </tr>
        <tr>
            <td><b>Created At</b></td>
            <td>{{$message->created_at}}</td>
        </tr>                   
    </tbody>
</table>

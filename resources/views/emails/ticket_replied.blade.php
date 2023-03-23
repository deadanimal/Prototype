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
            <td>{{$tmessage->message}}</td>
        </tr>
        <tr>
            <td><b>Name</b></td>
            <td>{{$tmessage->user->name}}</td>
        </tr>
        <tr>
            <td><b>Created At</b></td>
            <td>{{$tmessage->created_at}}</td>
        </tr>                   
    </tbody>
</table>

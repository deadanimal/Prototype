
Hello {{$attendee->name}}, please find below meeting details

<table class="table table-striped table-sm">
    <tbody>

        <tr>
            <td><b>Title</b></td>
            <td>{{$meeting->title}}</td>
        </tr> 
        <tr>
            <td><b>Status</b></td>
            <td>{{$meeting->status}}</td>
        </tr>                                                                   
        <tr>
            <td><b>Date</b></td>
            <td>{{$meeting->meeting_date}}</td>
        </tr> 
        <tr>
            <td><b>Time</b></td>
            <td>{{$meeting->start_time}} - {{$meeting->end_time}}</td>
        </tr>   
        <tr>
            <td><b>Created By</b></td>
            <td>{{$meeting->user->name}}</td>
        </tr>             

    </tbody>
</table>                        

<div class="card-body">
    Remarks: {{ $meeting->remarks }} <br/>
</div>


Hello {{$attendee->name}}, please find below meeting details:

<table class="table table-striped table-sm">
    <tbody>

        <tr>
            <td><b>Title</b></td>
            <td><a href="https://prototype.com.my/meetings/{{$meeting->id}}">{{$meeting->title}}</a></td>
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

<table class="table">
    <thead>
        <tr>
            <th style="width:5%">No.</th>
            <th style="width:15%">Category</th>
            <th style="width:80%">Item</th>
        </tr>
    </thead>
    <tbody>


        @foreach ($meeting->meeting_items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucfirst($item->category) }}</td>
                <td>
                    <x-markdown>
                        {{ $item->item }}
                    </x-markdown>

                    <br /><br />
                    <i>Written at {{ $item->created_at }}</i>

                    @if ($item->attachment)
                        <br /><br />
                        Link to <a
                            href="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{ $item->attachment }}">Attachment</a>
                    @endif
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
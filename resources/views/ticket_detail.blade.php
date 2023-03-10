@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    {{$ticket->title}} | {{ ucfirst($ticket->status) }}
                </h1>

            </div>                

            <div class="row">

                <div class="col-12">
                    <div class="card">
                      
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Sender</th>
                                    <th>Message</th>                                    
                                    <th>Attachment</th>   
                                    <th>Timestamp</th>   
                                </tr>
                            </thead>
                            <tbody>
                              

                                @if($ticket->ticket_messages)
                                @foreach($ticket->ticket_messages as $message)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                                    
                                    <td>{{$message->user->name}}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>
                                        @if($message->attachment)
                                            <a href="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{$message->attachment}}">Link</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $message->created_at }}</td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                                                      
                        <form action="/tickets/{{$ticket->id}}/reply" method="POST" enctype="multipart/form-data">
                            @csrf
                                                

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" rows="5" name="message" placeholder="Textarea"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label w-100">Attachment</label>
                                <input type="file" name="attachment">
                            </div>                             

                            <button type="submit" class="btn btn-primary">Create Message</button>
                        </form>

                        </div>

                    </div>
                </div>    

                @if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff')
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                                                      
                        <form action="/tickets/{{$ticket->id}}" method="POST">
                            @csrf
                            @method('PUT')
                                                

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-control mb-3" name="status">
                                    <option value="closed">Close</option>
                                    <option value="delayed">Delayed</option>
                                    <option value="reopened">Reopen</option>
                                </select>
                            </div>                       

                            <button type="submit" class="btn btn-primary">Update Ticket</button>
                        </form>

                        </div>

                    </div>
                </div>  
                @endif                  

            </div>


        </div>
    </main>
@endsection

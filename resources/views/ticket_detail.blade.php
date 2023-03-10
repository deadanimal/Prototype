@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Ticket
                </h1>

            </div>                

            <div class="row">

                <div class="col-12">
                    <div class="card">
                      
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>User</th>
                                    <th>Message</th>                                    
                                    <th>Attachment</th>   
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

            </div>


        </div>
    </main>
@endsection

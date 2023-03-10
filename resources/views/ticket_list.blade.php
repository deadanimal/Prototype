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
                                    <th>Title</th>
                                    <th>Client</th>                                    
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              

                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                                    
                                    <td><a href="/tickets/{{$ticket->id}}">{{ $ticket->title }}</a></td>
                                    <td>{{ $ticket->organisation->name }}</td>
                                    <td>{{ ucfirst($ticket->status) }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                                                      
                        <form action="/tickets" method="POST">
                            @csrf

                            @if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff')
                            <div class="mb-3">
                                <label class="form-label">Organisation</label>
                                <select class="form-control mb-3" name="organisation_id">
                                    @foreach ($organisations as $organisation)
                                        <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                                    @endforeach
                                </select>
                            </div>                                 
                            @endif
                        

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-control mb-3" name="category">
                                    <option value="etc">etc</option>
                                </select>
                            </div>
                        

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" rows="5" name="message" placeholder="Textarea"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Ticket</button>
                        </form>

                        </div>

                    </div>
                </div>    

            </div>


        </div>
    </main>
@endsection

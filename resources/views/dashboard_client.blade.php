@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Welcome back, {{Auth::user()->name}}!
                </h1>
                {{-- <p class="header-subtitle">You have 24 new messages and 5 new notifications.</p> --}}
            </div>

            <div class="row">

                <div class="col-12">
                    {{-- <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Upcoming Meeting</h5>                            
                        </div>
                        

                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Project</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  

                                    @foreach($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->meeting_date }}</td>
                                        <td>{{ ucfirst($meeting->meeting_type) }}</td>
                                        <td>{{ $meeting->project->organisation->shortname }} - {{ $meeting->project->name }} </td>
                                        <td><a href="/meetings/{{$meeting->id}}"> {{ $meeting->title }}</a></td>
                                        <td>{{ ucfirst($meeting->status) }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        
                    </div> --}}
                </div>

        


            </div>            

        </div>
    </main>
@endsection

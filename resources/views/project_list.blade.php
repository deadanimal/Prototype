@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Project
                </h1>

            </div>                

            <div class="row">

                <div class="col-12">
                    <div class="card">
                      
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Project</th>
                                    <th>Client</th>                                    
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              

                                @foreach($projects as $project)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                                    
                                    <td><a href="/projects/{{$project->id}}">{{ $project->name }}</a></td>
                                    <td>{{ $project->organisation->name }}</td>
                                    <td>{{ ucfirst($project->status) }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

    

            </div>


        </div>
    </main>
@endsection

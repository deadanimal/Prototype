@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-12">
                    <div class="card">
                      
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Project</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              

                                @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->organisation->name }}</td>
                                    <td><a href="/projects/{{$project->id}}">{{ $project->name }}</a></td>
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

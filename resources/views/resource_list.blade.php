@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-12 col-xl-9">
                    <div class="card">
                      
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              

                                @foreach($resources as $resource)
                                <tr>
                                    <td>{{ $resource->user->name }}</td>
                                    <td>{{ $resource->resource_type }}</td>
                                    <td>{{ ucfirst($resource->status) }}</td>
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

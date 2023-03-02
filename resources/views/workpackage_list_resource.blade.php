@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of Work Package</h5>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Estimate Delivery</th>
                                    <th>Project</th>
                                    <th>Resource</th>
                                    <th>Type</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              

                                @foreach($workpackages as $wp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $wp->name }}</td>
                                    <td>{{ $wp->estimate_delivery }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>{{ $wp->package_type }}</td>
                                    <td>{{ $wp->package_level }}</td>
                                    <td>{{ $wp->status }}</td>
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

@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Profile for {{ $user->name }}!
                </h1>
                {{-- <p class="header-subtitle">You have 24 new messages and 5 new notifications.</p> --}}
            </div>

            <div class="row">

                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">User Location</h5>
                            {{-- <h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6> --}}
                        </div>
                        

                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Purpose</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
    
                                    @foreach($user->user_locations as $location)
                                    <tr>                                    
                                        <td>{{ $location->created_at }}</td>
                                        <td>{{ ucfirst($location->purpose) }}</td>
                                    </tr>
                                    @endforeach
    
                                </tbody>
                            </table>


                        
                    </div>

                    <div class="card">

                        <div class="card-body">

                   

                        </div>
                    </div>                    
                </div>



            </div>

            @yield('content')
        </div>
    </main>
@endsection

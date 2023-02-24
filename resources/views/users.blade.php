@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    User Management
                </h1>
                {{-- <p class="header-subtitle">You have 24 new messages and 5 new notifications.</p> --}}

            </div>

            <div class="row">

                <div class="col-12 col-xl-3">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5 class="card-title">Profile Picture</h5>
                            <h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
                        </div> --}}
                        <div class="card-body">

                            <form action="/users" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label w-100">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>   
                                
                                <div class="mb-3">
                                    <label class="form-label w-100">Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>                                
                                
                                <div class="mb-3">
                                    <label class="form-label w-100">Position</label>
                                    <input type="text" name="position" class="form-control">
                                </div>   
                                
                                <div class="mb-3">
                                    <label class="form-label w-100">Organisation ID</label>
                                    <input type="number" name="organisation_id" class="form-control">
                                </div>                                  

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-9">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5 class="card-title">Profile Picture</h5>
                            <h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
                        </div> --}}
                        

                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Position</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->position}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        
                    </div>
                </div>



            </div>
        </div>
    </main>

    <script>
        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
            document.getElementById("latitude1").value = position.coords.latitude;
            document.getElementById("longitude1").value = position.coords.longitude;
        }
    </script>
@endsection

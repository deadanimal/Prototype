@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Location Update
                </h1>
                {{-- <p class="header-subtitle">You have 24 new messages and 5 new notifications.</p> --}}

                <button type="button" class="btn btn-success" onclick="updateLocation()">Get Location</button>
            </div>

            <div class="row">

                <div class="col-12 col-xl-3">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5 class="card-title">Profile Picture</h5>
                            <h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
                        </div> --}}
                        <div class="card-body">

                            <form action="/location" method="POST">
                                @csrf

                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">

                                <div class="mb-3">
                                    <label class="form-label w-100">Purpose</label>
                                    <select class="form-control mb-3" name="purpose">
                                        <option disabled>Open this select menu</option>
                                        <option value="work">Work</option>
                                        <option value="meeting">Meeting</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label w-100">Latitude</label>
                                    <input type="number" id="latitude1" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label w-100">Longitude</label>
                                    <input type="number" id="longitude1" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label w-100">Remarks</label>
                                    <textarea class="form-control" rows="5" placeholder="Please state any remarks that youd like to include. Optional." name="remarks"></textarea>
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
                                        <th>Timestamp</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Purpose</th>
                                        <th class="text-end">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($locations as $location)
                                        <tr>
                                            <td>{{$location->created_at}}</td>
                                            <td>{{$location->latitude}}</td>
                                            <td>{{$location->longitude}}</td>
                                            <td>{{$location->purpose}}</td>
                                            <td>{{$location->remarks}}</td>
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

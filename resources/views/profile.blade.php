@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Welcome back, {{ $user->name }}!
                </h1>
                {{-- <p class="header-subtitle">You have 24 new messages and 5 new notifications.</p> --}}
            </div>

            <div class="row">

                <div class="col-12 col-xl-6">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5 class="card-title">Profile Picture</h5>
                            <h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
                        </div> --}}
                        <div class="card-body">

                            <form action="/profile-picture" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label w-100">Profile Picture</label>
                                    <input type="file" name="profile_picture">
                                    <small class="form-text d-block text-muted">- - - -</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>



            </div>

            @yield('content')
        </div>
    </main>
@endsection

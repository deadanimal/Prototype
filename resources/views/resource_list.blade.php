@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Resource
                </h1>

            </div>

            <div class="row">

                <div class="col-12">
                    <div class="card">

                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    @if (Auth::user()->user_type == 'admin')
                                        <th>Hourly Rate</th>
                                    @endif
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($resources as $resource)
                                    <tr>
                                        <td>
                                            @if ($resource->user->profile_picture)
                                                <img src="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{ $resource->user->profile_picture }}"
                                                    width="48" height="48" class="rounded-circle me-2" alt="Avatar">
                                            @else
                                                <img src="https://pipeline-apps.sgp1.digitaloceanspaces.com/prototype/profile_picture/QSaCQtnzxuLwd1aDyqDXKHapWdjOMMTqvNrK5828.png"
                                                    width="48" height="48" class="rounded-circle me-2"
                                                    alt="Avatar">
                                            @endif
                                            <a href="/resources/{{ $resource->id }}">
                                                {{ $resource->user->name }}
                                            </a>
                                        </td>
                                        <td>{{ ucfirst($resource->resource_type) }}</td>
                                        @if (Auth::user()->user_type == 'admin')
                                            <td>
                                                @if ($resource->currency == 'myr')
                                                    RM
                                                @endif
                                                {{ $resource->hourly_rate }}
                                            </td>
                                        @endif
                                        <td>{{ ucfirst($resource->status) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>

                @if (Auth::user()->user_type == 'admin')
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <form action="/resources" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">User ID</label>
                                        <input type="text" class="form-control" name="user_id">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Type</label>
                                        <select class="form-control mb-3" name="resource_type">
                                            <option value="analyst">Analyst</option>
                                            <option value="developer">Developer</option>
                                            <option value="business">Business</option>
                                            <option value="pmo">PMO</option>
                                            <option value="all">All</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Hourly Rate</label>
                                        <input type="number" class="form-control" name="hourly_rate">
                                    </div>


                                    <button type="submit" class="btn btn-primary">Create Resource</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif



            </div>


        </div>
    </main>
@endsection

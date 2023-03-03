@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Work Package - {{ $wp->name }}
                </h1>
                <p class="header-subtitle">{{ ucfirst($wp->status) }}</p>

            </div>

            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Work Package Summary</h5>
                        </div>

                        <div class="card-body">
                            ID: {{ $wp->id }} <br/>
                            Name: {{ $wp->name }} <br/>
                            Estimate Delivery: {{ $wp->estimate_delivery }} <br/>
                            Package Type: {{ $wp->package_type }} <br/>
                            Package level: {{ $wp->package_level }} <br/>
                            Remarks: {{ $wp->remarks }} <br/>
                            Status: {{ $wp->status }} <br/>
                            Project: {{ $wp->project->name }} <br/>
                            Resource: {{ $wp->resource->user->name }} <br/>
                            Reviewer: {{ $wp->reviewer->user->name }} <br/>
                            Coordinator: {{ $wp->coordinator->name }} <br/>
                            Created: {{ $wp->created_at }} <br/>
                        </div>


                    </div>

                </div>

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Work Submission & Review</h5>
                        </div>

                        <div class="card-body">


                            @if($wp->workpackage_reviews->count() > 0)
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Remarks</th>
                                        <th>Attachment</th>
                                        <th>Name</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
    
    
                                    @foreach ($wp->workpackage_reviews as $review)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $review->remarks }}
                                            </td>
                                            <td>
                                                @if ($review->attachment)
                                                <a
                                                href="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{ $review->attachment }}">Link</a>
                                                @else
                                                    -
                                                @endif
                                            </td>                                            
                                            <td>
                                                @if ($review->resource_id)
                                                    {{ $review->resource->user->name }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                {{ $review->created_at }}
                                            </td>                                            


                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>                            
                            @endif

                            @if (Auth::user()->resource->id == $wp->resource_id || Auth::user()->resource->id == $wp->reviewer_id || Auth::user()->resource->resource_type == 'all')
                            <form action="/workpackages/{{ $wp->id }}/review" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label w-100">Attachment</label>
                                    <input type="file" name="attachment">
                                </div>                                

                                @if (Auth::user()->resource->id == $wp->resource_id || Auth::user()->resource->resource_type == 'all')
                                <button type="submit" name="action" value="submit_work_complete" class="btn btn-primary">Submit Complete Work</button>
                                <button type="submit" name="action" value="submit_work_incomplete" class="btn btn-warning">Submit Incomplete Work</button>
                                @endif
                                @if (Auth::user()->resource->id == $wp->reviewer_id || Auth::user()->resource->resource_type == 'all')
                                <button type="submit" name="action" value="review_work_complete" class="btn btn-success">Mark as Complete</button>
                                <button type="submit" name="action" value="review_work_incomplete" class="btn btn-danger">Mark as Incomplete</button>
                                @endif
                            </form>
                            @endif
                        </div>


                    </div>


                </div>


                @if (Auth::user()->resource->resource_type == 'all' || Auth::user()->resource->resource_type == 'pmo')
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Update Workpackage</h5>
                            </div>

                            <div class="card-body">
                                <form action="/workpackages/{{ $wp->id }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ $wp->name }}">
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">Delivery Date</label>
                                        <input type="date" name="estimate_delivery" class="form-control"
                                            value="{{ $wp->estimate_delivery }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Resource</label>
                                        <select class="form-control mb-3" name="resource_id">
                                            <option value="">-</option>
                                            @foreach ($resources as $resource)
                                                @if ($wp->resource_id == $resource->id)
                                                    <option value="{{ $resource->id }}" selected>
                                                        ({{ ucfirst($resource->resource_type) }})
                                                        {{ $resource->user->name }}</option>
                                                @else
                                                    <option value="{{ $resource->id }}">
                                                        ({{ ucfirst($resource->resource_type) }})
                                                        {{ $resource->user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Reviewer</label>
                                        <select class="form-control mb-3" name="reviewer_id">
                                            <option value="">-</option>
                                            @foreach ($resources as $resource)
                                                @if ($wp->reviewer_id == $resource->id)
                                                    <option value="{{ $resource->id }}" selected>
                                                        ({{ ucfirst($resource->resource_type) }})
                                                        {{ $resource->user->name }}</option>
                                                @else
                                                    <option value="{{ $resource->id }}">
                                                        ({{ ucfirst($resource->resource_type) }})
                                                        {{ $resource->user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Remarks</label>
                                        <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea">{{ $wp->remarks }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Work Package</button>

                                </form>
                            </div>


                        </div>


                    </div>
                @endif




            </div>


        </div>
    </main>
@endsection

@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    {{ $project->organisation->name }} | {{ $project->name }}
                </h1>
            </div>



            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="tab tab-vertical">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#vertical-icon-tab-0" data-bs-toggle="tab"
                                        role="tab" aria-selected="true">
                                        Summary
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-1" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-home align-middle">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg> --}}
                                        Timeline
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-2" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Deliverable
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-3" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Document
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-4" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Meeting
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-5" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Team
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-6" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Finance
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-7" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Requirement
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-8" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Testing
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-9" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Work Package
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-10" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Ticket
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="vertical-icon-tab-0" role="tabpanel">
                                    <h4 class="tab-title">Summary</h4>

                                    WP Costs: RM {{$wp_costs}}


                                </div>

                                <div class="tab-pane" id="vertical-icon-tab-1" role="tabpanel">
                                    <h4 class="tab-title">Timeline</h4>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($phases as $phase)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucfirst($phase->name) }}</td>
                                                    <td>{{ $phase->start_date }}</td>
                                                    <td>{{ $phase->end_date }}</td>
                                                    <td>{{ $phase->status }}</td>
                                                    <td>
                                                        <form action="/projects/{{$project->id}}/phases/{{$phase->id}}" method="POST">                                                            
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger" type="submit">Delete Timeline</button>
                                                        </form>                                                        
                                                    </td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    <form action="/projects/{{ $project->id }}/phases" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label w-100">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Start Date</label>
                                            <input type="date" name="start_date" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">End Date</label>
                                            <input type="date" name="end_date" class="form-control">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Add</button>

                                    </form>


                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-2" role="tabpanel">
                                    <h4 class="tab-title">Deliverable</h4>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($deliverables as $deliverable)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a
                                                            href="/projects/{{ $project->id }}/deliverables/{{ $deliverable->id }}">{{ $deliverable->name }}</a>
                                                    </td>
                                                    <td>{{ $deliverable->remarks }}</td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    <form action="/projects/{{ $project->id }}/deliverables" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label w-100">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Date</label>
                                            <input type="date" name="date" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Remarks</label>
                                            <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Add</button>

                                    </form>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-3" role="tabpanel">
                                    <h4 class="tab-title">Document</h4>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($documents as $document)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $document->created_at }}</td>
                                                    <td><a
                                                            href="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{ $document->document }}">{{ $document->name }}</a>
                                                    </td>
                                                    <td>{{ ucfirst($document->category) }}</td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    <form action="/projects/{{ $project->id }}/documents" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label w-100">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Version</label>
                                            <input type="number" name="version" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-control mb-3" name="category">
                                                <option value="technical">Technical</option>
                                                <option value="administration">Administration</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Attachment</label>
                                            <input type="file" name="document">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Upload</button>

                                    </form>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-4" role="tabpanel">
                                    <h4 class="tab-title">Meeting</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($meetings as $meeting)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $meeting->meeting_date }}</td>
                                                    <td><a href="/meetings/{{ $meeting->id }}">{{ $meeting->title }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-5" role="tabpanel">
                                    <h4 class="tab-title">Member</h4>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($members as $member)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucfirst($member->user->name) }}</td>
                                                    <td>{{ ucfirst($member->category) }}</td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    <form action="/projects/{{ $project->id }}/members" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label w-100">Name</label>
                                            <select class="form-control mb-3" name="user_id">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-control mb-3" name="category">
                                                <option value="analyst">Analyst</option>
                                                <option value="developer">Developer</option>
                                                <option value="project">Project</option>
                                            </select>
                                        </div>



                                        <button type="submit" class="btn btn-primary">Add</button>

                                    </form>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-6" role="tabpanel">
                                    <h4 class="tab-title">Finance</h4>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucfirst($payment->name) }}</td>
                                                    <td>RM {{ $payment->amount }}</td>
                                                    <td>{{ $payment->date }}</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    <form action="/projects/{{ $project->id }}/payments" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label w-100">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Amount</label>
                                            <input type="number" name="amount" class="form-control" step="0.01"
                                                min="1.00">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Date</label>
                                            <input type="date" name="date" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Remarks</label>
                                            <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Add</button>

                                    </form>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-7" role="tabpanel">
                                    <h4 class="tab-title">Requirement</h4>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($requirements as $requirement)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $requirement->name }}</td>
                                                    <td>{{ $requirement->category }}</td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    <form action="/requirements" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                                        <div class="mb-3">
                                            <label class="form-label w-100">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-control mb-3" name="category">
                                                <option value="view">View</option>
                                                <option value="function">Function</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label w-100">Remarks</label>
                                            <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Add Requirement</button>

                                    </form>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-8" role="tabpanel">
                                    <h4 class="tab-title">Testing</h4>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-9" role="tabpanel">
                                    <h4 class="tab-title">Work Package</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Estimated Delivery</th>
                                                <th>Project</th>
                                                <th>Resource</th>
                                                <th>Reviewer</th>
                                                {{-- <th>Coordinator</th>
                                            <th>Type</th>
                                            <th>Level</th> --}}
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($wps as $wp)
                                                <tr>
                                                    <td>{{ $wp->id }}</td>
                                                    <td>
                                                        <a href="/workpackages/{{ $wp->id }}">
                                                            {{ $wp->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if ($wp->estimate_delivery)
                                                            {{ $wp->estimate_delivery }}
                                                        @else
                                                            ?
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($wp->project_id)
                                                            <a href="/projects/{{ $wp->project_id }}">
                                                                {{ $wp->project->name }}
                                                            </a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($wp->resource_id)
                                                            {{ $wp->resource->user->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($wp->reviewer_id)
                                                            {{ $wp->reviewer->user->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    {{-- <td>{{ $wp->coordinator->name }}</td>
                                            <td>{{ $wp->package_type }}</td>
                                            <td>{{ $wp->package_level }}</td> --}}
                                                    <td>{{ $wp->status }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-10" role="tabpanel">
                                    <h4 class="tab-title">Ticket</h4>

                                    @if ($tickets)
                                        <div class="col-12">
                                            <div class="card">

                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Title</th>
                                                            <th>Client</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        @foreach ($tickets as $ticket)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td><a
                                                                        href="/tickets/{{ $ticket->id }}">{{ $ticket->title }}</a>
                                                                </td>
                                                                <td>{{ $ticket->organisation->name }}</td>
                                                                <td>{{ ucfirst($ticket->status) }}</td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>














        </div>
    </main>
@endsection

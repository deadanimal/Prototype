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

                                    


                                </div>

                                <div class="tab-pane" id="vertical-icon-tab-1" role="tabpanel">
                                    <h4 class="tab-title">Timeline</h4>

                                    <table class="table table-striped table-sm">
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
                                                    <td>{{ ucfirst($phase->status) }}</td>
                                                    <td>

                                                        <div class="btn-group">
                                                            <button type="button" class="btn mb-1 btn-primary dropdown-toggle hide" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu hide" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 34.5px, 0px);">
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPhaseView{{$phase->id}}" href="#">View</a>
                                                                @if(Auth::user()->organisation_id == 1)
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPhaseEdit{{$phase->id}}" href="#">Edit</a>
                                                                @endif
                                                                <div class="dropdown-divider"></div>
                                                                <form action="/projects/{{$project->id}}/phases/{{$phase->id}}" method="POST">                                                            
                                                                    @csrf
                                                                    @method('DELETE')
        
                                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                                </form>                                                                    
                                                            </div>
                                                        </div>
                                                        
                                                                                                            
                                                    </td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    @if(Auth::user()->organisation_id == 1)
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

                                        <div class="mb-3">
                                            <label class="form-label w-100">Remarks</label>
                                            <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                        </div>                                        

                                        <button type="submit" class="btn btn-primary">Add</button>

                                    </form>
                                    @endif


                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-2" role="tabpanel">
                                    <h4 class="tab-title">Deliverable</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($deliverables as $deliverable)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $deliverable->name }}</td>
                                                    <td>
                                                        @if($deliverable->date)
                                                            {{ $deliverable->date }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn mb-1 btn-primary dropdown-toggle hide" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu hide" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 34.5px, 0px);">
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDeliverableView{{$deliverable->id}}" href="#">View</a>
                                                                @if(Auth::user()->organisation_id == 1)
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDeliverableEdit{{$deliverable->id}}" href="#">Edit</a>
                                                                @endif
                                                                <div class="dropdown-divider"></div>
                                                                <form action="/projects/{{$project->id}}/deliverables/{{$deliverable->id}}" method="POST">                                                            
                                                                    @csrf
                                                                    @method('DELETE')
        
                                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                                </form>                                                                    
                                                            </div>
                                                        </div>                                                        
                                                    </td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    @if(Auth::user()->organisation_id == 1)
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
                                    @endif

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-3" role="tabpanel">
                                    <h4 class="tab-title">Document</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Version</th>
                                                <th>Category</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($documents as $document)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if($document->name)
                                                            {{ $document->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($document->version)
                                                            {{ $document->version }}
                                                        @else
                                                            -
                                                        @endif                                                        
                                                    </td>                                                 
                                                    <td>{{ ucfirst($document->category) }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn mb-1 btn-primary dropdown-toggle hide" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu hide" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 34.5px, 0px);">
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDocumentView{{$document->id}}" href="#">View</a>
                                                                @if(Auth::user()->organisation_id == 1)
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDocumentEdit{{$document->id}}" href="#">Edit</a>
                                                                @endif
                                                                <div class="dropdown-divider"></div>
                                                                <form action="/projects/{{$project->id}}/documents/{{$document->id}}" method="POST">                                                            
                                                                    @csrf
                                                                    @method('DELETE')
        
                                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                                </form>                                                                    
                                                            </div>
                                                        </div>                                                        
                                                    </td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    @if(Auth::user()->organisation_id == 1)
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

                                        <button type="submit" class="btn btn-primary">Add</button>

                                    </form>
                                    @endif

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

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($members as $member)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucfirst($member->user->name) }}</td>
                                                    <td>{{ ucfirst($member->category) }}</td>
                                                    <td>
                                                        <form action="/projects/{{$project->id}}/members/{{$member->id}}" method="POST">                                                            
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger" type="submit">Remove</button>
                                                        </form>                                                           
                                                    </td>
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
                                                <option value="user">User</option>
                                            </select>
                                        </div>



                                        <button type="submit" class="btn btn-primary">Add Member</button>

                                    </form>

                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-6" role="tabpanel">
                                    <h4 class="tab-title">Finance</h4>

                                    <table class="table table-striped table-sm">
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

                                    <table class="table table-striped table-sm">
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
                                                    <td><a href="/requirements/{{$requirement->id}}">{{ $requirement->name }}</a></td>
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

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($testflows as $testflow)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="/testflows/{{$testflow->id}}">{{ $testflow->name }}</a></td>
                                                    <td>{{ $testflow->category }}</td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>

                                    <form action="/testflows" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                                        <div class="mb-3">
                                            <label class="form-label w-100">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-control mb-3" name="category">
                                                <option value="-">-</option>
                                            </select>
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label w-100">Remarks</label>
                                            <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Add Test Flow</button>

                                    </form>                                    

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


                                    <form action="/tickets" method="POST" enctype="multipart/form-data">
                                        @csrf
            
           
                                        <input type="hidden" name="project_id" value="{{$project->id}}">
            
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Title">
                                        </div>
            
                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-control mb-3" name="category">
                                                <option value="etc">etc</option>
                                            </select>
                                        </div>
                                    
            
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" id="my-text-area" rows="5" name="message" placeholder="Textarea"></textarea>
                                        </div>
            
                                        <div class="mb-3">
                                            <label class="form-label w-100">Attachment</label>
                                            <input type="file" name="attachment">
                                        </div>                            
            
                                        <button type="submit" class="btn btn-primary">Create Ticket</button>
                                    </form>     
                                    
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
										Primary
									</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            @foreach($phases as $phase)
            <div class="modal fade" id="modalPhaseView{{$phase->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Timeline</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">

                            <div class="mb-3">
                                <label class="form-label w-100">Name</label>
                                <input disabled type="text" name="name" value="{{$phase->name}}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label w-100">Start Date</label>
                                <input disabled type="date" name="start_date" value="{{$phase->start_date}}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label w-100">End Date</label>
                                <input disabled type="date" name="end_date" value="{{$phase->end_date}}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label w-100">Remarks</label>
                                <textarea disabled class="form-control" rows="5" name="remarks">{{$phase->remarks}}</textarea>
                            </div>                                 

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalPhaseEdit{{$phase->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Timeline</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">


                            <form action="/projects/{{ $project->id }}/phases/{{$phase->id}}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label w-100">Name</label>
                                    <input type="text" name="name" value="{{$phase->name}}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label w-100">Start Date</label>
                                    <input type="date" name="start_date" value="{{$phase->start_date}}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label w-100">End Date</label>
                                    <input type="date" name="end_date" value="{{$phase->end_date}}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label w-100">Remarks</label>
                                    <textarea class="form-control" rows="5" name="remarks">{{$phase->remarks}}</textarea>
                                </div>                                        

                                <button type="submit" class="btn btn-primary">Edit</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>            

            @endforeach


            @foreach($deliverables as $deliverable)
            <div class="modal fade" id="modalDeliverableView{{$deliverable->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Deliverable</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">

                            <div class="mb-3">
                                <label class="form-label w-100">Name</label>
                                <input disabled type="text" name="name" value="{{$deliverable->name}}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label w-100">Date</label>
                                <input disabled type="date" name="date" value="{{$deliverable->date}}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label w-100">Remarks</label>
                                <textarea disabled class="form-control" rows="5" name="remarks">{{$deliverable->remarks}}</textarea>
                            </div>                            

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalDeliverableEdit{{$deliverable->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Deliverable</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">


                            <form action="/projects/{{ $project->id }}/deliverables/{{$deliverable->id}}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf


                                    <div class="mb-3">
                                        <label class="form-label w-100">Name</label>
                                        <input type="text" name="name" value="{{$deliverable->name}}" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label w-100">Date</label>
                                        <input type="date" name="date" value="{{$deliverable->date}}" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label w-100">Remarks</label>
                                        <textarea class="form-control" rows="5" name="remarks">{{$deliverable->remarks}}</textarea>
                                    </div>

             

                                <button type="submit" class="btn btn-primary">Edit</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>            

            @endforeach            


            @foreach($documents as $document)
            <div class="modal fade" id="modalDocumentView{{$document->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Document</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">

                            <div class="mb-3">
                                <label class="form-label w-100">Name</label>
                                <input type="text" name="name" value="{{$document->name}}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label w-100">Version</label>
                                <input type="number" name="version" value="{{$document->version}}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" value="{{$document->category}}" class="form-control">
                            </div>        
                            
                            <div class="mb-3">
                                <label class="form-label">Link</label><br/>
                                <a href="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{$document->document}}">Document</a>
                            </div>                              

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalDocumentEdit{{$document->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Document</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">


                            <form action="/projects/{{ $project->id }}/documents/{{$document->id}}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf


                                <div class="mb-3">
                                    <label class="form-label w-100">Name</label>
                                    <input type="text" name="name" value="{{$document->name}}" class="form-control">
                                </div>
    
                                <div class="mb-3">
                                    <label class="form-label w-100">Version</label>
                                    <input type="number" name="version" value="{{$document->version}}" class="form-control">
                                </div>
    
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control mb-3" name="category">
                                        <option value="technical">Technical</option>
                                        <option value="administration">Administration</option>
                                    </select>
                                </div>   

             

                                <button type="submit" class="btn btn-primary">Edit</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>            

            @endforeach  



        </div>
    </main>
@endsection

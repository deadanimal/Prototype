@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    {{ $meeting->title }}
                </h1>
                <p class="header-subtitle">{{ $meeting->meeting_date }} | {{ ucfirst($meeting->status) }}</p>
            </div>

            <div class="row">

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Meeting Detail</h5>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Title</td>
                                    <td>{{ $meeting->title }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $meeting->status }}</td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>{{ $meeting->meeting_date }}</td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td>{{ $meeting->start_time }} - {{ $meeting->end_time }}</td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td>{{ $meeting->user->name }}</td>
                                </tr>


                            </tbody>
                        </table>





                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Remarks</h5>
                        </div>

                        <div class="card-body">
                            <x-markdown>
                                {{ $meeting->remarks }}
                            </x-markdown>
                        </div>





                    </div>
                </div>

                <div class="col-12">

                    <div class="tab tab-vertical">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#vertical-icon-tab-0" data-bs-toggle="tab" role="tab"
                                    aria-selected="true">
                                    Summary
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#vertical-icon-tab-1" data-bs-toggle="tab" role="tab"
                                    aria-selected="false">
                                    Attendee
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#vertical-icon-tab-2" data-bs-toggle="tab" role="tab"
                                    aria-selected="false">
                                    Note
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#vertical-icon-tab-3" data-bs-toggle="tab" role="tab"
                                    aria-selected="false">
                                    Action
                                </a>
                            </li>
                            @if (Auth::user()->resource)
                                @if (Auth::user()->resource->resource_type == 'all' || Auth::user()->resource->resource_type == 'pmo')
                                    <li class="nav-item">
                                        <a class="nav-link" href="#vertical-icon-tab-4" data-bs-toggle="tab" role="tab"
                                            aria-selected="false">
                                            Detail
                                        </a>
                                    </li>
                                @endif
                            @endif

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="vertical-icon-tab-0" role="tabpanel">
                                <h4 class="tab-title">Summary</h4>


                            </div>

                            <div class="tab-pane" id="vertical-icon-tab-1" role="tabpanel">
                                <h4 class="tab-title">Attendee</h4>


                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">No.</th>
                                            <th style="width:15%">Name</th>
                                            <th style="width:15%">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($meeting->meeting_attendees as $attendee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucfirst($attendee->name) }}</td>
                                                <td>{{ $attendee->email }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <form action="/meetings/{{ $meeting->id }}/attendees" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf




                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">User</label>
                                        <select class="form-control mb-3" name="user_id">
                                            <option value="">Client</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Add Meeting Attendee</button>
                                </form>

                            </div>
                            <div class="tab-pane" id="vertical-icon-tab-2" role="tabpanel">
                                <h4 class="tab-title">Note</h4>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">No.</th>
                                            <th style="width:15%">Category</th>
                                            <th style="width:80%">Item</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($meeting->meeting_items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucfirst($item->category) }}</td>
                                                <td>
                                                    <x-markdown>
                                                        {{ $item->item }}
                                                    </x-markdown>

                                                    <br /><br />
                                                    <i>Written at {{ $item->created_at }}</i>

                                                    @if ($item->attachment)
                                                        <br /><br />
                                                        Link to <a
                                                            href="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{ $item->attachment }}">Attachment</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <form action="/meetings/{{ $meeting->id }}/notes" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf



                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-control mb-3" name="category">
                                            <option value="general">General</option>
                                        </select>
                                    </div>



                                    <div class="mb-3">
                                        <label class="form-label">Item</label>
                                        <textarea class="form-control" id="my-text-area-1" rows="5" name="item" placeholder="Textarea"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label w-100">Attachment</label>
                                        <input type="file" name="attachment">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Meeting Item</button>
                                </form>



                            </div>
                            <div class="tab-pane" id="vertical-icon-tab-3" role="tabpanel">
                                <h4 class="tab-title">Action</h4>


                                <form action="/meetings/{{ $meeting->id }}/reschedule" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf



                                    <div class="mb-3">
                                        <label class="form-label">New Meeting Date</label>
                                        <input type="date" name="meeting_date" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Remarks</label>
                                        <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                    </div>

                                    <button type="submit" name="action" value="cancel"
                                        class="btn btn-danger">Cancel</button>
                                    <button type="submit" name="action" value="reschedule"
                                        class="btn btn-primary">Reschedule</button>
                                    <button type="submit" name="action" value="completed"
                                        class="btn btn-success">Complete</button>
                                </form>


                            </div>

                            <div class="tab-pane" id="vertical-icon-tab-4" role="tabpanel">
                                <h4 class="tab-title">Detail</h4>

                                <h4 class="tab-title mt-3">Meeting Detail</h4>
                                <form action="/meetings/{{ $meeting->id }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Meeting Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ $meeting->title }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meeting Date</label>
                                        <input type="date" name="meeting_date" class="form-control"
                                            value="{{ $meeting->meeting_date }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Start Time</label>
                                        <input type="time" name="start_time" class="form-control"
                                            value="{{ $meeting->start_time }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">End Time</label>
                                        <input type="time" name="end_time" class="form-control"
                                            value="{{ $meeting->end_time }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meeting Remarks</label>
                                        <textarea class="form-control" id="my-text-area-2" rows="5" name="meeting_remarks" placeholder="Textarea">{{ $meeting->remarks }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Meeting</button>
                                </form>

                            </div>

                        </div>
                    </div>

                </div>







            </div>


        </div>
    </main>

    <script>
        function markdown_editor() {
            const easyMDE1 = new EasyMDE({
                element: document.getElementById('my-text-area-1')
            });

            const easyMDE2 = new EasyMDE({
                element: document.getElementById('my-text-area-2')
            });

        }


        markdown_editor();
    </script>
@endsection

@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Work Package
                </h1>

            </div>

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Create Work Package</h5>
                        </div>
                        <div class="card-body">
                            <form action="/workpackages" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-control mb-3" name="package_type">
                                        <option value="analyst - wireframe">Analyst - Wireframe</option>
                                        <option value="analyst - erd + dfd">Analyst - ERD & DFD</option>
                                        <option value="analyst - use case + process flow">Analyst - Use Case & Process Flow
                                        </option>
                                        <option value="analyst - system architecture">Analyst - System Architecture</option>
                                        <option value="analyst - testing scripts">Analyst - Testing Scripts</option>
                                        <option value="analyst - test">Analyst - Test</option>
                                        <option value="analyst - pentest + stress test">Analyst - Pentest & Stress Test
                                        </option>
                                        <option value="analyst - integration documents">Analyst - Integration Documents
                                        </option>
                                        <option value="analyst - migration documents">Analyst - Migration Documents</option>
                                        <option value="analyst - migration">Analyst - Migration</option>
                                        <option value="analyst - integration testings">Analyst - Integration Test</option>
                                        <option value="analyst - documentations">Analyst - Documentations</option>
                                        <option value="analyst - miscelleneous">Analyst - Miscelleneous</option>

                                        <option value="developer - develop function">Developer - Develop Function
                                        </option>
                                        <option value="developer - develop interface">Developer - Develop Interface</option>
                                        <option value="developer - deployment">Developer - Deployment</option>
                                        <option value="developer - bug fixing">Developer - Bug Fixing</option>
                                        <option value="other - training">Other - Training</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Level</label>
                                    <select class="form-control mb-3" name="package_level">
                                        <option value="1 - 6 hours">Level 1 - 6 Hours</option>
                                        <option value="2 - 3 hours">Level 2 - 3 Hours</option>
                                        <option value="3 - 1 hour">Level 3 - 1 Hour</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Delivery Date</label>
                                    <input type="date" name="estimate_delivery" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Project</label>
                                    <select class="form-control mb-3" name="project_id">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">({{ $project->organisation->shortname }})
                                                {{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Resource</label>
                                    <select class="form-control mb-3" name="resource_id">
                                        <option value="">-</option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->id }}">
                                                ({{ ucfirst($resource->resource_type) }})
                                                {{ $resource->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Reviewer</label>
                                    <select class="form-control mb-3" name="reviewer_id">
                                        <option value="">-</option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->id }}">
                                                ({{ ucfirst($resource->resource_type) }})
                                                {{ $resource->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" id="my-text-area" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Work Package</button>
                            </form>
                        </div>
                    </div>
                </div> 



            </div>


        </div>
    </main>

    <script>
        function markdown_editor() {
            const easyMDE = new EasyMDE({
                element: document.getElementById('my-text-area')
            });

        }


        markdown_editor();
    </script>
@endsection

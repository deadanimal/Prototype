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
                            <h5 class="card-title">List of Work Packages</h5>
                            <h6 class="card-subtitle text-muted">See WPs assigned to self? Click <a href="/workpackages/assigned">here</a></h6>
                        </div>

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
                              

                                @foreach($workpackages as $wp)
                                <tr>
                                    <td>{{ $wp->id }}</td>
                                    <td>
                                        <a href="/workpackages/{{$wp->id}}">
                                        {{ $wp->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($wp->estimate_delivery)
                                        {{ $wp->estimate_delivery }}
                                        @else
                                        ?
                                        @endif                                        
                                        </td>
                                    <td>
                                        @if($wp->project_id)
                                        <a href="/projects/{{$wp->project_id}}">
                                            {{$wp->project->name}}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($wp->resource_id)
                                            {{$wp->resource->user->name}}
                                        @else
                                        -
                                        @endif                                        
                                    </td>
                                    <td>
                                        @if($wp->reviewer_id)
                                            {{$wp->reviewer->user->name}}
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
                </div>

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

                                        <option value="developer - develop functional">Developer - Develop Functional
                                        </option>
                                        <option value="developer - develop interface">Developer - Develop Interface</option>
                                        <option value="developer - deployment">Developer - Deployment</option>
                                        <option value="developer - bug fixing">Developer - Bug Fixing</option>
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
                                    <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                </div>                                

                                <button type="submit" class="btn btn-primary">Create Work Package</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Horizontal form</h5>
                            <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" placeholder="Email" autocomplete="off"
                                            style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAkCAYAAADo6zjiAAAAAXNSR0IArs4c6QAAAbNJREFUWAntV8FqwkAQnaymUkpChB7tKSfxWCie/Yb+gbdeCqGf0YsQ+hU95QNyDoWCF/HkqdeiIaEUqyZ1ArvodrOHxanQOiCzO28y781skKwFW3scPV1/febP69XqarNeNTB2KGs07U3Ttt/Ozp3bh/u7V7muheQf6ftLUWyYDB5yz1ijuPAub2QRDDunJsdGkAO55KYYjl0OUu1VXOzQZ64Tr+IiPXedGI79bQHdbheCIAD0dUY6gV6vB67rAvo6IxVgWVbFy71KBKkAFaEc2xPQarXA931ot9tyHphiPwpJgSbfe54Hw+EQHMfZ/msVEEURjMfjCjbFeG2dFxPo9/sVOSYzxmAwGIjnTDFRQLMQAjQ5pJAQkCQJ5HlekeERxHEsiE0xUUCzEO9AmqYQhiF0Oh2Yz+ewWCzEY6aYKKBZCAGYs1wuYTabKdNNMWWxnaA4gp3Yry5JBZRlWTXDvaozUgGTyQSyLAP0dbb3DtQlmcan0yngT2ekE9ARc+z4AvC7nauh9iouhpcGamJeX8XF8MaClwaeROWRA7nk+tUnyzGvZrKg0/40gdME/t8EvgG0/NOS6v9NHQAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" placeholder="Password"
                                            autocomplete="off"
                                            style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAkCAYAAADo6zjiAAAAAXNSR0IArs4c6QAAAbNJREFUWAntV8FqwkAQnaymUkpChB7tKSfxWCie/Yb+gbdeCqGf0YsQ+hU95QNyDoWCF/HkqdeiIaEUqyZ1ArvodrOHxanQOiCzO28y781skKwFW3scPV1/febP69XqarNeNTB2KGs07U3Ttt/Ozp3bh/u7V7muheQf6ftLUWyYDB5yz1ijuPAub2QRDDunJsdGkAO55KYYjl0OUu1VXOzQZ64Tr+IiPXedGI79bQHdbheCIAD0dUY6gV6vB67rAvo6IxVgWVbFy71KBKkAFaEc2xPQarXA931ot9tyHphiPwpJgSbfe54Hw+EQHMfZ/msVEEURjMfjCjbFeG2dFxPo9/sVOSYzxmAwGIjnTDFRQLMQAjQ5pJAQkCQJ5HlekeERxHEsiE0xUUCzEO9AmqYQhiF0Oh2Yz+ewWCzEY6aYKKBZCAGYs1wuYTabKdNNMWWxnaA4gp3Yry5JBZRlWTXDvaozUgGTyQSyLAP0dbb3DtQlmcan0yngT2ekE9ARc+z4AvC7nauh9iouhpcGamJeX8XF8MaClwaeROWRA7nk+tUnyzGvZrKg0/40gdME/t8EvgG0/NOS6v9NHQAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Textarea</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
                                    </div>
                                </div>
                                <fieldset class="mb-3">
                                    <div class="row">
                                        <label class="col-form-label col-sm-2 text-sm-end pt-sm-0">Radios</label>
                                        <div class="col-sm-10">
                                            <label class="form-check">
                                                <input name="radio-3" type="radio" class="form-check-input"
                                                    checked="">
                                                <span class="form-check-label">Default radio</span>
                                            </label>
                                            <label class="form-check">
                                                <input name="radio-3" type="radio" class="form-check-input">
                                                <span class="form-check-label">Second default radio</span>
                                            </label>
                                            <label class="form-check">
                                                <input name="radio-3" type="radio" class="form-check-input"
                                                    disabled="">
                                                <span class="form-check-label">Disabled radio</span>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end pt-sm-0">Checkbox</label>
                                    <div class="col-sm-10">
                                        <label class="form-check m-0">
                                            <input type="checkbox" class="form-check-input">
                                            <span class="form-check-label">Check me out</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-10 ms-sm-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}

            </div>


        </div>
    </main>
@endsection

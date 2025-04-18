@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Meeting 
                </h1>
                <h6 class="header-subtitle text-white">Look for <a href="/meeting-search">meetings?</a></h6>                            

            </div>            

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Upcoming Meeting</h5>                            
                        </div>
                        

                            <table class="table table-striped table-sm meeting-datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Type</th>
                                        <th>Project</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($upcoming_meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->meeting_date }}</td>
                                        <td>{{ $meeting->start_time }} - {{ $meeting->end_time }}</td>
                                        <td>{{ ucfirst($meeting->meeting_type) }}</td>
                                        <td>{{ $meeting->project->organisation->shortname }} - {{ $meeting->project->name }} </td>
                                        <td><a href="/meetings/{{$meeting->id}}"> {{ $meeting->title }}</a></td>
                                        <td>{{ ucfirst($meeting->status) }}</td>
                                    </tr>
                                    @endforeach                                    
                                  

                                </tbody>
                            </table>

                        
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
      
                        <div class="card-body">
                            <form action="/meetings" method="POST">
                                @csrf

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
                                    <label class="form-label">Meeting Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Meeting title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meeting Type</label>
                                    <select class="form-control mb-3" name="meeting_type">
                                        <option value="requirement">Requirement</option>
                                        <option value="testing">Testing</option>
                                        <option value="progress">Progress</option>
                                        <option value="business">Business</option>
                                        <option value="internal">Internal</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meeting Date</label>
                                    <input type="date" name="meeting_date" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" name="start_time" class="form-control">
                                </div>          
                                
                                <div class="mb-3">
                                    <label class="form-label">End Time</label>
                                    <input type="time" name="end_time" class="form-control">
                                </div>                                   

                                <div class="mb-3">
                                    <label class="form-label">Meeting Remarks</label>
                                    <textarea class="form-control" id="my-text-area" rows="5" name="meeting_remarks" placeholder="Textarea"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Meeting</button>
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

    <script>
        function markdown_editor() {
            const easyMDE = new EasyMDE({
                element: document.getElementById('my-text-area')
            });

        }


        markdown_editor();
    </script>


{{-- 
    <script type="text/javascript">
        $(function () {
          
          var table = $('.meeting-datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/dt/meetings",
              columns: [
                  //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'meeting_date', name: 'meeting_date'},
                  {data: 'meeting_type', name: 'meeting_type'},
                  {data: 'meeting_type', name: 'meeting_type'},
                  {data: 'title', name: 'title'},
                  {data: 'status', name: 'status'},
                  {
                      data: 'action', 
                      name: 'action', 
                      orderable: true, 
                      searchable: true
                  },
              ]
          });
          
        });
      </script>     --}}
@endsection

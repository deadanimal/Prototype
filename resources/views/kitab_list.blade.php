@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Knowledge Book
                </h1>

            </div>

            <div class="row">

                @if ($kitabs)
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title">List of Books</h5>
                            </div>                            

                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Category</th>
                                        <th>Privacy</th>
                                        <th>Title</th>                                        
                                        <th>Author</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($kitabs as $kitab)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucfirst($kitab->category) }}</td>
                                            <td>Public</td>
                                            <td><a href="/kitabs/{{ $kitab->id }}">{{ $kitab->title }}</a></td>
                                            <td>{{ ucfirst($kitab->user->name) }}</td>
                                            <td>{{ $kitab->updated_at }}</td>
                                        </tr>
                                    @endforeach

                                    @foreach ($notes as $note)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucfirst($note->category) }}</td>
                                            <td>Private</td>
                                            <td><a href="/kitabs/{{ $note->id }}">{{ $note->title }}</a></td>
                                            <td>{{ ucfirst($note->user->name) }}</td>
                                            <td>{{ $note->updated_at }}</td>
                                        </tr>
                                    @endforeach                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <form action="/kitabs" method="POST" enctype="multipart/form-data">
                                @csrf


                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control mb-3" name="category">
                                        <option value="analyst">Analyst</option>
                                        <option value="developer">Developer</option>
                                        <option value="devops">Devops</option>
                                        <option value="project">Project</option>
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Privacy</label>
                                    <select class="form-control mb-3" name="privacy">
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    </select>
                                </div>                                

                                <textarea id="my-text-area" name="remarks"></textarea>




                                <button type="submit" class="btn btn-primary">Create Kitab</button>
                            </form>

                        </div>

                    </div>
                </div>

            </div>
 
            
            <div class="row">

                @if (count($attachments) > 0)
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title">Personal Attachments</h5>
                            </div>                            

                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($attachments as $attachment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{ $attachment->link }}">{{$attachment->title}}</a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <form action="/kitab-attachments" method="POST" enctype="multipart/form-data">
                                @csrf


                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label w-100">Attachment</label>
                                    <input type="file" name="attachment">
                                </div>                                    


                                <button type="submit" class="btn btn-primary">Create Attachment</button>
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

            const easyMDE2 = new EasyMDE({
                element: document.getElementById('my-text-area-2')
            });            

        }


        markdown_editor();
    </script>
@endsection

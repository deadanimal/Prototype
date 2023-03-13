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

                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($kitabs as $kitab)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucfirst($kitab->category) }}</td>
                                            <td><a href="/kitabs/{{ $kitab->id }}">{{ $kitab->title }}</a></td>
                                            <td>{{ ucfirst($kitab->user->name) }}</td>
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

                                <textarea id="my-text-area" name="remarks"></textarea>




                                <button type="submit" class="btn btn-primary">Create Kitab</button>
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

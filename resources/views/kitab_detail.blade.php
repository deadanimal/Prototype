@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    {{$kitab->title}} | {{$kitab->category}}
                </h1>

            </div>                

            <div class="row">

                
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            {!! $remarks !!}
                        </div>
                      
               
                    </div>
                </div>
                

                @if(Auth::user()->id == $kitab->user_id)
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                                                      
                        <form action="/kitabs/{{$kitab->id}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                        

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{$kitab->title}}">
                            </div>


                            <textarea id="my-text-area" name="remarks">{{$kitab->remarks}}</textarea>


                                          

                            <button type="submit" class="btn btn-primary">Update Kitab</button>
                        </form>

                        </div>

                    </div>
                </div>    
                @endif

            </div>


        </div>
    </main>

    <script>

function lol() {
    const easyMDE = new EasyMDE({element: document.getElementById('my-text-area')});

}


lol();



    </script>
@endsection

@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Tender
                </h1>

            </div>                

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{$tender}}
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                                                      
                        <form action="/tenderproposals/{{$tender->id}}" method="POST">
                            @csrf
                            @method('PUT')
                              
                        

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{$tender->title}}">
                            </div>
                         

                            <div class="mb-3">
                                <label class="form-label">Briefing Date</label>
                                <input type="date" name="briefing_date" class="form-control" value="{{$tender->briefing_date}}">
                            </div>                            

                            <div class="mb-3">
                                <label class="form-label">Submission Date</label>
                                <input type="date" name="submission_date" class="form-control" value="{{$tender->submission_date}}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Remarks</label>
                                <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea">{{$tender->remarks}}"</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Tender</button>
                        </form>

                        </div>

                    </div>
                </div>    

            </div>


        </div>
    </main>
@endsection

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
                      
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Project</th>
                                    <th>Client</th>                                    
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              

                                @foreach($tenders as $tender)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                                    
                                    <td><a href="/tenders/{{$tender->id}}">{{ $tender->title }}</a></td>
                                    <td>{{ $tender->organisation->name }}</td>
                                    <td>{{ ucfirst($tender->status) }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                                                      
                        <form action="/tenderproposals" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Organisation</label>
                                <select class="form-control mb-3" name="organisation_id">
                                    @foreach ($organisations as $organisation)
                                        <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                                    @endforeach
                                </select>
                            </div>                                 
                        

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
                                <label class="form-label">Tender Type</label>
                                <select class="form-control mb-3" name="tender_type">
                                    <option value="sebutharga">Sebutharga</option>
                                    <option value="tender">Tender</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>                            

                            <div class="mb-3">
                                <label class="form-label">Briefing Date</label>
                                <input type="date" name="briefing_date" class="form-control">
                            </div>                            

                            <div class="mb-3">
                                <label class="form-label">Submission Date</label>
                                <input type="date" name="submission_date" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Remarks</label>
                                <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
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

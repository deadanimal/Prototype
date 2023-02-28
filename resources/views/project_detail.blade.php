@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    {{$project->organisation->name}} | {{$project->name}}
                </h1>
            </div>


            <div class="row">
                <div class="col-12 col-xl-3">

                    
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div> 
            </div>

            <div class="row">
                <div class="col-12 col-xl-3">

                    
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div> 
            </div>   

            <div class="row">       
                
                <div class="header">
                    <h3>
                        Project Phase
                    </h3>
                </div>                

                <div class="col-12 col-xl-3">

                    
                    <div class="card">
                        <div class="card-body">

                            <form action="/projects/{{$project->id}}/phases" method="POST" enctype="multipart/form-data">
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

                                <button type="submit" class="btn btn-primary">Add</button>

                            </form>

                        </div>
                    </div>
                </div>                

                <div class="col-12 col-xl-9">
                    <div class="card">
                      
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($phases as $phase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $phase->name }}</td>
                                </tr>
                                @endforeach                                
                              



                            </tbody>
                        </table>
                    </div>
                </div>

    

            </div>               
            
            <div class="row">       
                
                <div class="header">
                    <h3>
                        Project Deliverable
                    </h3>
                </div>                

                <div class="col-12 col-xl-3">

                    
                    <div class="card">
                        <div class="card-body">

                            <form action="/projects/{{$project->id}}/deliverables" method="POST" enctype="multipart/form-data">
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

                        </div>
                    </div>
                </div>                

                <div class="col-12 col-xl-9">
                    <div class="card">
                      
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($deliverables as $deliverable)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="/projects/{{$project->id}}/deliverables/{{$deliverable->id}}">{{ $deliverable->name }}</a></td>
                                </tr>
                                @endforeach                                
                              



                            </tbody>
                        </table>
                    </div>
                </div>

    

            </div>            

            <div class="row">       
                
                <div class="header">
                    <h3>
                        Project Document
                    </h3>
                </div>                

                <div class="col-12 col-xl-3">

                    
                    <div class="card">
                        <div class="card-body">

                            <form action="/projects/{{$project->id}}/documents" method="POST" enctype="multipart/form-data">
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

                                <button type="submit" class="btn btn-primary">Upload</button>

                            </form>

                        </div>
                    </div>
                </div>                

                <div class="col-12 col-xl-9">
                    <div class="card">
                      
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($documents as $document)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $document->created_at }}</td>
                                    <td><a href="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{ $document->document }}">{{ $document->name }}</a></td>
                                    <td>{{ ucfirst($document->category) }}</td>
                                </tr>
                                @endforeach                                
                              



                            </tbody>
                        </table>
                    </div>
                </div>

    

            </div>

            <div class="row">       
                
                <div class="header">
                    <h3>
                        Project Meeting
                    </h3>
                </div>                               

                <div class="col-12">
                    <div class="card">
                      
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($meetings as $meeting)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $meeting->name }}</td>
                                </tr>
                                @endforeach                                
                              



                            </tbody>
                        </table>
                    </div>
                </div>

    

            </div>              

            <div class="row">

                <div class="header">
                    <h3>
                        Project Team Members
                    </h3>
                </div>

                <div class="col-12 col-xl-3">
                    <div class="card">
                        <div class="card-body">

                            <form action="/projects/{{$project->id}}/members" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label w-100">Name</label>
                                    <select class="form-control mb-3" name="user_id">
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>                                
                                </div>      
                                
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control mb-3" name="category">
                                        <option value="analyst">Analyst</option>
                                        <option value="developer">Developer</option>
                                        <option value="project">Project</option>
                                    </select>
                                </div>                                

    

                                <button type="submit" class="btn btn-primary">Add</button>

                            </form>

                        </div>
                    </div>
                </div>                

                <div class="col-12 col-xl-9">
                    <div class="card">
                      
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($members as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($member->user->name) }}</td>
                                    <td>{{ ucfirst($member->category) }}</td>
                                </tr>
                                @endforeach                                
                              



                            </tbody>
                        </table>
                    </div>
                </div>

    

            </div>      
            

            <div class="row">

                <div class="header">
                    <h3>
                        Project Payments
                    </h3>
                </div>

                <div class="col-12 col-xl-3">
                    <div class="card">
                        <div class="card-body">

                            <form action="/projects/{{$project->id}}/payments" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label w-100">Name</label>   
                                    <input type="text" name="name" class="form-control">                                                            
                                </div>                                    

                                <div class="mb-3">
                                    <label class="form-label w-100">Amount</label>   
                                    <input type="number" name="amount" class="form-control" step="0.01" min="1.00">                                                            
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
                    </div>
                </div>                

                <div class="col-12 col-xl-9">
                    <div class="card">
                      
                        <table class="table">
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


                                @foreach($payments as $payment)
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
                    </div>
                </div>

    

            </div>               


        </div>
    </main>
@endsection

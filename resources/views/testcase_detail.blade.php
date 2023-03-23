@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Testcase
                </h1>

            </div>

            <div class="row">
                <div class="col-5">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Testcase Summary</h5>
                        </div>

                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><b>ID</b></td>
                                    <td>{{ $testcase->id }}</td>
                                </tr>
                                <tr>
                                    <td><b>Name</b></td>
                                    <td>{{ $testcase->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>User Category</b></td>
                                    <td>{{ $testcase->category }}</td>
                                </tr>                                
                                <tr>
                                    <td><b>Requirement ID</b></td>
                                    <td>
                                        @if ($testcase->project_requirement_id)
                                            {{ $testcase->project_requirement_id }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </div>

                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                        <h1>Requirement Remarks</h1>
                        @if ($testcase->project_requirement_id)
                            {{ $testcase->project_requirement->remarks }}
                        @else
                            -
                        @endif
                        <h1>Testcase Remarks</h1>
                        <x-markdown>
                            {{ $testcase->remarks }}
                        </x-markdown>
                        </div>
                    </div>

                </div>

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Test Case Executions</h5>
                        </div>

                        <div class="card-body">

                            
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>User</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @forelse ($testcase->executions as $execution)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td> 
                                                <td>{{ $execution->user->name }}</td>                       
                                                <td>{{ $execution->status }}</td>
                                                <td>{{ $execution->remarks }}</td>
                                                <td>{{ $execution->created_at }}</td>                       
                                            </tr>
                                        @empty
                                        <tr>
                                            <td>-</td> 
                                            <td>-</td>    
                                            <td>-</td>                       
                                            <td>-</td>                       
                                            <td>-</td>  
                                        </tr>                                        
                                        @endforelse

                                    </tbody>
                                </table>


                   
                        </div>


                    </div>


                </div>        
                
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Test Case Executions</h5>
                        </div>

                        <div class="card-body">

                                <form action="/testcases/{{ $testcase->id }}/execute" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Remarks</label>
                                        <textarea class="form-control" rows="5" name="remarks" placeholder="Textarea"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label w-100">Attachment</label>
                                        <input type="file" name="attachment">
                                    </div>

                                    
                                        <button type="submit" name="status" value="Pass"
                                            class="btn btn-success">Pass</button>
                                        <button type="submit" name="status" value="Pass With Conditions"
                                            class="btn btn-info">Pass With Conditions</button>
                                        <button type="submit" name="status" value="Fail" class="btn btn-danger">Fail</button>

                                </form>

                        </div>


                    </div>


                </div>                  

                @if(Auth::user()->organisation_id == 1)
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Update Test Case</h5>
                            </div>

                            <div class="card-body">
                                <form action="/testcases/{{ $testcase->id }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ $testcase->name }}">
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <input type="text" class="form-control" name="category" placeholder="Category"
                                            value="{{ $testcase->category }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Remarks</label>
                                        <textarea class="form-control" id="my-text-area" rows="5" name="remarks" placeholder="Textarea">{{ $testcase->remarks }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Test Case</button>

                                </form>
                            </div>


                        </div>


                    </div>
                @endif
            </div>

        </div>
    </main>
@endsection

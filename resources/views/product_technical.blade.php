@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    {{ $product->name }}
                </h1>

            </div>


            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="tab tab-vertical">
                            <ul class="nav nav-tabs" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" href="#vertical-icon-tab-0" data-bs-toggle="tab"
                                        role="tab" aria-selected="true">
                                        Summary
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-1" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Use Case
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-2" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Datatable
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-3" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Method
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-4" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        View
                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="vertical-icon-tab-0" role="tabpanel">
                                    <h4 class="tab-title">Summary</h4>

                                    - - - <br/>
                                    actors: {{ count($actors) }} <br/>
                                    usecases: {{ count($usecases) }} <br/>
                                    tables: {{ count($tables) }} <br/>
                                    attributes: {{ count($attributes) }} <br/>
                                    methods: {{ count($methods) }} <br/>
                                    views: {{ count($views) }} <br/>
                                </div>

                                <div class="tab-pane" id="vertical-icon-tab-1" role="tabpanel">
                                    <h4 class="tab-title">Actor & Use Case</h4>

                                    @if(count($actors)>0)
                                    <table class="table table-striped table-sm mb-3">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Actor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($actors as $actor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>                                    
                                                <td>{{ $actor->name }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>
                                    @endif

                                    <form action="/products/{{ $product->id }}/actors" method="POST" class="mb-3">
                                        @csrf


                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>


                                        <button type="submit" class="btn btn-primary">Create Actor</button>
                                    </form>

                                    @if(count($usecases)>0)
                                    <table class="table table-striped table-sm mb-3">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Actor</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($usecases as $usecase)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>                                    
                                                <td>{{ $usecase->actor->name }}</td>
                                                <td>{{ $usecase->name }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>
                                    @endif    
                                    
                                    <form action="/products/{{ $product->id }}/usecases" method="POST" class="mb-3">
                                        @csrf


                                        <div class="mb-3">
                                            <label class="form-label">Actor</label>
                                            <select class="form-control mb-3" name="product_actor_id">
                                                @foreach($actors as $actor)
                                                    <option value="{{$actor->id}}">{{$actor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>                                        


                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>


                                        <button type="submit" class="btn btn-primary">Create Usecase</button>
                                    </form>                                    

                                </div>

                                <div class="tab-pane" id="vertical-icon-tab-2" role="tabpanel">
                                    <h4 class="tab-title">Data Table & Attributes</h4>

                                    @if(count($tables)>0)
                                    <table class="table table-striped table-sm mb-3">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Attributes Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($tables as $table)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>                                    
                                                <td>{{ $table->name }}</td>
                                                <td>{{ count($table->attributes) + 3 }} ({{ count($table->attributes) }})</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>
                                    @endif

                                    <form action="/products/{{ $product->id }}/tables" method="POST" class="mb-3">
                                        @csrf


                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">DB Name</label>
                                            <input type="text" class="form-control" name="table_name">
                                        </div>                                        


                                        <button type="submit" class="btn btn-primary">Create Table</button>
                                    </form>

                                    @if(count($attributes)>0)
                                    <table class="table table-striped table-sm mb-3">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Table</th>
                                                <th>Name</th>
                                                <th>Datatype</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($attributes as $attribute)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>                                    
                                                <td>{{ $attribute->table->name }}</td>
                                                <td>{{ $attribute->name }}</td>
                                                <td>{{ $attribute->datatype }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>
                                    @endif    
                                    
                                    <form action="/products/{{ $product->id }}/attributes" method="POST" class="mb-3">
                                        @csrf


                                        <div class="mb-3">
                                            <label class="form-label">Table</label>
                                            <select class="form-control mb-3" name="product_table_id">
                                                @foreach($tables as $table)
                                                    <option value="{{$table->id}}">{{$table->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                                                          


                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Datatype</label>
                                            <select class="form-control mb-3" name="datatype">
                                                <option value="text">Text</option>
                                            </select>
                                        </div>       
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Default</label>
                                            <input type="text" class="form-control" name="default">
                                        </div>   
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Nullable</label>
                                            <select class="form-control mb-3" name="nullable">
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>   
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Foreign Key</label>
                                            <input type="number" class="form-control" name="foreign_key">
                                        </div>                                         


                                        <button type="submit" class="btn btn-primary">Create Table Attribute</button>
                                    </form>                                     
                                </div>

                                <div class="tab-pane" id="vertical-icon-tab-3" role="tabpanel">
                                    <h4 class="tab-title">Method</h4>

                                    @if(count($tables)>0)
                                    <table class="table table-striped table-sm mb-3">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($methods as $method)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>                                    
                                                <td>{{ $method->name }}</td>
                                                <td>-</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>
                                    @endif

                                    <form action="/products/{{ $product->id }}/methods" method="POST" class="mb-3">
                                        @csrf


                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Platform</label>
                                            <select class="form-control mb-3" name="platform">
                                                <option value="api">API</option>
                                                <option value="mobile">Mobile</option>
                                                <option value="web">Web</option>
                                            </select>
                                        </div>                    
                                        
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Input</label>
                                            <textarea class="form-control" id="my-text-area" rows="5" name="inputs" placeholder="Textarea"></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Output</label>
                                            <textarea class="form-control" id="my-text-area" rows="5" name="outputs" placeholder="Textarea"></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Calculation</label>
                                            <textarea class="form-control" id="my-text-area" rows="5" name="calculations" placeholder="Textarea"></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Remarks</label>
                                            <textarea class="form-control" id="my-text-area" rows="5" name="emarks" placeholder="Textarea"></textarea>
                                        </div>                                        


                                        <button type="submit" class="btn btn-primary">Create Method</button>
                                    </form>                                    
                                </div>

                                <div class="tab-pane" id="vertical-icon-tab-4" role="tabpanel">
                                    <h4 class="tab-title">View</h4>

                                    <form action="/products/{{ $product->id }}/views" method="POST">
                                        @csrf


                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Platform</label>
                                            <select class="form-control mb-3" name="platform">
                                                <option value="api">API</option>
                                                <option value="mobile">Mobile</option>
                                                <option value="web">Web</option>
                                            </select>
                                        </div>     

                                        <button type="submit" class="btn btn-primary">Create View</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
            </div>







        </div>
    </main>
@endsection

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
                        <div class="card-body">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div>                

            </div>                        
   
            
            <div class="row">
                <div class="col-12">
                    <div class="tab tab-vertical">
                        <ul class="nav nav-tabs" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" href="#vertical-icon-tab-0" data-bs-toggle="tab" role="tab"
                                    aria-selected="true">
                                    Summary
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#vertical-icon-tab-1" data-bs-toggle="tab" role="tab"
                                    aria-selected="false">
                                    Sales
                                </a>
                            </li>     

                            <li class="nav-item">
                                <a class="nav-link" href="#vertical-icon-tab-2" data-bs-toggle="tab" role="tab"
                                    aria-selected="false">
                                    Requirement
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#vertical-icon-tab-3" data-bs-toggle="tab" role="tab"
                                    aria-selected="false">
                                    Support
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#vertical-icon-tab-4" data-bs-toggle="tab" role="tab"
                                    aria-selected="false">
                                    Settings
                                </a>
                            </li>                            
                                                                                                                                                     
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="vertical-icon-tab-0" role="tabpanel">
                                <h4 class="tab-title">Summary</h4>      
                                
                                daily, weekly, monthly: sales USD, number of users<br/>
                            </div>

                            <div class="tab-pane" id="vertical-icon-tab-1" role="tabpanel">
                                <h4 class="tab-title">Sales</h4>                            
                            </div>
                            
                            <div class="tab-pane" id="vertical-icon-tab-2" role="tabpanel">
                                <h4 class="tab-title">Requirement</h4>                            
                            </div>
                            
                            <div class="tab-pane" id="vertical-icon-tab-3" role="tabpanel">
                                <h4 class="tab-title">Support</h4>                            
                            </div>           
                            
                            <div class="tab-pane" id="vertical-icon-tab-4" role="tabpanel">
                                <h4 class="tab-title">Settings</h4>        
                                
                                <form action="/products/{{$product->id}}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
    
    
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                    </div>
    
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="5" name="description" placeholder="Textarea">{{ $product->description }}</textarea>
                                    </div>                                
    
                                    <div class="mb-3">
                                        <label class="form-label">Web link</label>
                                        <input type="text" class="form-control" name="web_link" value="{{ $product->web_link }}">
                                    </div>   
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Prototype link</label>
                                        <input type="text" class="form-control" name="prototype_link" value="{{ $product->prototype_link }}">
                                    </div>    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Web Repo</label>
                                        <input type="text" class="form-control" name="web_repo" value="{{ $product->web_repo }}">
                                    </div>   
                                    
                                    <div class="mb-3">
                                        <label class="form-label">App Repo</label>
                                        <input type="text" class="form-control" name="app_repo" value="{{ $product->app_repo }}">
                                    </div>                                  
    
                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </form>                                
                            </div>                              

                                                                                                                                                                        
                        </div>
                    </div>
                </div>
            </div>
            
            





        </div>
    </main>
@endsection

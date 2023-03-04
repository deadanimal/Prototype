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
                        <div class="card-header">
                            <h5 class="card-title">Update Product</h5>
                        </div>
                        <div class="card-body">
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

                                <button type="submit" class="btn btn-primary">Create Product</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>




        </div>
    </main>
@endsection

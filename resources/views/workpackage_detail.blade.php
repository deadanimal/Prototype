@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Work Package -  {{$wp->name}}
                </h1>
                <p class="header-subtitle">{{$wp->status}}</p>                

            </div>                          

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">- - -</h5>
                        </div>

                        <div class="card-body">
                            {{$wp}}
                        </div>
                     

                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Work Package</h5>                            
                        </div>

                        <div class="card-body">
                            - - -
                        </div>
                     
                    </div>
                </div>
                
                @foreach($wp->reviews as $review)
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">- - - </h5>
                            <h6 class="card-subtitle text-muted">- - -</h6>
                        </div>

                        <div class="card-body">
                            - - -
                        </div>
                     

                    </div>
                </div>
                @endforeach

          


            </div>


        </div>
    </main>
@endsection

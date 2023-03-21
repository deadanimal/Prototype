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
                <div class="col">
                    {{$testcase}}
                </div>
            </div>
          
        </div>
    </main>


@endsection

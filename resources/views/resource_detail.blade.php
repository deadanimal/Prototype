@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-12">
                    <div class="card">
                      
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hourly Rate</td>
                                    <td>
                                        @if($resource->currency == 'myr')
                                        RM
                                        @else
                                        USD 
                                        @endif

                                        {{$resource->hourly_rate}}</td>
                                </tr>     
                                <tr>
                                    <td>Total Accumulated Pay</td>
                                    <td>-</td>
                                </tr> 
                                <tr>
                                    <td>Monthly Pay Assigned</td>
                                    <td>-</td>
                                </tr>   
                                <tr>
                                    <td>Monthly Pay In Review</td>
                                    <td>-</td>
                                </tr>      
                                <tr>
                                    <td>Monthly Pay Approved</td>
                                    <td>-</td>
                                </tr>                                                                                                                                                           


                            </tbody>
                        </table>
                    </div>
                </div>
            
    

            </div>


        </div>
    </main>
@endsection

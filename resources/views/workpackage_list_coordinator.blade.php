@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Work Package
                </h1>
                <h6 class="header-subtitle text-white">See WPs assigned to self? Click 
                    <a href="/workpackages/assigned">here</a></h6>                

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
                                        Assigned WP
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-2" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Approved WP
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-3" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        In Review WP
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-4" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Question WP
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-5" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        Delayed WP
                                    </a>
                                </li>                                                                                                     
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-10" data-bs-toggle="tab" role="tab"
                                        aria-selected="false">
                                        All WP
                                    </a>
                                </li> 
    
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="vertical-icon-tab-0" role="tabpanel">
                                    <h4 class="tab-title">Summary</h4>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
        
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

                                <div class="tab-pane" id="vertical-icon-tab-1" role="tabpanel">
                                    <h4 class="tab-title">Assigned Work Package</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Estimate Delivery</th>
                                                <th>Project</th>
                                                <th>Resource</th>
                                                <th>Type</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($assigned_wps as $wp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="/workpackages/{{$wp->id}}">{{ $wp->name }}</a></td>
                                                <td>{{ $wp->estimate_delivery }}</td>
                                                <td>
                                                    @if($wp->project_id)
                                                        {{$wp->project->name}}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($wp->resource_id)
                                                        {{$wp->resource->user->name}}
                                                    @else
                                                    -
                                                    @endif                                        
                                                </td>
                                                <td>{{ $wp->package_type }}</td>
                                                <td>{{ $wp->package_level }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table> 
                                </div>    
                                
                                <div class="tab-pane" id="vertical-icon-tab-2" role="tabpanel">
                                    <h4 class="tab-title">Approved Work Package</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Estimate Delivery</th>
                                                <th>Project</th>
                                                <th>Resource</th>
                                                <th>Type</th>
                                                <th>Level</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($approved_wps as $wp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="/workpackages/{{$wp->id}}">{{ $wp->name }}</a></td>
                                                <td>{{ $wp->estimate_delivery }}</td>
                                                <td>
                                                    @if($wp->project_id)
                                                        {{$wp->project->name}}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($wp->resource_id)
                                                        {{$wp->resource->user->name}}
                                                    @else
                                                    -
                                                    @endif                                        
                                                </td>
                                                <td>{{ $wp->package_type }}</td>
                                                <td>{{ $wp->package_level }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>                                     

                                </div>  
                                
                                <div class="tab-pane" id="vertical-icon-tab-3" role="tabpanel">
                                    <h4 class="tab-title">In Review Work Package</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Estimate Delivery</th>
                                                <th>Project</th>
                                                <th>Resource</th>
                                                <th>Type</th>
                                                <th>Level</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($inreview_wps as $wp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="/workpackages/{{$wp->id}}">{{ $wp->name }}</a></td>
                                                <td>{{ $wp->estimate_delivery }}</td>
                                                <td>
                                                    @if($wp->project_id)
                                                        {{$wp->project->name}}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($wp->resource_id)
                                                        {{$wp->resource->user->name}}
                                                    @else
                                                    -
                                                    @endif                                        
                                                </td>
                                                <td>{{ $wp->package_type }}</td>
                                                <td>{{ $wp->package_level }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>                                     

                                </div>            
                                
                                <div class="tab-pane" id="vertical-icon-tab-4" role="tabpanel">
                                    <h4 class="tab-title">Question Work Package</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Estimate Delivery</th>
                                                <th>Project</th>
                                                <th>Resource</th>
                                                <th>Type</th>
                                                <th>Level</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($question_wps as $wp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="/workpackages/{{$wp->id}}">{{ $wp->name }}</a></td>
                                                <td>{{ $wp->estimate_delivery }}</td>
                                                <td>
                                                    @if($wp->project_id)
                                                        {{$wp->project->name}}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($wp->resource_id)
                                                        {{$wp->resource->user->name}}
                                                    @else
                                                    -
                                                    @endif                                        
                                                </td>
                                                <td>{{ $wp->package_type }}</td>
                                                <td>{{ $wp->package_level }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>                                     

                                </div>      
                                
                                <div class="tab-pane" id="vertical-icon-tab-5" role="tabpanel">
                                    <h4 class="tab-title">Delayed Work Package</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Estimate Delivery</th>
                                                <th>Project</th>
                                                <th>Resource</th>
                                                <th>Type</th>
                                                <th>Level</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($delayed_wps as $wp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="/workpackages/{{$wp->id}}">{{ $wp->name }}</a></td>
                                                <td>{{ $wp->estimate_delivery }}</td>
                                                <td>
                                                    @if($wp->project_id)
                                                        {{$wp->project->name}}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($wp->resource_id)
                                                        {{$wp->resource->user->name}}
                                                    @else
                                                    -
                                                    @endif                                        
                                                </td>
                                                <td>{{ $wp->package_type }}</td>
                                                <td>{{ $wp->package_level }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>                                     

                                </div>                                  
                                
                                <div class="tab-pane" id="vertical-icon-tab-10" role="tabpanel">
                                    <h4 class="tab-title">All Work Package</h4>

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Estimate Delivery</th>
                                                <th>Project</th>
                                                <th>Resource</th>
                                                <th>Type</th>
                                                <th>Level</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
            
                                            @foreach($all_wps as $wp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="/workpackages/{{$wp->id}}">{{ $wp->name }}</a></td>
                                                <td>{{ $wp->estimate_delivery }}</td>
                                                <td>
                                                    @if($wp->project_id)
                                                        {{$wp->project->name}}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($wp->resource_id)
                                                        {{$wp->resource->user->name}}
                                                    @else
                                                    -
                                                    @endif                                        
                                                </td>
                                                <td>{{ $wp->package_type }}</td>
                                                <td>{{ $wp->package_level }}</td>
                                            </tr>
                                            @endforeach
            
                                        </tbody>
                                    </table>                                     

                                </div>                                     


                            </div>
                        </div>                        


                    </div>
                </div>                    



            </div>            


        </div>
    </main>

    <script>
        function markdown_editor() {
            const easyMDE = new EasyMDE({
                element: document.getElementById('my-text-area')
            });

        }


        markdown_editor();
    </script>        
@endsection

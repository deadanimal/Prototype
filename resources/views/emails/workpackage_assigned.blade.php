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
            <td>{{ $wp->id }}</td>
        </tr>
        <tr>
            <td><b>Name</b></td>
            <td>{{ $wp->name }}</td>
        </tr>    
        <tr>
            <td><b>Status</b></td>
            <td>{{ $wp->status }}</td>
        </tr>      
        <tr>
            <td><b>Client</b></td>
            <td>{{ $wp->project->organisation->name }}</td>
        </tr>    
        <tr>
            <td><b>Project</b></td>
            <td>{{ $wp->project->name }}</td>
        </tr>                                                                                                                         

    </tbody>
</table>                        

<div class="card-body">



    Estimate Delivery: {{ $wp->estimate_delivery }} <br/>
    Package Type: {{ $wp->package_type }} <br/>
    Package level: {{ $wp->package_level }} <br/>
    Resource: 
    @if($wp->resource_id)
        {{ $wp->resource->user->name }}
    @else
        -
    @endif
     <br/>
    Reviewer: 
    @if($wp->reviewer_id)
        {{ $wp->reviewer->user->name }}
    @else
        -
    @endif
    <br/>
    Coordinator: {{ $wp->coordinator->name }} <br/>
    Created: {{ $wp->created_at }} <br/>
</div>
Hello, there is an update on Work Package: {{ $wp->id }}. Please respond to the Work Package update if needed.

<h3>Work Package Review</h3>
<table class="table table-striped table-sm">
    <tbody>

        <tr>
            <td><b>Status</b></td>
            <td>{{ $review->status }}</td>
        </tr>
        <tr>
            <td><b>Remarks</b></td>
            <td>{{ $review->remarks }}</td>
        </tr> 
        <tr>
            <td><b>Update</b></td>
            <td>{{ $review->resource->user->name  }}</td>
        </tr>    
        <tr>
            <td><b>Created At</b></td>
            <td>{{ $review->created_at  }}</td>
        </tr>                 
    </tbody>
</table>

<h3>Work Package Detail</h3>
<table class="table table-striped table-sm">
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
        <tr>
            <td><b>Resource</b></td>
            <td>{{ $wp->resource->user->name }}</td>
        </tr>
        <tr>
            <td><b>Reviewer</b></td>
            <td>{{ $wp->reviewer->user->name }}</td>
        </tr>            
        <tr>
            <td><b>Coordinator</b></td>
            <td>{{ $wp->coordinator->name }} </td>
        </tr>     
        <tr>
            <td><b>Estimate Delivery</b></td>
            <td>{{ $wp->estimate_delivery }} </td>
        </tr>     
        <tr>
            <td><b>Package Type</b></td>
            <td>{{ $wp->package_type  }} </td>
        </tr> 
        <tr>
            <td><b>Package Level</b></td>
            <td>{{ $wp->package_level  }} </td>
        </tr>                        
        <tr>
            <td><b>Created</b></td>
            <td>{{ $wp->created_at }} </td>
        </tr>             

    </tbody>
</table>                        

<div class="card-body my-3">
    <b>Remarks: </b><br/>
    {{ $wp->remarks }} <br/>
</div>

<div class="my-3">
    <a href="https://prototype.com.my/workpackages/{{ $wp->id }}">View Work Package</a>
</div>


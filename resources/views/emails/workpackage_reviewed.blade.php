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
    </tbody>
</table>

<h3>Work Package Detail</h3>
<table class="table table-striped table-sm">
    <tbody>

        <tr>
            <td><b>ID</b></td>
            <td><a href="https://prototype.com.my/workpackages/{{ $wp->id }}">{{ $wp->id }}</a></td>
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

<div class="card-body">
    Remarks: {{ $wp->remarks }} <br/>
</div>

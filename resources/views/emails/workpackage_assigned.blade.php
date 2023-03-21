Hello, there is an assignment on Work Package: {{ $wp->id }}. If you have any questions, please ask in the Work Package or create a Ticket.

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
            <td>
                @if($wp->resource_id)
                    {{ $wp->resource->user->name }}
                @else
                -  
                @endif
            </td>
        </tr>
        <tr>
            <td><b>Reviewer</b></td>
            <td>
                @if($wp->reviewer_id)
                    {{ $wp->reviewer->user->name }}
                @else
                -  
                @endif                                
            </td>
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

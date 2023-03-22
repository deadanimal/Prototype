
Hello {{$user->name}}, you have been added as a user for the project and work monitoring system. You can access it here:
<a href="https://prototype.com.my/dashboard">https://prototype.com.my/dashboard</a>. If you have any questions on how to use it,
please email us at pmo@pipeline.com.my.

<table class="table table-striped table-sm">
    <tbody>

        <tr>
            <td><b>Name</b></td>
            <td>{{$user->name}}</td>
        </tr> 
        <tr>
            <td><b>Organisation</b></td>
            <td>{{$user->organisation->name}}</td>
        </tr>                                                                  
        <tr>
            <td><b>Email</b></td>
            <td>{{$user->email}}</td>
        </tr>   
        <tr>
            <td><b>Password</b></td>
            <td>{{$password}}</td>
        </tr>                    

    </tbody>
</table>               

<h1><i>Please change the password after first login!</i></h1>


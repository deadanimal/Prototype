@extends('layout-auth')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    {{$resource->user->name}}
                </h1>
                <p class="header-subtitle">- - </p>

            </div>            

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            
    

            </div>


        </div>
    </main>

    <script>

var wps = @json($wps);
console.log(wps)
var events = []
wps.forEach(element => {

    var color = 'blue';
    
    if (element['status'] == 'Delayed' || element['status'] == 'Rejected') {
        color = 'red';
    }

    if (element['status'] == 'Work Package Approved') {
        color = 'green';
    }

    if (element['status'] == 'Has Problem' || element['status'] == 'Question Answered') {
        color = 'orange';
    }    


    var event = {
        title: element['name'],
        description: '(' + element['status'] + ') ' ,
        start: element['estimate_delivery'],
        url: '/workpackages/' + element['id'],
        color: color
    }


    events.push(event)            
});


document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    initialDate: '2023-03-01',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: events
  });

  calendar.render();
});        
    </script>
@endsection

@extends('layouts.admin.main')

@section('external_css')
    <link rel="stylesheet" href="{{asset('css/main.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-interaction/main.min.html')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-daygrid/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-timegrid/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar-bootstrap/main.min.css')}}"> --}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Project Calendar</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Calendar</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('external_js')
    <script src="{{asset('js/main.min.js')}}"></script>
    <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    
    
    {{-- <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-daygrid/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-timegrid/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-interaction/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-bootstrap/main.min.js')}}"></script> --}}
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'UTC',
      initialView: 'resourceTimelineMonth',
      aspectRatio: 1.5,
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
      },
      editable: false,
      eventDidMount: function(info) {
        var tooltip = new Tooltip(info.el, {
          title: info.event.extendedProps.title,
          placement: 'top',
          trigger: 'hover',
          container: 'body'
        });
      },
      resourceAreaHeaderContent: 'Employees',
      resources: '/api/projects/calendar/resource',
      events: '/api/projects/calendar/events'
    });

    calendar.render();
  });

    // $(function () {
    //   /* initialize the calendar
    //    -----------------------------------------------------------------*/
    //   //Date for the calendar events (dummy data)
    //   var date = new Date()
    //   var d    = date.getDate(),
    //       m    = date.getMonth(),
    //       y    = date.getFullYear()
  
    //   var Calendar = FullCalendar.Calendar;
    //   var Draggable = FullCalendarInteraction.Draggable;
    //   var calendarEl = document.getElementById('calendar');
  
    //   var calendar = new Calendar(calendarEl, {
    //     plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
    //     header    : {
    //       left  : 'prev,next today',
    //       center: 'title',
    //       right : 'dayGridMonth,timeGridWeek,timeGridDay'
    //     },
    //     //Random default events
    //     events    : [
    //       {
    //         title          : 'All Day Event',
    //         start          : new Date(y, m, 1),
    //         backgroundColor: '#f56954', //red
    //         borderColor    : '#f56954', //red
    //         imageUrl: "<img src = 'http://localhost:3067/Images/default_thumbnail.jpg' style='width:24px;height:24px'/>"
    //       },
    //       {
    //         title          : 'Long Event',
    //         start          : new Date(y, m, d - 5),
    //         end            : new Date(y, m, d - 2),
    //         backgroundColor: '#f39c12', //yellow
    //         borderColor    : '#f39c12' //yellow
    //       },
    //       {
    //         title          : 'Meeting',
    //         start          : new Date(y, m, d, 10, 30),
    //         allDay         : false,
    //         backgroundColor: '#0073b7', //Blue
    //         borderColor    : '#0073b7' //Blue
    //       },
    //       {
    //         title          : 'Lunch',
    //         start          : new Date(y, m, d, 12, 0),
    //         end            : new Date(y, m, d, 14, 0),
    //         allDay         : false,
    //         backgroundColor: '#00c0ef', //Info (aqua)
    //         borderColor    : '#00c0ef' //Info (aqua)
    //       },
    //       {
    //         title          : 'Birthday Party',
    //         start          : new Date(y, m, d + 1, 19, 0),
    //         end            : new Date(y, m, d + 1, 22, 30),
    //         allDay         : false,
    //         backgroundColor: '#00a65a', //Success (green)
    //         borderColor    : '#00a65a' //Success (green)
    //       },
    //       {
    //         title          : 'Click for Google',
    //         start          : new Date(y, m, 28),
    //         end            : new Date(y, m, 29),
    //         url            : 'http://google.com/',
    //         backgroundColor: '#3c8dbc', //Primary (light-blue)
    //         borderColor    : '#3c8dbc' //Primary (light-blue)
    //       }
    //     ],
    //     eventRender: function(event){
    //       console.log(event.el);
    //       if (event.event.extendedProps.imageUrl) 
    //       {
    //           if ($(event.el).find('span.fc-time').length){
    //             $(event.el).find('span.fc-time').before($(event.event.extendedProps.imageUrl));
    //           } else {
    //             console.log('test');
    //             $(event.el).find('span.fc-title').before($(event.event.extendedProps.imageUrl));
    //           }
    //       }  
    //     },
    //     editable  : false,
    //     droppable : false, // this allows things to be dropped onto the calendar !!! 
    //   });
  
    //   calendar.render();
    //   // $('#calendar').fullCalendar()
  
    //   /* ADDING EVENTS */
    //   var currColor = '#3c8dbc' //Red by default
    //   //Color chooser button
    //   var colorChooser = $('#color-chooser-btn')
    //   $('#color-chooser > li > a').click(function (e) {
    //     e.preventDefault()
    //     //Save color
    //     currColor = $(this).css('color')
    //     //Add color effect to button
    //     $('#add-new-event').css({
    //       'background-color': currColor,
    //       'border-color'    : currColor
    //     })
    //   })
    //   $('#add-new-event').click(function (e) {
    //     e.preventDefault()
    //     //Get value and make sure it is not null
    //     var val = $('#new-event').val()
    //     if (val.length == 0) {
    //       return
    //     }
  
    //     //Create events
    //     var event = $('<div />')
    //     event.css({
    //       'background-color': currColor,
    //       'border-color'    : currColor,
    //       'color'           : '#fff'
    //     }).addClass('external-event')
    //     event.html(val)
    //     $('#external-events').prepend(event)
  
    //     //Add draggable funtionality
    //     ini_events(event)
  
    //     //Remove event from text input
    //     $('#new-event').val('')
    //   })
    // })
  </script>
@endsection
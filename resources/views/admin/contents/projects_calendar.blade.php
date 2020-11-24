@extends('layouts.admin.main')

@section('external_css')
    <link rel="stylesheet" href="{{asset('css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
          <div class="col-md-12">
            <div class="d-inline-block float-right">
                <a data-toggle="modal" data-target="#createTaskModal" href="javascript:void(0)"class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> Create Task</a>
            </div>
          </div>
        </div>
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
@section('modals')
<div class="modal fade" id="createTaskModal">
  <div class="modal-dialog modal-lg">
      <form class="form-add-task" method="POST" action="{{route('tasks.store')}}">
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  Add Task
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-5">
                          <div class="form-group">
                              <label>Title:</label>
                              <input type="text" name="title" class="form-control" required>
                          </div>
                      </div>
                      <div class="col-md-7">
                          <div class="form-group">
                              <label>Project:</label>
                              <select class="form-control select2bs4" name="project_id" style="width: 100%;">
                                  @foreach($projects as $project)
                                      <option value="{{$project->ProjeID}}">{{$project->ProjeBASLIK}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Description:</label>
                              <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Assign to:</label>
                              <select class="form-control select2bs4" name="assign_to[]" multiple="multiple" data-placeholder="Select an employee" required>
                                  @foreach($employees as $employee)
                                      <option value="{{$employee->id}}">{{$employee->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Status:</label>
                              <select class="form-control" name="status">
                                  <option value="incomplete" selected>Incomplete</option>
                                  <option value="completed">Completed</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-4">
                          <label>Start Date:</label>
                          <input type="date" name="start_date" class="form-control" required>
                      </div>
                      <div class="col-md-4">
                          <label>Due Date: </label>
                          <input type="date" name="due_date" class="form-control" required>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Priority:</label>
                              <select class="form-control" name="priority">
                                  <option value="1">High</option>
                                  <option value="2" selected>Medium</option>
                                  <option value="3">Low</option>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <a href="{{route('tasks.index')}}" type="button" class="btn btn-default">Close</a>
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </div>
      </form>
  </div>
  <!-- /.modal-content -->
</div>
@endsection
@section('external_js')
    <script src="{{asset('js/main.min.js')}}"></script>
    <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    
    {{-- <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-daygrid/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-timegrid/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-interaction/main.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar-bootstrap/main.min.js')}}"></script> --}}
@endsection

@section('scripts')
<script>
  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  $('.form-add-task').on('submit', function(e){
      e.preventDefault();

      $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: $(this).serialize(),
          success: function(resp){
              if(resp.success){
                  Toast.fire({
                      icon: 'success',
                      title: resp.msg,
                      showConfirmButton: false,
                  });

                  setTimeout(function() { location.reload(); }, 1000)
              }
          }
      })
  }); 

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
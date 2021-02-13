@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" href="{{asset('css/main.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/calendars/fullcalendar.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">

@endsection
@section('external_css')
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/pages/app-calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection
@section('content')
<section class="app-tickets-list">
    <div class="card">
        <div class="card-body p-0">
            <!-- THE CALENDAR -->
            <div id="calendar"></div>
        </div>
        <!-- /.card-body -->
      </div>
</section>
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
{{-- <script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/calendar/fullcalendar.min.js')}}"></script> --}}
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('js/main.min.js')}}"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    {{-- <script src="{{asset('js/main.min.js')}}"></script>

    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script> --}}
@endsection

@section('scripts')
  <!-- BEGIN: Page JS-->
  <script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-project-calendar.js')}}"></script>
  <!-- END: Page JS-->
<script>

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

//   document.addEventListener('DOMContentLoaded', function() {
//     var calendarEl = document.getElementById('calendar');

//     var calendar = new FullCalendar.Calendar(calendarEl, {
//       timeZone: 'UTC',
//       initialView: 'resourceTimelineMonth',
//       aspectRatio: 1.5,
//       headerToolbar: {
//         left: 'prev,next',
//         center: 'title',
//         right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
//       },
//       editable: false,
//       eventDidMount: function(info) {
//         var tooltip = new Tooltip(info.el, {
//           title: info.event.extendedProps.title,
//           placement: 'top',
//           trigger: 'hover',
//           container: 'body'
//         });
//       },
//       resourceAreaHeaderContent: 'Employees',
//       resources: '/api/projects/calendar/resource',
//       events: '/api/projects/calendar/events'
//     });

//     calendar.render();
//   });
  </script>
@endsection
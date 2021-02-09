<?php 
use App\Helpers\Language;
use App\Helpers\System;
$lang = new Language;
$system = new System;
?>
@extends('layouts.admin.main')

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $project->title])
</div>
@endsection
@section('content')
<section class="app-project-details">
    <div class="card card-info card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
          <ul class="nav nav-tabs" id="project-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="project-overview-tabs" data-toggle="pill" href="#project-overview" role="tab" aria-controls="project-tabs-overview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="project-members-tabs" data-toggle="pill" href="#project-members" role="tab" aria-controls="project-tabs-members" aria-selected="true">Members</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="project-tasks-tabs" data-toggle="pill" href="#project-tasks" role="tab" aria-controls="project-tabs-tasks" aria-selected="true">Tasks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="project-activity-tabs" data-toggle="pill" href="#project-activity" role="tab" aria-controls="project-tabs-activity" aria-selected="true">Activity</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="project-timelogs-tabs" data-toggle="pill" href="#project-timelogs" role="tab" aria-controls="project-tabs-timelogs" aria-selected="true">Timelogs</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="project-tabs-content">
            <div class="tab-pane fade active show" id="project-overview" role="tabpanel" aria-labelledby="#project-tabs-overview">
                <div class="row mt-2">
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="media">
                            <div class="avatar bg-light-primary mr-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0">0</h4>
                                <p class="card-text font-small-3 mb-0">Budget</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="media">
                            <div class="avatar bg-light-info mr-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0">0</h4>
                                <p class="card-text font-small-3 mb-0">Expenses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                        <div class="media">
                            <div class="avatar bg-light-danger mr-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0">0</h4>
                                <p class="card-text font-small-3 mb-0">Earnings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="media">
                            <div class="avatar bg-light-success mr-2">
                                <div class="avatar-content">
                                    <i data-feather="clock" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0">{{\App\Watches::where('Tarih', '>=', Carbon\Carbon::create(date('Y'), 1,1)->toDateString())->where('Tarih', '<=', Carbon\Carbon::create(date('Y'),12,31)->toDateString())->where('ProjeID', $project->id)->sum('Saat')}}</h4>
                                <p class="card-text font-small-3 mb-0">Hours Logged</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="project-members" role="tabpanel" aria-labelledby="#project-tabs-members">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Hourly Rate</th>
                                <th>Task Pending</th>
                                <th>Task Completed</th>
                                <th>Leader</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($project->members as $member)
                            <tr>
                                <td>
                                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{{$member->name}}">
                                        @if($member->avatar != '')
                                            <img alt="Avatar" height="26" width="26" src="{{asset($member->avatar)}}">
                                        @else
                                            <img alt="Avatar" height="26" width="26" src="{{asset('dist/img/avatar.png')}}">
                                        @endif
                                    </div>
                                    <span class="font-weight-bold">{{$member->name}}</span>
                                </td>
                                <td>{{$member->hour_fee}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty 
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="project-tasks" role="tabpanel" aria-labelledby="#project-tabs-tasks">
              <div style="height:51px" class="card card-default color-palette-bo">
                <div style="height:51px" class="card-header">
                    <div class="d-inline-block">
                      <h3 class="card-title"><i class="fa fa-list"></i> Tasks</h3>
                    </div>
                    <div class="d-inline-block float-right">
                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#add_task_modal"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
              </div>
              <div class="card card-default color-palette-bo">
                <div class="card-body">
                  <table id="example1" class="table table-striped projects table-tasks">
                      <thead>
                          <tr>
                              <th style="width: 20%">
                                  Task
                              </th>
                              <th style="width: 25%">
                                  Assigned To
                              </th>
                              <th>
                                  Due Date
                              </th>
                              <th style="width: 8%" class="text-center">
                                  Status
                              </th>
                              <th style="width: 10%">
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(count($project->tasks) > 0)
                              @foreach($project->tasks as $task)
                                  <tr>
                                      <td>
                                          <a>
                                              {{$task->title}}
                                          </a>
                                      </td>
                                      <td>
                                          @if(count($task->assigned) > 0)
                                          <ul class="list-inline">
                                              @foreach($task->assigned as $user)
                                              <li class="list-inline-item">
                                                  <a href="#" title="{{$user->name}}">
                                                      @if($user->avatar != '')
                                                          <img alt="Avatar" class="table-avatar" src="{{asset($user->avatar)}}">
                                                      @else 
                                                          <img alt="Avatar" class="table-avatar" src="{{asset('dist/img/avatar.png')}}">
                                                      @endif
                                                  </a> 
                                              </li>
                                              @endforeach
                                          </ul>
                                          @endif
                                      </td>
                                      <td>
                                          {{date('d-m-Y', strtotime($task->due_date))}}  
                                      </td>
                                      <td class="project-state">
                                          @if($task->status == 'incomplete')
                                              <span class="badge badge-warning">{{$task->status}}</span>
                                          @elseif($task->status == 'completed')
                                              <span class="badge badge-success">{{$task->status}}</span>
                                          @endif
                                      </td>
                                      <td class="project-actions text-right">
                                          <button class="btn btn-info btn-sm btn-edit" data-id="{{$task->id}}">
                                              <i class="fas fa-pencil-alt">
                                              </i>
                                          </button>
                                          <button type="button" class="btn btn-danger btn-sm btn-delete-task" data-id="{{$task->id}}">
                                              <i class="fas fa-trash">
                                              </i>
                                          </button>
                                      </td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="project-timelogs" role="tabpanel" aria-labelledby="#project-tabs-timelogs">
                <table class="table table-timelogs">
                    <thead>
                    <tr>
                    <th></th>
                      <th style="width:29%">{{$lang::settings('Isci_Paneli_Tarih')}}</th>
                      <th style="width:19%">{{$lang::settings('Isci_Paneli_Saat')}}</th>
                      <th class="text-center" colspan="1">{{$lang::settings('Isci_Paneli_Proje')}}</th>
                      <th style="width:20%"></th>  
                    </tr>
                    </thead>
                    <tbody>
                      @if(count($project->timelogs) > 0)
                        @foreach($project->timelogs as $log)
                        <tr>
                            <td>{{isset($log->user->name) ? $log->user->name : ''}}</td>
                            <td>{{$system->cevir($log->Tarih)}} {{$system->gun_bas_kisa($log->Tarih)}}</td>
                            <td>{{$log->Saat}}</td>
                            <td class="text-center" >
                                @if($log->ProjeBASLIK != '')
                                {{$log->ProjeBASLIK}}
                                @else 
                                {{\App\Project::where('ProjeID', $log->ProjeID)->first()->ProjeBASLIK}}
                                @endif
                            </td>
                            <td>
                                @if($log->Onay != 1)
                                <button class="btn btn-danger btn-sm btn-delete" data-id="{{$log->SaatID}}"><i class="nav-icon fas fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                      @endif
                  </table>
            </div>
            <div class="tab-pane fade" id="project-activity" role="tabpanel" aria-labelledby="#project-tabs-activity">
                <ul class="timeline ml-50 mb-0">
                    @forelse($project->activities as $activity)
                    <li class="timeline-item">
                        <span class="timeline-point timeline-point-indicator"></span>
                        <div class="timeline-event">
                            <h6>{{$activity->details}}</h6>
                            <p>{{$activity->created_at->format('M d, Y')}}</p>
                            <div class="media align-items-center">
                                <div class="avatar mr-50">
                                    @if($activity->user->avatar != '')
                                        <img width="38" height="38" alt="{{$activity->user->name}}" src="{{asset($activity->user->avatar)}}">
                                    @else
                                        <img width="38" height="38" alt="{{$activity->user->name}}" src="{{asset('dist/img/avatar.png')}}">
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-0">{{$activity->user->name}}</h6>
                                    <p class="mb-0">{{App\Role::find($activity->user->role)->title}}</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty 
                    @endforelse
                </ul>
            </div>
          </div>
        </div>
        <!-- /.card -->
    </div>
</section>
@endsection

@section('modals')
<div class="modal fade" id="add_member_modal">
  <div class="modal-dialog">
      <form class="form-add-member" method="POST" action="{{route('admin.projects.add-member')}}">
          @csrf
          <input type="hidden" name="project_id" value="{{$project->ProjeID}}">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Add project member</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <select class="select2bs4" name="user_id" style="width: 100%;">
                      @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </div>
      </form>
  </div>
  <!-- /.modal-content -->
</div>
<div class="modal fade" id="add_task_modal">
  <div class="modal-dialog modal-lg">
      <form class="form-add-task" method="POST" action="{{route('tasks.store')}}">
          @csrf
          <input type="hidden" name="project_id" value="{{$project->ProjeID}}">
          <div class="modal-content">
              <div class="modal-header">
                  Add Task
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Title:</label>
                              <input type="text" name="title" class="form-control" required>
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
                                  @foreach($project->members as $member)
                                      <option value="{{$member->id}}">{{$member->name}}</option>
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
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </div>
      </form>
  </div>
  <!-- /.modal-content -->
</div>

<div class="modal fade" id="edit_task_modal">
  <div class="modal-dialog modal-lg">
      <form class="form-edit-task" method="POST" action="{{route('tasks.update')}}">
          @csrf
          <input type="hidden" name="task_id">
          <input type="hidden" name="project_id" value="{{$project->ProjeID}}">
          <div class="modal-content">
              <div class="modal-header">
                  Edit Task
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Title:</label>
                              <input type="text" name="title" class="form-control" required>
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
                                  @foreach($project->members as $member)
                                      <option value="{{$member->id}}">{{$member->name}}</option>
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
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </div>
      </form>
  </div>
  <!-- /.modal-content -->
</div>

<div class="modal fade" id="delete_task_modal">
  <div class="modal-dialog">
      <div class="modal-content bg-danger">
          <div class="modal-header">
              <h4 class="modal-title">{{$lang::settings('Isci_Paneli_Kaydi_Sil')}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p><strong>{{$lang::settings('Isci_Paneli_Emin_Misiniz')}}</strong></p>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{$lang::settings('Isci_Paneli_Hayir')}}</button>
              <button class="btn btn-outline-light btn-delete-go">{{$lang::settings('Isci_Paneli_Evet_Sil')}}</button>
          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script>
  //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $(".table-activity").DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "order": [[0, "desc"]]
    });
    $(".table-timelogs").DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "order": [[0, "desc"]]
    });

    $('.form-add-member').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: "{{route('admin.projects.add-member')}}",
        type: 'POST',
        data: $(this).serialize(),
        success: function(resp){
          if(resp.success){
              Swal.fire({
                title: 'Success!',
                text: resp.msg,
                icon: 'success'
              }).then(()=>{
                $('#add_member_modal').modal('hide');
                let table = $('.table-members tbody');
                table.append(resp.row).fadeIn(300);
              });
          }
        }
      })
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

                    setTimeout(function() {
                      $('#add_task_modal').modal('hide');
                      let table = $('.table-tasks tbody');
                      table.append(resp.row).fadeIn(300);
                    }, 1000)
                }
            }
        })
    }); 

    $('.table-tasks').on('click','.btn-edit', async function(e){
        e.preventDefault();
        $('#edit_task_modal').modal('show');
        var task = await $.ajax({
            url: "{{route('tasks.edit')}}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $(this).data('id'),
            }
        });

        let form = $('.form-edit-task');
        form.find('input[name=task_id]').val(task.id);
        form.find('input[name=title]').val(task.title);
        form.find('textarea[name=description]').val(task.description);
        form.find('input[name=start_date]').val(task.start_date);
        form.find('input[name=due_date]').val(task.due_date);
        form.find('select[name=status]').val(task.status);
        form.find('select[name=priority]').val(task.priority);

        let assignMembers = new Array();
        $.each(task.assigned, function(index, member){
            assignMembers.push(member.assign_to);
        });
        form.find('select[name="assign_to[]"]').select2().val(assignMembers).trigger('change');
    });

    $('.form-edit-task').on('submit', function(e){
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

                    $('#edit_task_modal').modal('hide');
                    
                    setTimeout(function() {
                      
                      let table = $('.table-tasks tbody');
                      table.find('[data-id='+resp.id+']').parent().parent().replaceWith(resp.renderRow).hide().fadeIn(600);
                    }, 1000)
                }
            }
        })
    }); 

    $('.btn-delete-member').on('click', async function() {
        let id = $(this).data().id;

        Swal.fire({
            text: 'Are you sure you want to remove this member?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1"
        }).then(async result => {
            if(result.value){
                const delete_member = await $.ajax({
                    url: "{{ route('admin.projects.remove-member') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        project_id: "{{$project->ProjeID}}",
                        user_id: id
                    }
                });

                if(delete_member.success){
                    Swal.fire({
                        text: delete_member.msg,
                        type: 'success',
                    }).then(()=>{
                      let table = $('.table-members tbody');
                      table.find('[data-id='+id+']').parent().parent().fadeOut(600);
                    });
                }
            }
        });
    });
    $('.btn-delete-task').on('click', async function() {
        let id = $(this).data().id;

        Swal.fire({
            text: 'Are you sure you want to remove this task?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1"
        }).then(async result => {
            if(result.value){
                const delete_task = await $.ajax({
                    url: "{{ route('tasks.destroy') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    }
                });

                if(delete_task.success){
                    Swal.fire({
                        text: delete_task.msg,
                        type: 'success',
                    }).then(()=>{
                      let table = $('.table-tasks tbody');
                      table.find('[data-id='+delete_task.id+']').parent().parent().fadeOut(600);
                    });
                }
            }
        });
    });
</script>
    
@endsection
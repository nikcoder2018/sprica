<?php 
use App\Helpers\Language;
use App\Helpers\System;
$lang = new Language;
$system = new System;
?>
@extends('layouts.admin.main')
@section('stylesheets')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Project #{{$project->ProjeKODU}} - {{$project->ProjeBASLIK}}</h3>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                            <a class="nav-link" id="project-timelogs-tabs" data-toggle="pill" href="#project-timelogs" role="tab" aria-controls="project-tabs-timelogs" aria-selected="true">Timelogs</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="project-tabs-content">
                        <div class="tab-pane fade active show" id="project-overview" role="tabpanel" aria-labelledby="#project-tabs-overview">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                  <div class="row">
                                    <div class="col-12 col-sm-3">
                                      <div class="info-box bg-light">
                                        <div class="info-box-content">
                                          <span class="info-box-text text-center text-muted">Budget</span>
                                          <span class="info-box-number text-center text-muted mb-0">0</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                      <div class="info-box bg-light">
                                        <div class="info-box-content">
                                          <span class="info-box-text text-center text-muted">Expenses</span>
                                          <span class="info-box-number text-center text-muted mb-0">0</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="info-box bg-light">
                                          <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Earnings</span>
                                            <span class="info-box-number text-center text-muted mb-0">0</span>
                                          </div>
                                        </div>
                                      </div>
                                    <div class="col-12 col-sm-3">
                                      <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Hours Logged</span>
                                            <span class="info-box-number text-center text-muted mb-0">
                                                {{\App\Watches::where('Tarih', '>=', Carbon\Carbon::create(date('Y'), 1,1)->toDateString())->where('Tarih', '<=', Carbon\Carbon::create(date('Y'),12,31)->toDateString())->where('ProjeID', $project->ProjeID)->sum('Saat')}}
                                            <span>
                                        </span></span></div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12">
                                      <h4>Recent Activity</h4>

                                    </div>
                                  </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                  <h3 class="text-primary">{{$project->ProjeBASLIK}}</h3>
                                  <p class="text-muted"></p>
                                  <br>
                                  <div class="text-muted">
                                    <p class="text-sm">Client Company
                                      <b class="d-block"></b>
                                    </p>
                                    <p class="text-sm">Project Leader
                                      <b class="d-block"></b>
                                    </p>
                                  </div>
                    
                                  <h5 class="mt-5 text-muted">Project files</h5>
                                  <ul class="list-unstyled">
                                    
                                  </ul>
                                  <div class="text-center mt-5 mb-3">
                                    <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                    <a href="#" class="btn btn-sm btn-warning">Create ticket</a>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="tab-pane fade" id="project-members" role="tabpanel" aria-labelledby="#project-tabs-members">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 30%">
                                            Name
                                        </th>
                                        <th>Hourly Rate</th>
                                        <th>User Role</th>
                                        <th style="width: 10%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($project->members) > 0)
                                        @foreach($project->members as $member)
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm-4 col-xs-4">
                                                            @if($member->avatar != '')
                                                                <img alt="Avatar" class="table-avatar" title="{{$member->name}}" src="{{asset($member->avatar)}}">
                                                            @else
                                                                <img alt="Avatar" class="table-avatar" title="{{$member->name}}" src="{{asset('dist/img/avatar.png')}}">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-8 col-xs-8">
                                                                {{$member->name}}<br><span class="text-muted font-12">{{$member->department}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$member->hour_fee}}</td>
                                                <td>{{App\Role::find($member->role)->name}}</td>
                                                <td class="project-actions text-right">
                                                    <button class="btn btn-info btn-sm btn-edit" data-id="{{$member->id}}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$member->id}}">
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
                        <div class="tab-pane fade" id="project-tasks" role="tabpanel" aria-labelledby="#project-tabs-tasks">
                            <table id="example1" class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">
                                            Task
                                        </th>
                                        <th>Project</th>
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
                                                <td>{{$task->project->ProjeBASLIK}}</td>
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
                                                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$task->id}}">
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
                        <div class="tab-pane fade" id="project-timelogs" role="tabpanel" aria-labelledby="#project-tabs-timelogs">
                            <table class="table table-timelogs">
                                <thead>
                                <tr>
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
                      </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script>
    $(".table-timelogs").DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "order": [[0, "desc"]]
    });
</script>
    
@endsection
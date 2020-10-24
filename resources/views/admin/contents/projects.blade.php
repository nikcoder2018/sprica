<?php 
use App\Helpers\Language;
$lang = new Language;
?>
@extends('layouts.admin.main')

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link href="{{asset('dist/css/validation_master.css')}}" rel="stylesheet">
    <style>
        .dataTables_length, .dataTables_filter, .dataTables_iinfo, .ddataTables_paginate {
            display: none;
        }
    </style>
@endsection
@section('content')
<div style="height:51px" class="card card-default color-palette-bo">
    <div style="height:51px" class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-users"></i> projects</h3>
        </div>
        <div class="d-inline-block float-right">
            <a data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)"class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>

<section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body p-0">
        <table id="example1" class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 20%">
                        Project Name
                    </th>
                    <th style="width: 25%">
                        Team Members
                    </th>
                    <th>
                        Project Progress
                    </th>
                    <th>Hours</th>
                    <th style="width: 8%" class="text-center">
                        Status
                    </th>
                    <th style="width: 10%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @if(count($projects) > 0)
                    @foreach($projects as $project)
                        <tr>
                            <td>
                                <a>
                                    {{$project->ProjeBASLIK}}
                                </a>
                                <br>
                                <small>
                                    Created {{date('m.d.Y', strtotime($project->created_at))}}
                                </small>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    @if(count($project->members) > 0)
                                        @foreach($project->members as $member)
                                            <li class="list-inline-item">
                                                @if($member->member_detail->avatar != '')
                                                <img alt="Avatar" class="table-avatar" title="{{$member->member_detail->name}}" src="{{asset($member->member_detail->avatar)}}">
                                                @else
                                                <img alt="Avatar" class="table-avatar" title="{{$member->member_detail->name}}" src="{{asset('dist/img/avatar.png')}}">
                                                @endif
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                            <td class="project_progress">
                                @if(count($project->tasks) > 0)
                                @php 
                                    $completed = count($project->tasks_completed);
                                    $tasks = count($project->tasks);
                                    $percentage = ($completed/$tasks)*100;
                                @endphp
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{$percentage}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$percentage}}%">
                                    </div>
                                </div>
                                <small>
                                    {{$percentage}}% Complete
                                </small>
                                @else
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="0" aria-volumemin="0" aria-volumemax="100" style="width: 0%">
                                    </div>
                                </div>
                                <small>
                                    0% Complete
                                </small>
                                @endif

                            </td>
                            <td>
                                {{\App\Watches::where('Tarih', '>=', Carbon\Carbon::create(date('Y'), 1,1)->toDateString())->where('Tarih', '<=', Carbon\Carbon::create(date('Y'),12,31)->toDateString())->where('ProjeID', $project->ProjeID)->sum('Saat')}}
                                Std.
                            </td>
                            <td class="project-state">
                                <span class="badge badge-success">{{$project->status}}</span>
                            </td>
                            <td class="project-actions text-right">
                                <button class="btn btn-info btn-sm btn-edit" data-id="{{$project->ProjeID}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$project->ProjeID}}">
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
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
@endsection

@section('modals')

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <form class="form-add-project" method="POST" action="{{route('admin.projects.store')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    {{$lang::settings('Admin_Projeler')}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>
                              </div>
                              <div class="card-body">
                                <div class="form-group">
                                  <label>Project Name</label>
                                  <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label >Project Description</label>
                                  <textarea name="description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="status" class="form-control custom-select">
                                    <option selected="" disabled="">Select one</option>
                                    <option>On Hold</option>
                                    <option>Canceled</option>
                                    <option>Success</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Client Company</label>
                                  <input type="text" name="company" class="form-control">
                                </div>
                    
                                <div class="form-group">
                                    <label>Project Member</label>
                                    <select class="form-control select2bs4" multiple="multiple" name="members[]" style="width: 100%;">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="form-group">
                                  <label>Project Leader</label>
                                  <select class="form-control select2bs4" name="leader" style="width: 100%;">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h3 class="card-title">Budget</h3>
                              </div>
                              <div class="card-body">
                                <div class="form-group">
                                  <label>Estimated budget</label>
                                  <input type="number" name="budget" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label for="inputSpentBudget">Amount spent</label>
                                  <input type="number" name="spent" class="form-control">
                                </div>
                              </div>
                          </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{route('admin.projects')}}" type="button" class="btn btn-default">Close</a>
                    <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <form class="form-edit-project" method="POST" action="{{route('admin.projects.update')}}">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    {{$lang::settings('Admin_Projeler')}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>
                              </div>
                              <div class="card-body">
                                <div class="form-group">
                                  <label>Project Name</label>
                                  <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label >Project Description</label>
                                  <textarea name="description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="status" class="form-control custom-select">
                                    <option selected="" disabled="">Select one</option>
                                    <option>On Hold</option>
                                    <option>Canceled</option>
                                    <option>Success</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Client Company</label>
                                  <input type="text" name="company" class="form-control">
                                </div>
                    
                                <div class="form-group">
                                    <label>Project Member</label>
                                    <select class="form-control select2bs4" multiple="multiple" name="members[]" style="width: 100%;">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="form-group">
                                  <label>Project Leader</label>
                                  <select class="form-control select2bs4" name="leader" style="width: 100%;">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h3 class="card-title">Budget</h3>
                              </div>
                              <div class="card-body">
                                <div class="form-group">
                                  <label>Estimated budget</label>
                                  <input type="number" name="budget" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label for="inputSpentBudget">Amount spent</label>
                                  <input type="number" name="spent" class="form-control">
                                </div>
                              </div>
                          </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{route('admin.projects')}}" type="button" class="btn btn-default">Close</a>
                    <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>

<div class="modal fade" id="modal-danger">
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

<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#example1").DataTable();
    });
</script>

<script src="{{asset('dist/js/validation_master.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('.form-add-project').on('submit', function(e){
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

        $('.projects').on('click', '.btn-edit',async function(e){
            e.preventDefault();
            $('#modal-edit').modal('show');
            var project = await $.ajax({
                url: "{{route('admin.projects.edit')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $(this).data('id'),
                }
            });

            let form = $('.form-edit-project');
            form.find('input[name=id]').val(project.ProjeID);
            form.find('input[name=name]').val(project.ProjeBASLIK);
            form.find('textarea[name=description]').val(project.description);
            form.find('select[name=status]').val(project.status);
            form.find('input[name=company]').val(project.client);
            //form.find('select[name=leader]').val(project.status);
            let projectMembers = new Array();
            $.each(project.members, function(index, member){
                projectMembers.push(member.member_detail.id);
                if(member.leader == 1){
                    form.find('select[name=leader]').val(member.member_detail.id);
                }
            });
            form.find('select[name="members[]"]').select2().val(projectMembers).trigger('change');

            form.find('input[name=budget]').val(project.budget);
            form.find('input[name=spent]').val(project.spent);
        });

        $('.form-edit-project').on('submit', function(e){
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

        $('.btn-delete').on('click', function(){
            $('#modal-danger').modal('show');
            $('.btn-delete-go').attr('data-id', $(this).data('id'));
        });

        $('.btn-delete-go').on('click', function(){
            $.ajax({
                url: "{{route('admin.projects.destroy')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id : $(this).data('id')
                },
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
    })
</script>
@endsection
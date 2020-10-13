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
          <h3 class="card-title"><i class="fa fa-users"></i> Tasks</h3>
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
                @if(count($tasks) > 0)
                    @foreach($tasks as $task)
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
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
@endsection

@section('modals')

<div class="modal fade" id="modal-lg">
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

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <form class="form-edit-project" method="POST" action="{{route('admin.projects.update')}}">
            @csrf
            <input type="hidden" name="ProjeID">
            <div class="modal-content">
                <div class="modal-header">
                    {{$lang::settings('Admin_Projeler')}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName"> {{$lang::settings('Admin_Projeler_Proje_Basligi')}}</label>
                            <input class="form-control " required name="ProjeBASLIK" value="" />
                        </div>
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName"> {{$lang::settings('Admin_Projeler_Proje_Kodu')}}</label>
                            <input class="form-control " required name="ProjeKODU" value="" />
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
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#example1").DataTable();
    });
</script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dist/js/validation_master.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //Initialize Select2 Elements
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

        $('.btn-edit').on('click', async function(e){
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
            form.find('input[name=ProjeID]').val(project.ProjeID);
            form.find('input[name=ProjeBASLIK]').val(project.ProjeBASLIK);
            form.find('input[name=ProjeKODU]').val(project.ProjeKODU);
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
                url: "{{route('tasks.destroy')}}",
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
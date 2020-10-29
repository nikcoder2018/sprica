<?php 
use App\Helpers\Language;
$lang = new Language;
?>
@extends('layouts.admin.main')

@section('stylesheets')
<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link href="{{asset('dist/css/validation_master.css')}}" rel="stylesheet">

<style>
    .dataTables_length, .dataTables_filter, .dataTables_iinfo, .ddataTables_paginate {
        display: none;
    }

    .hide{
        display: none;
    }
</style> 
@endsection
@section('content')
<div style="height:51px" class="card card-default color-palette-bo">
    <div style="height:51px" class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-envelope"></i> Tickets</h3>
        </div>
        <div class="d-inline-block float-right">
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary add_modal"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>

<section class="content">
    <div class="card">
        <div class="card-body p-0">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Requester Name</th>
                        <th>Requested On</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>                                   
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->requester->name }}</td>
                        <td>{{ date('Y-m-d H:i:s', strtotime($ticket->created_at)) }}</td>
                        <td>{{ ucfirst($ticket->priority) }}</td>
                        <td>{{ ucfirst($ticket->status)}}</td>
                        <td>
                            <a href="#" class="edit_ticket" data-id="{{ $ticket->id }}"><i class="fa fa-fw fa-edit text-primary"></i></a>
                            <a href="#" class="delete_ticket" data-id="{{ $ticket->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
                        </td>
                    </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="modal fade add__modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('tickets.store') }}" class="form-add-ticket" method="POST"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Create Ticket</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label for="subject">Ticket Subject</label>
                                    <input type="text" name="subject" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->myrole->name == 'admin')
                                <fieldset class="form-group">
                                    <label for="chassis_no">Project</label>
                                    <select name="project" class="form-control" required>
                                        <option value="">Select project</option>
                                        @if(count($projects) > 0)
                                            @foreach($projects as $project)
                                                <option value="{{$project->ProjeID}}">{{$project->ProjeBASLIK}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                                @else 
                                <fieldset class="form-group">
                                    <label for="chassis_no">Project</label>
                                    <select name="project" class="form-control" required>
                                        <option value="">Select project</option>
                                        @if(count($projects) > 0)
                                            @foreach($projects as $project)
                                                <option value="{{$project->project->ProjeID}}">{{$project->project->ProjeBASLIK}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="name">Ticket Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="6" required></textarea>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="chassis_no">Requester Name</label>
                                    @if(auth()->user()->myrole->name == 'admin')
                                    <select name="requester_user_id" class="form-control" required>
                                        <option value="">Select Requester Name</option>
                                        @if(count($users) > 0)
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @else 
                                    <input type="hidden" name="requester_user_id" value="{{auth()->user()->id}}" class="form-control">
                                    <input type="text" value="{{auth()->user()->name}}" class="form-control" disabled>
                                    @endif
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="">Select</option>
                                        @if(count($types) > 0)
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="priority">Priority</label>
                                    <select name="priority" class="form-control">
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                        <option value="urgent">Urgent</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-success" type="submit"> Save </button>
                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade edit__modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('tickets.update') }}" class="form-edit-ticket" method="POST"> 
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header"> 
                    <h4 class="modal-title">Update Ticket</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label for="subject">Ticket Subject</label>
                                    <input type="text" name="subject" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->myrole->name == 'admin')
                                <fieldset class="form-group">
                                    <label for="chassis_no">Project</label>
                                    <select name="project" class="form-control" required>
                                        <option value="">Select project</option>
                                        @if(count($projects) > 0)
                                            @foreach($projects as $project)
                                                <option value="{{$project->ProjeID}}">{{$project->ProjeBASLIK}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                                @else 
                                <fieldset class="form-group">
                                    <label for="chassis_no">Project</label>
                                    <select name="project" class="form-control" required>
                                        <option value="">Select project</option>
                                        @if(count($projects) > 0)
                                            @foreach($projects as $project)
                                                <option value="{{$project->project->ProjeID}}">{{$project->project->ProjeBASLIK}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="name">Ticket Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="6" required></textarea>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="chassis_no">Requester Name</label>
                                    @if(auth()->user()->myrole->name == 'admin')
                                    <select name="requester_user_id" class="form-control" required>
                                        <option value="">Select Requester Name</option>
                                        @if(count($users) > 0)
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @else 
                                    <input type="hidden" name="requester_user_id" value="{{auth()->user()->id}}" class="form-control">
                                    <input type="text" value="{{auth()->user()->name}}" class="form-control" disabled>
                                    @endif
                                </fieldset>
                            </div>
                      
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control">
                                        <option value="">Select</option>
                                        @if(count($types) > 0)
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="priority">Priority</label>
                                    <select name="priority" class="form-control">
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                        <option value="urgent">Urgent</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="open">Open</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-success" type="submit"> Save </button>
                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#example1").DataTable();
    });
    $(document).ready(function () { 
       $('.add_modal').on('click', function() {                
           let add_modal = $('.add__modal');
           add_modal.modal();
       });

       $('.form-add-ticket').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                @if(auth()->user()->myrole->name == 'admin')
                url: "{{ route('admin.tickets.store') }}",
               @else 
                url: "{{ route('tickets.store') }}",
               @endif
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

       
       $('.edit_ticket').on('click', async function() {  
           let edit_modal = $('.edit__modal');
           let form = edit_modal.find('form');
           let id = $(this).data().id;
           edit_modal.modal();
           const ticket = await $.ajax({
               @if(auth()->user()->myrole->name == 'admin')
               url: "{{ route('admin.tickets.edit') }}",
               @else 
               url: "{{ route('tickets.edit') }}",
               @endif
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           form.find('input[name=id]').val(ticket.id);
           form.find('input[name=subject]').val(ticket.subject);
           form.find('select[name=project]').val(ticket.project_id);
           form.find('textarea[name=description]').val(ticket.description);
           form.find('select[name=requester_user_id]').val(ticket.requester_user_id);
           form.find('select[name=type]').val(ticket.type);
           form.find('select[name=priority]').val(ticket.priority);
       });

       $('.form-edit-ticket').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                @if(auth()->user()->myrole->name == 'admin')
                url: "{{ route('admin.tickets.update') }}",
               @else 
                url: "{{ route('tickets.update') }}",
               @endif
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

       $('.delete_ticket').on('click', async function() {
           let id = $(this).data().id;

           Swal.fire({
               text: 'Are you sure you want to delete this ticket?',
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!",
               confirmButtonClass: "btn btn-primary",
               cancelButtonClass: "btn btn-danger ml-1"
           }).then(async result => {
               if(result.value){
                   const delete_ticket = await $.ajax({
                    @if(auth()->user()->myrole->name == 'admin')
                    url: "{{ route('admin.tickets.destroy') }}",
                    @else 
                    url: "{{ route('tickets.destroy') }}",
                    @endif
                       type: 'POST',
                       data: {
                           _token: "{{ csrf_token() }}",
                           id
                       }
                   });

                   if(delete_ticket.success){
                       Swal.fire({
                           text: delete_ticket.msg,
                           type: 'success',
                       }).then(()=>{
                           location.reload();
                       });
                   }
               }
           });
       });
      
    });

</script>
@endsection
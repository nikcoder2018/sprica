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
          <h3 class="card-title"><i class="fa fa-envelope"></i> Email Triggers</h3>
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
                        <th>Triggers when</th>
                        <th>Email Template</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>                                   
                    @foreach($triggers as $trigger)
                    <tr>
                        <td>{{ $trigger->action->description }}</td>
                        <td>{{ $trigger->template->title }}</td>
                        <td>
                            <a href="#" class="edit_trigger" data-id="{{ $trigger->id }}"><i class="fa fa-fw fa-edit text-primary"></i></a>
                            <a href="#" class="delete_trigger" data-id="{{ $trigger->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
                        </td>
                    </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="modal fade add__modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('emailtriggers.store') }}" class="form-add-trigger" method="POST"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Create Trigger</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="action_id">Trigger when</label>
                                    <select name="action_id" class="form-control" required>
                                        <option value="">Select action</option>
                                        @if(count($actions) > 0)
                                            @foreach($actions as $action)
                                                <option value="{{$action->id}}">{{$action->description}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="template_id">Email Template</label>
                                    <select name="template_id" class="form-control" required>
                                        <option value="">Select template</option>
                                        @if(count($templates) > 0)
                                            @foreach($templates as $template)
                                                <option value="{{$template->id}}">{{$template->title}}</option>
                                            @endforeach
                                        @endif
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
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('emailtriggers.update') }}" class="form-edit-trigger" method="POST"> 
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header"> 
                    <h4 class="modal-title">Update Trigger</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="action_id">Trigger when</label>
                                    <select name="action_id" class="form-control" required>
                                        <option value="">Select action</option>
                                        @if(count($actions) > 0)
                                            @foreach($actions as $action)
                                                <option value="{{$action->id}}">{{$action->description}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="template_id">Email Template</label>
                                    <select name="template_id" class="form-control" required>
                                        <option value="">Select template</option>
                                        @if(count($templates) > 0)
                                            @foreach($templates as $template)
                                                <option value="{{$template->id}}">{{$template->title}}</option>
                                            @endforeach
                                        @endif
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

       $('.form-add-trigger').on('submit', function(e){
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

       
       $('.edit_trigger').on('click', async function() {  
           let edit_modal = $('.edit__modal');
           let form = edit_modal.find('form');
           let id = $(this).data().id;
           edit_modal.modal();
           const trigger = await $.ajax({
               url: "{{ route('emailtriggers.edit') }}",
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           form.find('input[name=id]').val(trigger.id);
           form.find('select[name=action_id]').val(trigger.action_id);
           form.find('select[name=template_id]').val(trigger.template_id);

       });

       $('.form-edit-trigger').on('submit', function(e){
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

       $('.delete_trigger').on('click', async function() {
           let id = $(this).data().id;

           Swal.fire({
               text: 'Are you sure you want to delete this trigger?',
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!",
               confirmButtonClass: "btn btn-primary",
               cancelButtonClass: "btn btn-danger ml-1"
           }).then(async result => {
               if(result.value){
                   const delete_trigger = await $.ajax({
                       url: "{{ route('emailtriggers.destroy') }}",
                       type: 'POST',
                       data: {
                           _token: "{{ csrf_token() }}",
                           id
                       }
                   });

                   if(delete_trigger.success){
                       Swal.fire({
                           text: delete_trigger.msg,
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
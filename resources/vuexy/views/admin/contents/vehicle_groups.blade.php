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
<div class="card card-default color-palette-bo">
    <div class="card-header pb-1">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-car"></i> Vehicle Groups</h3>
        </div>
        <div class="d-inline-block float-right">
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary add_modal"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>

<section class="content m-md-0">
    <div class="card">
        <div class="card-body p-0">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>                                   
                    @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->description }}</td>
                        <td>
                            <a href="#" class="edit_group" data-id="{{ $group->id }}"><i class="fa fa-fw fa-edit text-primary"></i></a>
                            <a href="#" class="delete_group" data-id="{{ $group->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
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
            <form action="{{ route('vehiclegroups.store') }}" class="form-add-group" method="POST"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Create Group</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="template_id">Description</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control"></textarea>
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
            <form action="{{ route('vehiclegroups.update') }}" class="form-edit-group" method="POST"> 
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header"> 
                    <h4 class="modal-title">Update Group</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="template_id">Description</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control"></textarea>
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

       $('.form-add-group').on('submit', function(e){
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

       
       $('.edit_group').on('click', async function() {  
           let edit_modal = $('.edit__modal');
           let form = edit_modal.find('form');
           let id = $(this).data().id;
           edit_modal.modal();
           const group = await $.ajax({
               url: "{{ route('vehiclegroups.edit') }}",
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           form.find('input[name=id]').val(group.id);
           form.find('input[name=name]').val(group.name);
           form.find('textarea[name=description]').val(group.description);

       });

       $('.form-edit-group').on('submit', function(e){
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

       $('.delete_group').on('click', async function() {
           let id = $(this).data().id;

           Swal.fire({
               text: 'Are you sure you want to delete this group?',
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!",
               confirmButtonClass: "btn btn-primary",
               cancelButtonClass: "btn btn-danger ml-1"
           }).then(async result => {
               if(result.value){
                   const delete_group = await $.ajax({
                       url: "{{ route('vehiclegroups.destroy') }}",
                       type: 'POST',
                       data: {
                           _token: "{{ csrf_token() }}",
                           id
                       }
                   });

                   if(delete_group.success){
                       Swal.fire({
                           text: delete_group.msg,
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
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
          <h3 class="card-title"><i class="fa fa-bell"></i> News</h3>
        </div>
        <div class="d-inline-block float-right">
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary add_modal"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>


<section class="content">
    <div class="card">
        <div class="card-header p-0">
            <ul class="nav nav-tabs" id="news-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="news-overview-tabs" data-toggle="pill" href="#news-main" role="tab" aria-controls="news-tabs-main" aria-selected="true">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="news-members-tabs" data-toggle="pill" href="#news-members" role="tab" aria-controls="news-tabs-members" aria-selected="true">Who reads the news?</a>
                </li>
            </ul>
        </div>
        <div class="card-body p-0">
            <div class="tab-content" id="news-tabs-content">
                <div class="tab-pane fade active show" id="news-main" role="tabpanel" aria-labelledby="#news-tabs-overview">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Heading</th>
                                <th>Date</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>                                   
                            @foreach($notices as $notice)
                            <tr>
                                <td>{{ $notice->heading }}</td>
                                <td>{{ date('Y-m-d', strtotime($notice->created_at)) }}</td>
                                <td>
                                    <a href="#" class="edit_notice" data-id="{{ $notice->id }}"><i class="fa fa-fw fa-edit text-primary"></i></a>
                                    <a href="#" class="delete_notice" data-id="{{ $notice->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
                                </td>
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="news-members" role="tabpanel" aria-labelledby="#news-tabs-members">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Heading</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>                                   
                            @foreach($notices_reads as $read)
                            <tr>
                                <td>{{ $read->user->name }}</td>
                                <td>{{ $read->notice->heading }}</td>
                                <td>{{ date('Y-m-d', strtotime($read->created_at)) }}</td>
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade add__modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('notices.store') }}" class="form-add-notice" method="POST"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Create News</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="heading">Heading <sup>*</sup></label>
                                    <input type="text" name="heading" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="to" value="ALL" checked>
                                    <label class="form-check-label">All</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" cols="30" rows="5" class="form-control"></textarea>
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
            <form action="{{ route('notices.update') }}" class="form-edit-notice" method="POST"> 
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header"> 
                    <h4 class="modal-title">Update News</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="heading">Heading <sup>*</sup></label>
                                    <input type="text" name="heading" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="to" value="ALL" checked>
                                    <label class="form-check-label">All</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" cols="30" rows="5" class="form-control"></textarea>
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

       $('.form-add-notice').on('submit', function(e){
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

       
       $('.edit_notice').on('click', async function() {  
           let edit_modal = $('.edit__modal');
           let form = edit_modal.find('form');
           let id = $(this).data().id;
           edit_modal.modal();
           const notice = await $.ajax({
               url: "{{ route('notices.edit') }}",
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           form.find('input[name=id]').val(notice.id);
           form.find('input[name=heading]').val(notice.heading);
           form.find('textarea[name=details]').val(notice.details);

       });

       $('.form-edit-notice').on('submit', function(e){
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

       $('.delete_notice').on('click', async function() {
           let id = $(this).data().id;

           Swal.fire({
               text: 'Are you sure you want to delete this news?',
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!",
               confirmButtonClass: "btn btn-primary",
               cancelButtonClass: "btn btn-danger ml-1"
           }).then(async result => {
               if(result.value){
                   const delete_notice = await $.ajax({
                       url: "{{ route('notices.destroy') }}",
                       type: 'POST',
                       data: {
                           _token: "{{ csrf_token() }}",
                           id
                       }
                   });

                   if(delete_notice.success){
                       Swal.fire({
                           text: delete_notice.msg,
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
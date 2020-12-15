<?php 
use App\Helpers\Language;
$lang = new Language;
?>
@extends('layouts.admin.main')

@section('stylesheets')
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Project</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">

    <form class="form-add-project" action="{{route('admin.projects.store')}}" method="POST">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Budget</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="#" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Create" class="btn btn-success float-right">
      </div>
    </div>
    </form>
  </section>
@endsection


@section('scripts')
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //Initialize Select2 Elements
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

                        setTimeout(function() { location.href = "{{route('admin.projects')}}"; }, 1000)
                    }
                }
            })
        }); 
    });
</script>
@endsection
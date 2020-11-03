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
<div style="height:51px" class="card card-default color-palette-bo">
    <div style="height:51px" class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-car"></i> {{$vehicle->name}}</h3>
        </div>
        <div class="d-inline-block float-right">
            <a href="{{route('vehicles.index')}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-undo"></i></a> &nbsp;
            <button data-id="{{$vehicle->id}}" class="btn btn-sm btn-outline-primary btn-set-driver" title="Set Driver"><i class="fa fa-user"></i></a> &nbsp;
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-left: 0px">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class=" mt-3">
                <!-- /.card-header -->
                <!-- form start -->
                <div class="">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <div style="min-height:75vh"class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                          <h3 class="profile-username text-center">{{$vehicle->name}}</h3>
                                            <p class="text-muted text-center">{{$vehicle->group->name}}</p>
                                          <ul class="list-group list-group-flush mb-3">
                                            <li class="list-group-item">
                                                <b>Driver</b><a class="float-right">{{$vehicle->driver->name}}</a>
                                            </li>
                                            <li class="list-group-item">
                                              <b>Registration No.</b><a class="float-right">{{$vehicle->registration_no}}</a>
                                            </li>
                                              <li class="list-group-item">
                                              <b>Nodel</b><a class="float-right">{{$vehicle->model}}</a>
                                            </li>
                                            <li class="list-group-item">
                                              <b>Chassis No.</b> <a class="float-right">{{$vehicle->chassis_no}}</a>
                                            </li>
                                            <li class="list-group-item">
                                              <b>Engine No.</b> <a class="float-right">{{$vehicle->engine_no}}</a>
                                            </li>
                                              <li class="list-group-item"><br>
                                              <b>Manufacturer</b> <a class="float-right">{{$vehicle->manufacturer}}</a>
                                            </li>
                                              <li class="list-group-item">
                                              <b>Type</b> <a class="float-right">{{$vehicle->type}}</a>
                                            </li>
                                          </ul>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div style="min-height:75vh" class="card card-primary card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                          <ul class="nav nav-tabs border-bottom-0" id="vehicle-tabs" role="tablist">
                                            <li style="width:99px;text-align:center" class="nav-item">
                                              <a class="nav-link active" data-toggle="pill" href="#vehicle-tabs-fuels" role="tab">Fuels</a>
                                            </li>
                                          </ul>
                                        </div>
                                        <div class="card-body">
                                          <div class="tab-content" id="vehicle-tabs-content">
                                                <div class="tab-pane fade active show" id="vehicle-tabs-fuels" role="tabpanel">
                                                    <table id="example1" class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Fuel Fill Date</th>
                                                                <th>Vehicle</th>
                                                                <th>Quantity</th>
                                                                <th>Fuel Total Price</th>
                                                                <th>Driver</th>
                                                                <th>Odometer Reading</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                                   
                                                            @foreach($vehicle->fuels as $fuel)
                                                            <tr>
                                                                <td>{{ date('Y-m-d',strtotime($fuel->fill_date)) }}</td>
                                                                <td>{{ $fuel->vehicle->name }}</td>
                                                                <td>{{ $fuel->quantity }}</td>
                                                                <td>{{ $fuel->amount }}</td>
                                                                <td>{{ $fuel->driver->name }}</td>
                                                                <td>{{ $fuel->odometer_reading }}</td>
                                                                <td>{{ $fuel->comment}}</td>
                                                            </tr>
                                                            @endforeach    
                                                        </tbody>
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
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('modals')
<div class="modal fade set_driver_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('vehicles.setdriver') }}" class="form-set-driver" method="POST"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Set a Driver to this Vehicle</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                @csrf
                <input type="hidden" name="id" value="{{$vehicle->id}}">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control select2bs4" name="driver" style="width: 100%;">
                                    @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->name}}</option>
                                    @endforeach
                                </select>
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
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('.btn-set-driver').on('click', function() {                
           let add_modal = $('.set_driver_modal');
           add_modal.modal();
       });

       $('.form-set-driver').on('submit', function(e){
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
       })
    });
</script>
@endsection
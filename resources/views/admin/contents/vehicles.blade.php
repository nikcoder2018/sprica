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
          <h3 class="card-title"><i class="fa fa-car"></i> Vehicles</h3>
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
                        <th>Name</th>
                        <th>Group</th>
                        <th>Registration No</th>
                        <th>Model</th>
                        <th>Manufacturer</th>
                        <th>Type</th>
                        <th>Color</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>                                   
                    @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->name }}</td>
                        <td>{{ $vehicle->group->name }}</td>
                        <td>{{ $vehicle->registration_no }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->manufacturer }}</td>
                        <td>{{ $vehicle->type }}</td>
                        <td>{{ $vehicle->color }}</td>
                        <td>
                            <a href="#" class="edit_vehicle" data-id="{{ $vehicle->id }}"><i class="fa fa-fw fa-edit text-primary"></i></a>
                            <a href="#" class="delete_vehicle" data-id="{{ $vehicle->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
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
            <form action="{{ route('vehicles.store') }}" class="form-add-vehicle" method="POST"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Add Vehicle</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="registration_no">Registration Number</label>
                                    <input type="text" name="registration_no" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="name">Vehicle Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="chassis_no">Chassis No.</label>
                                    <input type="text" name="chassis_no" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="engine_no">Engine No.</label>
                                    <input type="text" name="engine_no" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="manufacturer">Manufactured By</label>
                                    <input type="text" name="manufacturer" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="type">Vehicle Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="CAR">CAR</option> 
                                        <option value="MOTORCYCLE">MOTORCYCLE</option> 
                                        <option value="TRUCK">TRUCK</option> 
                                        <option value="BUS">BUS</option> 
                                        <option value="TAXI">TAXI</option> 
                                        <option value="BICYCLE">BICYCLE</option> 
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" class="form-control">
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="registration_expiry">Registration Expiry Date</label>
                                    <input type="date" name="registration_expiry" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="type">Vehicle Group</label>
                                    <select name="group_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @if(count($groups) > 0)
                                            @foreach($groups as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('vehicles.update') }}" class="form-edit-vehicle" method="POST"> 
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header"> 
                    <h4 class="modal-title">Update Vehicle</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="registration_no">Registration Number</label>
                                    <input type="text" name="registration_no" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="name">Vehicle Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="chassis_no">Chassis No.</label>
                                    <input type="text" name="chassis_no" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="engine_no">Engine No.</label>
                                    <input type="text" name="engine_no" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="manufacturer">Manufactured By</label>
                                    <input type="text" name="manufacturer" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="type">Vehicle Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="CAR">CAR</option> 
                                        <option value="MOTORCYCLE">MOTORCYCLE</option> 
                                        <option value="TRUCK">TRUCK</option> 
                                        <option value="BUS">BUS</option> 
                                        <option value="TAXI">TAXI</option> 
                                        <option value="BICYCLE">BICYCLE</option> 
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" class="form-control">
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="registration_expiry">Registration Expiry Date</label>
                                    <input type="date" name="registration_expiry" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="type">Vehicle Group</label>
                                    <select name="group_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @if(count($groups) > 0)
                                            @foreach($groups as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
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

       $('.form-add-vehicle').on('submit', function(e){
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

       
       $('.edit_vehicle').on('click', async function() {  
           let edit_modal = $('.edit__modal');
           let form = edit_modal.find('form');
           let id = $(this).data().id;
           edit_modal.modal();
           const vehicle = await $.ajax({
               url: "{{ route('vehicles.edit') }}",
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           form.find('input[name=id]').val(vehicle.id);
           form.find('input[name=registration_no]').val(vehicle.registration_no);
           form.find('input[name=name]').val(vehicle.name);
           form.find('input[name=model]').val(vehicle.model);
           form.find('input[name=chassis_no]').val(vehicle.chassis_no);
           form.find('input[name=engine_no]').val(vehicle.engine_no);
           form.find('input[name=manufacturer]').val(vehicle.manufacturer);
           form.find('select[name=type]').val(vehicle.type);
           form.find('input[name=color]').val(vehicle.color);
           form.find('input[name=registration_expiry]').val(vehicle.registration_expiry);
           form.find('select[name=group_id]').val(vehicle.group_id);

       });

       $('.form-edit-vehicle').on('submit', function(e){
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

       $('.delete_vehicle').on('click', async function() {
           let id = $(this).data().id;

           Swal.fire({
               text: 'Are you sure you want to delete this vehicle?',
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!",
               confirmButtonClass: "btn btn-primary",
               cancelButtonClass: "btn btn-danger ml-1"
           }).then(async result => {
               if(result.value){
                   const delete_vehicle = await $.ajax({
                       url: "{{ route('vehicles.destroy') }}",
                       type: 'POST',
                       data: {
                           _token: "{{ csrf_token() }}",
                           id
                       }
                   });

                   if(delete_vehicle.success){
                       Swal.fire({
                           text: delete_vehicle.msg,
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
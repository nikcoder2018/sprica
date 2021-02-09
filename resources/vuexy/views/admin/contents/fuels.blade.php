<?php 
use App\Helpers\Language;
$lang = new Language;
?>
@extends('layouts.admin.main')

@section('stylesheets')
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

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
          <h3 class="card-title"><i class="fa fa-gas-pump"></i> Fuels</h3>
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
                        <th>Fuel Fill Date</th>
                        <th>Vehicle</th>
                        <th>Quantity</th>
                        <th>Fuel Total Price</th>
                        <th>Fuel Filled By</th>
                        <th>Odometer Reading</th>
                        <th>Comments</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>                                   
                    @foreach($fuels as $fuel)
                    <tr>
                        <td>{{ date('Y-m-d',strtotime($fuel->fill_date)) }}</td>
                        <td>{{ $fuel->vehicle->name }}</td>
                        <td>{{ $fuel->quantity }}</td>
                        <td>{{ $fuel->amount }}</td>
                        <td>{{ $fuel->driver->name }}</td>
                        <td>{{ $fuel->odometer_reading }}</td>
                        <td>{{ $fuel->comment}}</td>
                        <td>
                            <a href="#" class="edit_fuel" data-id="{{ $fuel->id }}"><i class="fa fa-fw fa-edit text-primary"></i></a>
                            <a href="#" class="delete_fuel" data-id="{{ $fuel->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
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
            <form action="{{ route('fuels.store') }}" class="form-add-fuel" method="POST"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Add Fuel</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="vehicle_id">Vehicle</label>
                                    <select name="vehicle_id" class="form-control" required>
                                        <option value="">Select vehicle</option>
                                        @if(count($vehicles) > 0)
                                            @foreach($vehicles as $vehicle)
                                            <option value="{{$vehicle->id}}">{{$vehicle->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="name">Added Driver</label>
                                    <select name="driver_id" class="form-control" required>
                                        <option value="">Select driver</option>
                                        @if(count($drivers) > 0)
                                            @foreach($drivers as $driver)
                                            <option value="{{$driver->id}}">{{$driver->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="fill_date">Fill Date</label>
                                    <input type="date" name="fill_date" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" name="quantity" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="odometer_reading">Odometer Reading</label>
                                    <input type="text" name="odometer_reading" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" step="0.1" name="amount" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label for="comment">Comments</label>
                                    <input type="text" name="comment" class="form-control">
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
            <form action="{{ route('fuels.update') }}" class="form-edit-fuel" method="POST"> 
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header"> 
                    <h4 class="modal-title">Update Fuel</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="vehicle_id">Vehicle</label>
                                    <select name="vehicle_id" class="form-control" required>
                                        <option value="">Select vehicle</option>
                                        @if(count($vehicles) > 0)
                                            @foreach($vehicles as $vehicle)
                                            <option value="{{$vehicle->id}}">{{$vehicle->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="name">Added Driver</label>
                                    <select name="driver_id" class="form-control" required>
                                        <option value="">Select driver</option>
                                        @if(count($drivers) > 0)
                                            @foreach($drivers as $driver)
                                            <option value="{{$driver->id}}">{{$driver->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="fill_date">Fill Date</label>
                                    <input type="date" name="fill_date" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" name="quantity" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="odometer_reading">Odometer Reading</label>
                                    <input type="text" name="odometer_reading" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" step="0.1" name="amount" class="form-control" required>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label for="comment">Comments</label>
                                    <input type="text" name="comment" class="form-control">
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

       $('.form-add-fuel').on('submit', function(e){
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

       
       $('.edit_fuel').on('click', async function() {  
           let edit_modal = $('.edit__modal');
           let form = edit_modal.find('form');
           let id = $(this).data().id;
           edit_modal.modal();
           const fuel = await $.ajax({
               url: "{{ route('fuels.edit') }}",
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           form.find('input[name=id]').val(fuel.id);
           form.find('select[name=vehicle_id]').val(fuel.vehicle_id);
           form.find('select[name=driver_id]').val(fuel.driver_id);
           form.find('input[name=fill_date]').val(fuel.fill_date);
           form.find('input[name=quantity]').val(fuel.quantity);
           form.find('input[name=odometer_reading]').val(fuel.odometer_reading);
           form.find('input[name=amount]').val(fuel.amount);
           form.find('input[name=comment]').val(fuel.comment);

       });

       $('.form-edit-fuel').on('submit', function(e){
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

       $('.delete_fuel').on('click', async function() {
           let id = $(this).data().id;

           Swal.fire({
               text: 'Are you sure you want to delete this fuel?',
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!",
               confirmButtonClass: "btn btn-primary",
               cancelButtonClass: "btn btn-danger ml-1"
           }).then(async result => {
               if(result.value){
                   const delete_fuel = await $.ajax({
                       url: "{{ route('fuels.destroy') }}",
                       type: 'POST',
                       data: {
                           _token: "{{ csrf_token() }}",
                           id
                       }
                   });

                   if(delete_fuel.success){
                       Swal.fire({
                           text: delete_fuel.msg,
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
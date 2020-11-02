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

        .card-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        }
        .card-header {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1);
            transition: 0.3s;
            border-radius: 0px 0px 9px 9px;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

    </style>
@endsection

@section('content')
<div style="height:51px" class="card card-default color-palette-bo">
    <div style="height:51px" class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-car"></i> {{$vehicle->name}}</h3>
        </div>
        <div class="d-inline-block float-right">
            <a href="{{route('vehicles.index')}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-undo"></i></a> &nbsp;
            <button data-id="{{$vehicle->id}}" class="btn btn-sm btn-outline-success btn-edit"><i class="icon wb-check" aria-hidden="true"></i><i class="fa fa-edit"></i></button>
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

@endsection
@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#example1").DataTable();

        $(".silbtn").click(function(){
            var href = $(this).attr("data-href");
            $(".mdlsilbtn").attr("href", href);
        });

        $(".selectable-all").click(function(){
            $('.selectable-item').not(this).prop('checked', this.checked);
        });

        $('.btn-edit').on('click', function(e){
            e.preventDefault();
            $('#modal-lg').modal('show');
            $.ajax({
                url: "{{route('admin.employees.edit')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $(this).data('id'),
                },
                success: function(resp){
                    let form = $('.form-update-user');
                    let user = resp.user; 
                    let codes = resp.codes;
                    form.find('input[name=id]').val(user.id);
                    form.find('input[name=name]').val(user.name);
                    form.find('input[name=username]').val(user.username);
                    form.find('input[name=password]').val(user.password);
                    form.find('select[name=role]').val(user.role);
                    form.find('select[name=status]').val(user.status);
                    form.find('input[name=number]').val(user.number);
                    form.find('input[name=department]').val(user.department);
                    form.find('input[name=hour_fee]').val(user.hour_fee);
                    form.find('input[name=tax_status]').val(user.tax_status);
                    form.find('input[name=login_date]').val(user.login_date);
                    form.find('input[name=day_off]').val(user.day_off);
                    form.find('input[name=street]').val(user.street);
                    form.find('input[name=postal_code]').val(user.potal_code);
                    form.find('input[name=date_of_birth]').val(user.date_of_birth);
                    form.find('input[name=place_of_birth]').val(user.place_of_birth);
                    form.find('input[name=nationality]').val(user.nationality);
                    form.find('input[name=sg_number]').val(user.sg_number);
                    form.find('input[name=health_insurance]').val(user.health_insurance);
                    form.find('input[name=exit]').val(user.exit);
                    form.find('input[name=function]').val(user.function);
                    form.find('input[name=STIDNUM]').val(user.STIDNUM);
                    form.find('select[name=driving_license]').val(user.driving_license);
                    form.find('select[name=vds_identity]').val(user.vds_identity);
                    form.find('input[name=bank]').val(user.bank);
                    form.find('input[name=IBAN]').val(user.IBAN);
                    form.find('input[name=BIC]').val(user.BIC);

                    $.each(codes, function(index, code){
                        form.find('input[name="codes['+code.KodID+']"]').prop('checked', true);
                    });
                }
            });
        });

        $('.form-update-user').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp){
                    if(resp.success){
                    Toast.fire({
                        icon: 'success',
                        toast: true,
                        timerProgressBar: false,
                        title: resp.msg,
                        timer:1000,
                        showConfirmButton: false,
                    });

                    setTimeout(function() { location.reload(); }, 963)
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
                url: "{{route('admin.employees.destroy')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    GunID : $(this).data('id')
                },
                success: function(resp){
                    if(resp.success){
                        Toast.fire({
                            icon: 'success',
                            timerProgressBar: false,
                            title: resp.msg,
                            showConfirmButton: false,
                        });

                        setTimeout(function() { location.reload(); }, 1000)
                    }
                }
            })
        });
    });

    
</script>
@endsection
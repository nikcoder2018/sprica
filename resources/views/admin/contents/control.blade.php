<?php 
use App\Helpers\Language;
$lang = new Language;
?>

@extends('layouts.admin.main')

@section('stylesheets')
<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.css')}}>">
<link href="{{asset('dist/css/validation_master.css')}}" rel="stylesheet">
<style>
    .dataTables_length, .dataTables_filter, .dataTables_iinfo, .dataTables_paginate {
        display: none;
    }
</style>
@endsection
@section('content')
   
<!-- Main content -->
<section class="content">
    <div class="container" style="margin-left: 0px">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{$text['page_title']}}</h3>
                        <div><button data-toggle="modal" data-target="#modal-add" href="javascript:void(0)" class="btn btn-xs btn-success float-sm-right"> <i style="color:white" class="nav-icon fas fa-play-circle"></i></button></div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-body">

                                <form method="GET" action="">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3 ">
                                                <label>{{$text['select_employees']}}</label>
                                                <select class="form-control" name="UyeID" onchange='this.form.submit()'>
                                                    <option value="" disabled selected>
                                                        {{$text['select_employees']}} ({{$total_confirmations}})
                                                    </option>
                                                    @foreach($all_members as $member)
                                                        <option @if(\Request::get('UyeID') == $member->id) selected @endif value="{{$member->id}}">
                                                            {{$member->display_name}} ({{\App\Watches::where('UyeID', $member->id)->where('Onay', 0)->count()}})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <?php
                                                $ay    =date("m");
                                                $yil   =date("Y");
                                                $songun=cal_days_in_month(CAL_GREGORIAN,$ay,$yil);
                                            ?>
                                            @if(\Request::get('TarihBAS') != '')
                                                <div class="col-md-2">
                                                    <label>{{$text['date_from']}}</label>
                                                    <input type="date" value="{{\Request::get('TarihBAS')}}" class="form-control" name="TarihBAS" onchange='this.form.submit()'>
                                                </div>
                                            @else 
                                                <div class="col-md-2">
                                                    <label>{{$text['date_from']}}</label>
                                                    <input type="date" value="{{date("Y")}}-01-01" class="form-control" name="TarihBAS" onchange='this.form.submit()'>
                                                </div>
                                            @endif
                                            
                                            @if(\Request::get('TarihBIT') != '')
                                                <div class="col-md-2">
                                                    <label>{{$text['date_end']}}</label>
                                                    <input type="date" value="{{\Request::get('TarihBIT')}}" class="form-control" name="TarihBIT" onchange='this.form.submit()'>
                                                </div>
                                            @else 
                                                <div class="col-md-2">
                                                    <label>{{$text['date_end']}}</label>
                                                    <input type="date" value="{{date("Y-m")}}-{{$songun}}" class="form-control" name="TarihBIT" onchange='this.form.submit()'>
                                                </div>
                                            @endif

                                            <div class="col-md-2">
                                                <label>{{$text['checked']}}</label>
                                                <select class="form-control" name="Onay" onchange='this.form.submit()'>
                                                    <option @if(\Request::get('Onay') == 1) selected @endif value="1">{{$text['not_checked']}}</option>
                                                    <option @if(\Request::get('Onay') == 3) selected @endif value="3">{{$text['verified']}}</option>
                                                    <option @if(\Request::get('Onay') == 2) selected @endif value="2">{{$text['all']}}</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <form method="POST" class="table-responsive-xl form-confirmall-time" action="{{route('admin.hr-control.confirmall')}}">
                            @csrf
                            <table id="example1" class="table  table-hover table-striped" data-page-length='50' data-order='[[1, "asc"]]'>
                                <thead>
                                    <tr style="background-color: #D3D3D3">
                                        <th>
                                            <div class="icheck-danger d-inline">
                                                <input type="checkbox" class="selectable-all" id="checkboxDanger0">
                                                <label for="checkboxDanger0">
                                                </label>
                                            </div>
                                        </th>
                                        <th>{{$lang::settings('Isci_Paneli_Tarih')}}</th>
                                        <th>{{$lang::settings('Isci_Paneli_Saat')}}</th>
                                        <th>{{$lang::settings('Isci_Paneli_Proje')}}</th>
                                        <th>{{$lang::settings('Dokum_Auslose')}}</th>
                                        <th>{{$lang::settings('Isci_Paneli_Gunduz_Mu')}}</th>
                                        <th>{{$lang::settings('Islem_Onay_Durumu')}}</th>
                                        <th>{{$lang::settings('Admin_Dokum_Tatil_Gunumu')}}</th>
                                        <th><i class="fas fa-pen-square" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($table_data) > 0)
                                        @foreach($table_data as $data)
                                        <tr>
                                            <td>
                                                <div class="icheck-danger d-inline">
                                                    <input name="SilID[]" type="checkbox" class="selectable-item" id="checkboxDanger{{$data->SaatID}}" value="{{$data->SaatID}}">
                                                    <label for="checkboxDanger{{$data->SaatID}}">
                                                    </label>
                                                </div>

                                            </td>
                                            <td>{{$data->Tarih}}</td>
                                            <td>{{$data->Saat}}</td>
                                            <td>
                                                @if($data->ProjeBASLIK != '')
                                                    {{\App\Project::where('ProjeID', $data->ProjeID)->first()->ProjeBASLIK}} / {{$data->ProjeBASLIK}}
                                                @else 
                                                    {{\App\Project::where('ProjeID', $data->ProjeID)->first()->ProjeBASLIK}}
                                                @endif
                                            </td>
                                            <td>
                                                {{\App\Code::where('KodID', $data->Kod)->first()->KodBASLIK}}
                                            </td>
                                            <td>
                                                @if($data->Gunduz == 1)
                                                    <span class="badge badge-light">{{$lang::settings('Isci_Paneli_Gündüz')}}</span>
                                                @else 
                                                    <span class="badge badge-danger">{{$lang::settings('Isci_Paneli_Gece')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->Onay == 1)
                                                    <span class="badge badge-secondary">{{$lang::settings('Admin_Onayli')}}</span>
                                                @else 
                                                    <span class="badge badge-danger">{{$lang::settings('Admin_Onaysiz')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(\App\Helpers\System::tatilmi_bak($data->Tarih) == false)
                                                    <span class="badge badge-pill badge-light">{{$lang::settings('Dokum_Tablosu_Tatil_Degil')}}</span>
                                                @else 
                                                    <span class="badge badge-pill badge-warning">{{$lang::settings('Dokum_Tablosu_Tatil')}}</span>
                                                @endif 

                                                @if($data->Calisti == 0)
                                                    <span class="badge badge-light">{{$lang::settings('Isci_Paneli_Calismadi')}}</span>
                                                @else 
                                                    <span class="badge badge-info">{{$lang::settings('Isci_Paneli_Calisti')}}</span>
                                                @endif
                                        
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown pull-right">
                                                    <button type="button" class="btn btn-block btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">{!!$lang::settings('Isci_Paneli_Islem_Seciniz')!!}</button>
                                                    <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu">
                                                        <button type="button" class="dropdown-item btn-edit-time" data-id="{{$data->SaatID}}" role="menuitem">Bearbeiten</button>
                                                        <button type="button" class="dropdown-item btn-delete-time" data-id="{{$data->SaatID}}" role="menuitem">{{$lang::settings('Isci_Paneli_Sil')}}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>{{$table_data_saat}} Std.</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>


                            <div class="col-md-12">
                                <input style="height: 37px; width: 170px;" type="submit" class="btn btn-success" value="{{$lang::settings('Isci_Paneli_Secilenleri_Onayla')}}">
                            </div>  
                        </form>
                        
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
</section>
@endsection

@section('modals')
<div class="modal fade" tabindex="-1" id="modal-add" aria-labelledby="bearbeiten">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form method="POST" class="form-add-time" action="{{route('admin.hr-control.add')}}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$lang::settings('Admin_Panel_Saatler_Ekle')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Seciniz')}}</label>
                        <select class="form-control " required name="UyeID">
                            @foreach($all_members as $member)
                                <option @if(\Request::get('UyeID') == $member->id) selected @endif value="{{$member->id}}">
                                    {{$member->display_name}} ({{\App\Watches::where('UyeID', $member->id)->where('Onay', 0)->count()}})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Proje_Seciniz')}}</label>
                        <select class="form-control " required name="ProjeID">
                            <option value="" disabled selected>{{$lang::settings('Isci_Paneli_Proje_Seciniz')}}</option>
                            @foreach($projects as $project)
                                <option value="{{$project->ProjeID}}">{{$project->ProjeBASLIK}}</option>
                            @endforeach
                        </select>
                    </div>
					<div class="form-group col-md-6">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Proje_Giriniz')}}</label>
                        <input type="text" class="form-control " required id="inputBasicFirstName" name="ProjeBASLIK">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Tarih')}}</label>
                        <input type="date" class="form-control " required id="inputBasicFirstName" name="Tarih">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Saat')}}</label>
                        <select type="text" class="form-control " required id="inputBasicFirstName" name="Saat">
                                <option value="0.0">0:00</option>
                                <option value="0.5">0:30</option>
                                <option value="1">1:00</option>
                                <option value="1.5">1:30</option>
                                <option value="2">2:00</option>
                                <option value="2.5">2:30</option>
                                <option value="3">3:00</option>
                                <option value="3.5">3:30</option>
                                <option value="4">4:00</option>
                                <option value="4.5">4:30</option>
                                <option value="5">5:00</option>
                                <option value="5.5">5:30</option>
                                <option value="6">6:00</option>
                                <option value="6.5">6:30</option>
                                <option value="7">7:00</option>
                                <option value="7.5">7:30</option>
                                <option value="8">8:00</option>
                                <option value="8.5">8:30</option>
                                <option value="9">9:00</option>
                                <option value="9.5">9:30</option>
                                <option value="10">10:00</option>
                                <option value="10.5">10:30</option>
                                <option value="11">11:00</option>
								<option value="11.5">11:30</option>
                                <option value="12">12:00</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Gunduz_Mu')}}</label>
                        <select class="form-control " required name="Gunduz">
                            <option value="1">{{$lang::settings('Isci_Paneli_Gündüz')}}</option>
                            <option value="2">{{$lang::settings('Isci_Paneli_Gece')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Admin_Saatler_Ekle_Kod_Seciniz')}}</label>
                        <select class="form-control " required name="Kod">
                            @foreach($codes as $code)
                                <option value="{{$code->KodID}}">{{$code->KodBASLIK}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" tabindex="-1" id="modal-edit" aria-labelledby="bearbeiten">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form method="POST" class="form-edit-time" action="{{route('admin.hr-control.update')}}">
        @csrf
        <input type="hidden" name="SaatID">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$lang::settings('Admin_Panel_Saatler_Ekle')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Seciniz')}}</label>
                        <select class="form-control " required name="UyeID">
                            @foreach($all_members as $member)
                                <option @if(\Request::get('UyeID') == $member->id) selected @endif value="{{$member->id}}">
                                    {{$member->display_name}} ({{\App\Watches::where('UyeID', $member->id)->where('Onay', 0)->count()}})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Proje_Seciniz')}}</label>
                        <select class="form-control " required name="ProjeID">
                            <option value="" disabled selected>{{$lang::settings('Isci_Paneli_Proje_Seciniz')}}</option>
                            @foreach($projects as $project)
                                <option value="{{$project->ProjeID}}">{{$project->ProjeBASLIK}}</option>
                            @endforeach
                        </select>
                    </div>
					<div class="form-group col-md-6">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Proje_Giriniz')}}</label>
                        <input type="text" class="form-control " required id="inputBasicFirstName" name="ProjeBASLIK">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Tarih')}}</label>
                        <input type="date" class="form-control " required id="inputBasicFirstName" name="Tarih">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Saat')}}</label>
                        <select type="text" class="form-control " required id="inputBasicFirstName" name="Saat">
                                <option value="0.0">0:00</option>
                                <option value="0.5">0:30</option>
                                <option value="1">1:00</option>
                                <option value="1.5">1:30</option>
                                <option value="2">2:00</option>
                                <option value="2.5">2:30</option>
                                <option value="3">3:00</option>
                                <option value="3.5">3:30</option>
                                <option value="4">4:00</option>
                                <option value="4.5">4:30</option>
                                <option value="5">5:00</option>
                                <option value="5.5">5:30</option>
                                <option value="6">6:00</option>
                                <option value="6.5">6:30</option>
                                <option value="7">7:00</option>
                                <option value="7.5">7:30</option>
                                <option value="8">8:00</option>
                                <option value="8.5">8:30</option>
                                <option value="9">9:00</option>
                                <option value="9.5">9:30</option>
                                <option value="10">10:00</option>
                                <option value="10.5">10:30</option>
                                <option value="11">11:00</option>
								<option value="11.5">11:30</option>
                                <option value="12">12:00</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Gunduz_Mu')}}</label>
                        <select class="form-control " required name="Gunduz">
                            <option value="1">{{$lang::settings('Isci_Paneli_Gündüz')}}</option>
                            <option value="2">{{$lang::settings('Isci_Paneli_Gece')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Admin_Saatler_Ekle_Kod_Seciniz')}}</label>
                        <select class="form-control " required name="Kod">
                            @foreach($codes as $code)
                                <option value="{{$code->KodID}}">{{$code->KodBASLIK}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection 

@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.js')}}"></script>
<script src="{{asset('dist/js/jquery.maskedinput.js')}}" type="text/javascript" ></script>
<script src="{{asset('dist/js/validation_master.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $( document ).ready(function( $ ) {
        $(".telefoninput").mask("(999) 999 99 99",{placeholder:"(___) ___ __ __"});

        $('.defaultformajaxnone').validationForm({'ajaxType': false});
        $('.defaultformajaxtrue').validationForm({'ajaxType': true});

        bsCustomFileInput.init();
        $('#example1').DataTable( {
            "ordering": false
        } );

        $(".silbtn").click(function()
        {
            var href = $(this).attr("data-href");
            $(".mdlsilbtn").attr("href", href);
        })

        $('.form-add-time').on('submit', function(e){
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

                        setTimeout(function() { document.location = "{{route('admin.hr-control')}}"; }, 1000)
                    }
                }
            })
        });

        $('.form-edit-time').on('submit', function(e){
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

                        setTimeout(function() { location.reload() }, 1000)
                    }
                }
            })
        });

        $('.form-confirmall-time').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp){
                    if(resp.success){
                        setTimeout(function() { location.reload() }, 1000)
                    }
                }
            })
        });

        $('.btn-edit-time').on('click', function(){
            $('#modal-edit').modal('show');

            $.ajax({
                url: "{{route('admin.hr-control.edit')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    SaatID: $(this).data('id'),
                },
                success: function(resp){
                    let form = $('.form-edit-time');

                    form.find('input[name=SaatID]').val(resp.SaatID);
                    form.find('select[name=ProjeID]').val(resp.ProjeID);
                    form.find('input[name=ProjeBASLIK]').val(resp.ProjeBASLIK);
                    form.find('input[name=Tarih]').val(resp.Tarih);
                    form.find('select[name=Saat]').val(resp.Saat);
                    form.find('select[name=Gunduz]').val(resp.Gunduz);
                    form.find('select[name=Kod]').val(resp.Kod);
                }
            })
        });


    });


    $(".selectable-all").click(function()
    {
        $('.selectable-item').not(this).prop('checked', this.checked);
    });
</script>
@endsection

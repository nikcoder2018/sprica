<?php 
use App\Helpers\Language;
use App\Helpers\System;
$lang = new Language;
$system = new System;
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
                        <h3 class="card-title">{{$lang::settings('Menu_Avanslar')}}</h3>
                        <div><button data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)" class="btn btn-xs btn-success float-sm-right"> <i style="color:white" class="nav-icon fas fa-edit"></i></button></div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body table-responsive-xl">
                        <form method="POST">
                            <table id="example1" class="table table-hover table-striped ttable-responsive-xl" data-page-length='100' ddata-order='[[0, "asc"]]'>
                                <thead>
                                <tr style="background-color: #D3D3D3">
                                    <th>{{$lang::settings('Avans_Tarih_iki_Giriniz')}}</th>
                                    <th>{{$lang::settings('Avans_Tarih_Giriniz')}}</th>

                                    <th>{{$lang::settings('Avans_Tutar_Giriniz')}}</th>
                                    <th>{{$lang::settings('Avans_Uye_Seciniz')}}</th>
                                    <th colspan="1">{{$lang::settings('Avaslar_Eldenmi')}}</th>
                                    <th></th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($all_advances) > 0)
                                        @foreach($all_advances as $advance)
                                        <tr>
                                            <td>{{$system::cevir($advance->Tarih2)}}</td>
                                            <td>{{$system::cevir($advance->Tarih)}}</td>
                                            <td>{{$advance->Tutar}}</td>
                                            <td>{{App\User::where('id', $advance->UyeID)->first()->name}}</td>
                                            <td>
                                                @if($advance->Eldenmi==1)
                                                    {{$lang::settings('Avanslar_Bankadan')}}
                                                @else 
                                                    {{$lang::settings('Avanslar_Elden')}}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                   
                                    <th>{{$lang::settings('Avans_Tarih_iki_Giriniz')}}</th>
                                    <th>{{$lang::settings('Avans_Tarih_Giriniz')}}</th>

                                    <th>{{$lang::settings('Avans_Tutar_Giriniz')}}</th>
                                    <th>{{$lang::settings('Avans_Uye_Seciniz')}}</th>
                                    <th>{{$lang::settings('Avaslar_Eldenmi')}}</th>
                                    <th></th>
                                    
                                </tr>
                                </tfoot>
                            </table>
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
<!-- /.content -->
@endsection

@section('modals')
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <form class="form-add" method="POST" action="{{route('admin.hr-wages-advance')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hinzufügen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Avans_Uye_Seciniz')}}</label>
                                <select class="form-control" name="UyeID">
                                    @foreach($all_members as $member)
                                        <option @if(\Request::get('UyeID') == $member->id) selected @endif value="{{$member->id}}">
                                            {{$member->name}}
                                        </option>
                                    @endforeach
                                </select>
                                
                            </div>
                            @php 
                                $yil = date("Y");
                                $ay = date("m");
                                $yill = date("Y")-1;
                            @endphp

                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Avans_Tarih_iki_Giriniz')}}</label>
                                <input type="date" required class="form-control" id="inputBasicFirstName" name="Tarih2" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Avans_Tarih_Giriniz')}}</label>
                                <select type="date" required class="form-control" id="inputBasicFirstName" name="Tarih" placeholder="">                              
                                    <option value="{{$yil}}-01-01">Januar</option>
                                    <option value="{{$yil}}-02-01">Februar</option>
                                    <option value="{{$yil}}-03-01">März</option>
                                    <option value="{{$yil}}-04-01">April</option>
                                    <option value="{{$yil}}-05-01">Mai</option>
                                    <option value="{{$yil}}-06-01">Juni</option>
                                    <option value="{{$yil}}-07-01">Juli</option>
                                    <option value="{{$yil}}-08-01">August</option>
                                    <option value="{{$yil}}-09-01">September</option>
                                    <option value="{{$yil}}-10-01">Oktober</option>
                                    <option value="{{$yil}}-11-01">November</option>
                                    <option value="{{$yil}}-12-01">Dezember {{$yil}}</option>
                                    <option value="{{$yill}}-12-01">Dezember {{$yill}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Avans_Tutar_Giriniz')}}</label>
                                <input type="text" required class="form-control" id="inputBasicFirstName" name="Tutar" placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Avaslar_Eldenmi')}}</label>
                                <select class="form-control" name="Eldenmi">
                                    <option value="1">{{$lang::settings('Avanslar_Bankadan')}}</option>
                                    <option value="2">{{$lang::settings('Avanslar_Elden')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="{{route('admin.hr-wages-advance')}}" class="btn btn-default" >Abbrechen</a>
                        <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                    </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>   
@endsection

@section('scripts')
    <script>
        $('.form-add').on('submit', function(e){
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
    </script>
@endsection

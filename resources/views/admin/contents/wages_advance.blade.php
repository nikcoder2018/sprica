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
                                            <td></td>
                                            <td></td>
                                            {{--
                                            <td><?=$db->cevir ($row->Tarih2)?></td>
                                            <td><?=$db->cevir ($row->Tarih)?></td>
                                            --}}
                                            <td>{{$advance->Tutar}}</td>
                                            <td>{{App\Watches::where('UyeID', $advance->UyeID)->first()->UyeADISOYADI}}</td>
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
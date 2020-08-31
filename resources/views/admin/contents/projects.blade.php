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
                <div class="card card-info ">
                    <div class="card-header">
                        <h3 class="card-title">Projekte</h3>
                        <a data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)" class="btn btn-xs btn-success float-sm-right"> <i class="fas fa-pen-square" aria-hidden="true"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body table-responsive-md">
                        <form method="POST" class="form-add-project">
                            <table id="example1" class="table table-hover ttable-bordered table-striped" data-order='[[1, "asc"]]' data-page-length='100'>
                                <thead>
                                <tr style="background-color: #D3D3D3">
                                    <th>{{$lang::settings('Admin_Projeler_Proje_Basligi')}}</th>
                                    <th>{{$lang::settings('Admin_Projeler_Proje_Kodu')}}</th>
                                    <th>{{date("Y")}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($projects) > 0)
                                        @foreach($projects as $project)
                                        <tr>
                                            <td>{{$project->ProjeBASLIK}}</td>
                                            <td>{{$project->ProjeKODU}}</td>
                                            <td>
                                                {{\App\Watches::where('Tarih', '>=', Carbon\Carbon::create(date('Y'), 1,1)->toDateString())->where('Tarih', '<=', Carbon\Carbon::create(date('Y'),12,31)->toDateString())->where('ProjeID', $project->ProjeID)->sum('Saat')}}
                                                Std.
                                            </td>
                                            <td class="text-right">
                                            </td>

                                        </tr>
                                       @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    
                                    <th>{{$lang::settings('Admin_Projeler_Proje_Basligi')}}</th>
                                    <th>{{$lang::settings('Admin_Projeler_Proje_Kodu')}}</th>
                                    <th></th>
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
        <form class="defaultformajaxtrue" method="POST" action="{{route('admin.projects.store')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    {{$lang::settings('Admin_Projeler')}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName"> {{$lang::settings('Admin_Projeler_Proje_Basligi')}}</label>
                            <input class="form-control " required name="ProjeBASLIK" value="" />
                        </div>
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName"> {{$lang::settings('Admin_Projeler_Proje_Kodu')}}</label>
                            <input class="form-control " required name="ProjeKODU" value="" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{route('admin.projects')}}" type="button" class="btn btn-default">Close</a>
                    <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>

@endsection 

@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#example1").DataTable();
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".silbtn").click(function () {
            var href = $(this).attr("data-href");
            $(".mdlsilbtn").attr("href",href);
        })
    })
</script>
<script type="text/javascript">
    $(".selectable-all").click(function(){
        $('.selectable-item').not(this).prop('checked', this.checked);
    });
</script>

<script src="{{asset('dist/js/jquery.maskedinput.js')}}" type="text/javascript" ></script>
<script type="text/javascript">
    $( document ).ready(function( $ ) {
        $(".telefoninput").mask("(999) 999 99 99",{placeholder:"(___) ___ __ __"});
    });
</script>
<script src="{{asset('dist/js/validation_master.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.defaultformajaxnone').validationForm({'ajaxType': false});
        $('.defaultformajaxtrue').validationForm({'ajaxType': true});

        $('.form-add-project').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp){

                }
            })
        }); 
    })
</script>
@endsection
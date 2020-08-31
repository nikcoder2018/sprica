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
    .dataTables_length, .dataTables_filter, .dataTables_iinfo, .dataTables_paginate {
        display: none;
    }
</style>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container" style="margin-left:0px">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{$lang::settings('Admin_Kodlar')}}</h3>
                        <div><button data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)" class="btn btn-xs btn-success float-sm-right"> <i style="color:white" class="nav-icon fas fa-play-circle"></i></button></div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-hover table-bordered table-striped" data-order='[[1, "asc"]]' data-page-length='100'>
                            <thead>
                            <tr>
                                <th>{{$lang::settings('Kodlar_Kod_Basligi')}}</th>
                                <th>{{$lang::settings('Kodlar_Kod')}}</th>
                                <th>{{$lang::settings('Kodlar_Para_Bir')}}</th>
                                <th>{{$lang::settings('Kodlar_Para_Iki')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($codes as $code)
                                    <tr>
                                        <td>{{$code->KodBASLIK}}</td>
                                        <td>{{$code->Kod}}</td>
                                        <td>{{$code->Parabir}}</td>
                                        <td>{{$code->Paraiki}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{$lang::settings('Kodlar_Kod_Basligi')}}</th>
                                <th>{{$lang::settings('Kodlar_Kod')}}</th>
                                <th>{{$lang::settings('Kodlar_Para_Bir')}}</th>
                                <th>{{$lang::settings('Kodlar_Para_Iki')}}</th>
                            </tr>
                            </tfoot>
                        </table>
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
<!-- ./wrapper -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <form class="form-add-code" method="POST" action="{{route('admin.settings.code-add')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{$lang::settings('Admin_Kodlar')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Kodlar_Kod_Basligi')}}</label>
                            <input class="form-control " required name="KodBASLIK"/>
                        </div>
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Kodlar_Kod')}}</label>
                            <input class="form-control " required name="Kod"/>
                        </div>
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Kodlar_Para_Bir')}}</label>
                            <input class="form-control " required name="Parabir"/>
                        </div>
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Kodlar_Para_Iki')}}</label>
                            <input class="form-control " required name="Paraiki"/>
                        </div>

                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Kodlar_Yatti_Mi')}}</label>
                            <select class="form-control " required name="Yatti">
                                <option value="0">{{$lang::settings('Kodlar_Hayir')}}</option>
                                <option value="1">{{$lang::settings('Kodlar_Evet')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{route('admin.settings.code')}}" type="button" class="btn btn-default">Close</a>
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
<script src="{{asset('plugins/select2/js/select2.js')}}"></script>
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
    })
</script>
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#example1").DataTable();
    });
</script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $(".silbtn").click(function()
        {
            var href = $(this).attr("data-href");
            $(".mdlsilbtn").attr("href", href);
        })
    })
</script>
<script type="text/javascript">
    $(".selectable-all").click(function()
    {
        $('.selectable-item').not(this).prop('checked', this.checked);
    });

    $('.form-add-code').on('submit', function(e){
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

                    setTimeout(function() { document.location = "{{route('admin.settings.code')}}"; }, 1000)
                }
            }
        })
    })
</script>
@endsection
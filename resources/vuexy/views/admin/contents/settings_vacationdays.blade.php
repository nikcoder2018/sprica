<?php 
use App\Helpers\Language;
$lang = new Language;
?>

@extends('layouts.admin.main')

@section('stylesheets')
<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link href="{{asset('dist/css/validation_master.css')}}" rel="stylesheet">
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
                        <h3 class="card-title">{{$lang::settings('Admin_Tatil_Gunleri')}}</h3>
                        <div><button data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)" class="btn btn-xs btn-success float-sm-right"> <i style="color:white" class="nav-icon fas fa-play-circle"></i></button></div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped" data-page-length='10' data-order='[[0, "desc"]]'>
                            <thead>
                            <tr>
                                <th>{{$lang::settings('Admin_Tatil_Gunleri_Tarih')}}</th>
                                <th>Feiertag</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($vacationdays as $vacation)
                                    <tr>
                                        <td>{{$vacation->Tarih}}</td>
                                        <td>{{$vacation->GunBASLIK}}</td>
                                        
                                        <td class="text-right">
                                            <div class="dropdown pull-right">
                                                <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">{!!$lang::settings('Isci_Paneli_Islem_Seciniz')!!}</button>
                                                <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu">
                                                    <button class="dropdown-item btn-edit" data-id="{{$vacation->GunID}}">{{$lang::settings('Admin_Duzenle')}}</button>
                                                    <button class="dropdown-item btn-delete" data-id="{{$vacation->GunID}}">{{$lang::settings('Isci_Paneli_Sil')}}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                
                                <th>{{$lang::settings('Admin_Tatil_Gunleri_Tarih')}}</th>
                                <th>Feiertag</th>
                                <th></th>
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
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <form class="form-add-vacationdays" method="POST" action="{{route('admin.settings.vacationdays-add')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title">{{$lang::settings('Admin_Tatil_Gunleri')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Tatil_Gunleri_Tarih')}}</label>
                            <input class="form-control " required type="date" name="Tarih"/>
                        </div>

                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Tatil_Ismi')}}</label>
                            <input class="form-control " required type="text" name="GunBASLIK"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>

<div class="modal fade" id="modal-lg-edit">
    <div class="modal-dialog modal-lg">
        <form class="form-edit-vacationdays" method="POST" action="{{route('admin.settings.vacationdays-update')}}">
            @csrf
            <input type="hidden" name="GunID">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title">{{$lang::settings('Admin_Tatil_Gunleri')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Tatil_Gunleri_Tarih')}}</label>
                            <input class="form-control " required type="date" name="Tarih"/>
                        </div>

                        <div class="form-group col-md-12 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Tatil_Ismi')}}</label>
                            <input class="form-control " required type="text" name="GunBASLIK"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>

<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">{{$lang::settings('Isci_Paneli_Kaydi_Sil')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>{{$lang::settings('Isci_Paneli_Emin_Misiniz')}}</strong></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{$lang::settings('Isci_Paneli_Hayir')}}</button>
                <button class="btn btn-outline-light btn-delete-go">{{$lang::settings('Isci_Paneli_Evet_Sil')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

    $('.form-add-vacationdays').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                Toast.fire({
                        icon: 'success',
                        title: resp.msg,
                        showConfirmButton: false,
                    });

                    setTimeout(function() { document.location = "{{route('admin.settings.vacationdays')}}"; }, 1000)
            }
        })
    });

    $('.form-edit-vacationdays').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                Toast.fire({
                        icon: 'success',
                        title: resp.msg,
                        showConfirmButton: false,
                    });

                setTimeout(function() { document.location = "{{route('admin.settings.vacationdays')}}"; }, 1000)
            }
        })
    });

    $('.btn-edit').on('click', function(){
        $("#modal-lg-edit").modal('show');
        let form = $('.form-edit-vacationdays');
        $.ajax({
            url: "{{route('admin.settings.vacationdays-edit')}}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                GunID : $(this).data('id')
            },
            success: function(resp){
                form.find('input[name=GunID]').val(resp.GunID);
                form.find('input[name=Tarih]').val(resp.Tarih);
                form.find('input[name=GunBASLIK]').val(resp.GunBASLIK);
            }
        })
    });

    $('.btn-delete').on('click', function(){
        $('#modal-danger').modal('show');
        $('.btn-delete-go').attr('data-id', $(this).data('id'));
    });

    $('.btn-delete-go').on('click', function(){
        $.ajax({
            url: "{{route('admin.settings.vacationdays-delete')}}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                GunID : $(this).data('id')
            },
            success: function(resp){
                if(resp.success){
                    Toast.fire({
                        icon: 'success',
                        title: resp.msg,
                        showConfirmButton: false,
                    });

                    setTimeout(function() { document.location = "{{route('admin.settings.vacationdays')}}"; }, 1000)
                }
            }
        })
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
    })
</script>
@endsection
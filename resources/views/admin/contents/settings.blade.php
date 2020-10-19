<?php 
use App\Helpers\Language;
$lang = new Language;
?>

@extends('layouts.admin.main')

@section('stylesheets')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">

@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                      <ul class="nav nav-tabs" id="settings-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="settings-general-tabs" data-toggle="pill" href="#settings-tabs-general" role="tab" aria-controls="settings-tabs-general" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="settings-language-tabs" data-toggle="pill" href="#settings-tabs-language" role="tab" aria-controls="settings-tabs-language" aria-selected="false">Language</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-release-tabs" data-toggle="pill" href="#settings-tabs-release" role="tab" aria-controls="settings-tabs-release" aria-selected="false">Codes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-holidays-tabs" data-toggle="pill" href="#settings-tabs-holidays" role="tab" aria-controls="settings-tabs-holidays" aria-selected="false">Holidays</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="settings-ticket-types-tabs" data-toggle="pill" href="#settings-tabs-ticket-types" role="tab" aria-controls="ettings-tabs-ticket-types" aria-selected="false">Ticket Types</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="settings-tabs-content">
                        <div class="tab-pane fade active show" id="settings-tabs-general" role="tabpanel" aria-labelledby="#settings-tabs-general">
                            <form class="form-update-gensettings" action="{{route('admin.settings.general-update')}}" method="POST">
                                @csrf
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">{{$lang::settings('admin_genel_ayarlar')}}</h3>
                                    </div>
            
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label" for="inputBasicLastName">{{$lang::settings('Admin_Site_URL')}}</label>
                                                <input type="text" value="{{$genset->SiteURL}}" name="SiteURL" id="form-field-16" class="form-control " required>
                                            </div>
        
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label" for="inputBasicLastName">{{$lang::settings('Bir_Gun_Proje')}}</label>
                                                <input type="text" value="{{$genset->KacSAAT}}" name="KacSAAT" id="form-field-16" class="form-control " required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="settings-tabs-language" role="tabpanel" aria-labelledby="#settings-tabs-language">
                            <form autocomplete="off" enctype="multipart/form-data" class="ajaxFormFalse" action="" method="POST">
                                <div class="card-body table-responsive-md">
                                    <table class="table table-striped ttable-bordered datatable-extended">
                                        <thead>
                                        <tr>
                                            <th>Sprache</th>
                                            <th class="text-right">Bearbeiten</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Deutsch</td>
                                                <td class="text-right">
                                                    <div class="dropdown pull-right">
                                                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Bearbeiten</button>
                                                        <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu">
                                                            <a class="dropdown-item" href="{{route('admin.settings.language', 'edit')}}" role="menuitem">Bearbeiten</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <div class="tab-pane fade" id="settings-tabs-release" role="tabpanel" aria-labelledby="#settings-tabs-release">
                            <div style="height:51px" class="card card-default color-palette-bo">
                                <div style="height:51px" class="card-header">
                                    <div class="d-inline-block">
                                      <h3 class="card-title"><i class="fa fa-code"></i> Codes</h3>
                                    </div>
                                    <div class="d-inline-block float-right">
                                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#add_code_modal"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default color-palette-bo">
                                <div class="card-body">
                                    <table id="example1" class="table table-hover table-bordered table-striped table-code" data-order='[[1, "asc"]]' data-page-length='100'>
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
                        </div>
                        <div class="tab-pane fade" id="settings-tabs-holidays" role="tabpanel" aria-labelledby="#settings-tabs-holidays">
                            <div style="height:51px" class="card card-default color-palette-bo">
                                <div style="height:51px" class="card-header">
                                    <div class="d-inline-block">
                                      <h3 class="card-title"><i class="fa fa-compass"></i> Holidays</h3>
                                    </div>
                                    <div class="d-inline-block float-right">
                                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#add_vacation_modal"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default color-palette-bo">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-vacation" data-page-length='10' data-order='[[0, "desc"]]'>
                                        <thead>
                                        <tr>
                                            <th>{{$lang::settings('Admin_Tatil_Gunleri_Tarih')}}</th>
                                            <th>Feiertag</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($vacationdays as $vacation)
                                                <tr data-id="{{$vacation->GunID}}">
                                                    <td>{{$vacation->Tarih}}</td>
                                                    <td>{{$vacation->GunBASLIK}}</td>
                                                    
                                                    <td class="text-right">
                                                        <div class="dropdown pull-right">
                                                            <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">{!!$lang::settings('Isci_Paneli_Islem_Seciniz')!!}</button>
                                                            <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu">
                                                                <button class="dropdown-item btn-edit-vacation" data-id="{{$vacation->GunID}}">{{$lang::settings('Admin_Duzenle')}}</button>
                                                                <button class="dropdown-item btn-delete-vacation" data-id="{{$vacation->GunID}}">{{$lang::settings('Isci_Paneli_Sil')}}</a>
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
                        </div>
                        <div class="tab-pane fade" id="settings-tabs-ticket-types" role="tabpanel" aria-labelledby="#settings-tabs-ticket-types">
                            
                            <div style="height:51px" class="card card-default color-palette-bo">
                                <div style="height:51px" class="card-header">
                                    <div class="d-inline-block">
                                      <h3 class="card-title"><i class="fa fa-envelope"></i> Tickets</h3>
                                    </div>
                                    <div class="d-inline-block float-right">
                                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#add_type_modal"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default color-palette-bo">
                                <div class="card-body">
                                    <table id="example1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                   
                                            @foreach($ticket_types as $type)
                                            <tr>
                                                <td>{{ $type->name }}</td>
                                                <td>
                                                    <a href="#" class="btn-edit-type" data-id="{{ $type->id }}"><i class="fa fa-fw fa-edit text-primary"></i></a>
                                                    <a href="#" class="btn-delete-type" data-id="{{ $type->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
                                                </td>
                                            </tr>
                                            @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="modal fade" id="add_code_modal">
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
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<div class="modal fade" id="add_type_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('tickettypes.store') }}" class="form-add-type" method="POST"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Create Ticket Type</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" required>
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
<div class="modal fade" id="edit_type_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('tickettypes.update') }}" class="form-edit-type" method="POST"> 
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header"> 
                    <h4 class="modal-title">Update Ticket Type</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" required>
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
<div class="modal fade" id="add_vacation_modal">
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
<div class="modal fade" id="edit_vacation_modal">
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
@endsection

@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
    bsCustomFileInput.init();
    $("#example1").DataTable();

    $('.form-update-gensettings').on('submit', function(e){
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

                    setTimeout(function() { document.location = "{{route('admin.settings.general')}}"; }, 1000)
                }
            }
        })
    });

    $('.form-add-type').on('submit', function(e){
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

    $('.btn-edit-type').on('click', async function() {  
        let edit_modal = $('#edit_type_modal');
        let form = edit_modal.find('form');
        let id = $(this).data().id;
        edit_modal.modal();
        const type = await $.ajax({
            url: "{{ route('tickettypes.edit') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id
            }
        });

        form.find('input[name=id]').val(type.id);
        form.find('input[name=name]').val(type.name);
    });

    $('.form-edit-type').on('submit', function(e){
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

    $('.btn-delete-type').on('click', async function() {
        let id = $(this).data().id;

        Swal.fire({
            text: 'Are you sure you want to delete this type?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1"
        }).then(async result => {
            if(result.value){
                const delete_type = await $.ajax({
                    url: "{{ route('tickettypes.destroy') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    }
                });

                if(delete_type.success){
                    Swal.fire({
                        text: delete_type.msg,
                        type: 'success',
                    }).then(()=>{
                        location.reload();
                    });
                }
            }
        });
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

                setTimeout(function() { 
                    $('#add_vacation_modal').modal('toggle');
                    $('.table-vacation tbody').prepend(`
                    <tr data-id="${resp.details.GunID}">
                        <td>${resp.details.Tarih}</td>
                        <td>${resp.details.GunBASLIK}</td>
                        
                        <td class="text-right">
                            <div class="dropdown pull-right">
                                <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-pen-square" aria-hidden="true"></i></button>
                                <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu">
                                    <button class="dropdown-item btn-edit-vacation" data-id="${resp.details.GunID}">Bearbeiten}</button>
                                    <button class="dropdown-item btn-delete-vacation" data-id="${resp.details.GunID}">Löschen</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    `).hide().fadeIn(300);
                }, 1000);
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

                setTimeout(function() { 
                    $('#edit_vacation_modal').modal('toggle');
                    $('.table-vacation tbody tr[data-id='+resp.details.GunID+']').hide().replaceWith(
                        `
                        <tr data-id="${resp.details.GunID}">
                            <td>${resp.details.Tarih}</td>
                            <td>${resp.details.GunBASLIK}</td>
                            
                            <td class="text-right">
                                <div class="dropdown pull-right">
                                    <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-pen-square" aria-hidden="true"></i></button>
                                    <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu">
                                        <button class="dropdown-item btn-edit-vacation" data-id="${resp.details.GunID}">Bearbeiten}</button>
                                        <button class="dropdown-item btn-delete-vacation" data-id="${resp.details.GunID}">Löschen</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        `
                    ).fadeIn(1000);
                }, 1000);
            }
        })
    });

    $('.table-vacation').on('click','.btn-edit-vacation', function(){
        $("#edit_vacation_modal").modal('show');
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

    $('.table-vacation').on('click','.btn-delete-vacation', async function() {
        let id = $(this).data().id;

        Swal.fire({
            text: 'Are you sure you want to delete this vacation?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1"
        }).then(async result => {
            if(result.value){
                const deleteItem = await $.ajax({
                    url: "{{ route('admin.settings.vacationdays-delete') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        GunID : $(this).data('id')
                    }
                });

                if(deleteItem.success){
                    Swal.fire({
                        text: deleteItem.msg,
                        type: 'success',
                    }).then(()=>{
                        $('.table-vacation tbody tr[data-id='+deleteItem.id+']').fadeOut(600).remove();
                    });
                }
            }
        });
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

                    setTimeout(function() { 
                         $('#add_code_modal').modal('hide');
                         $('.table-code tbody').append(`
                            <tr>
                                <td>${resp.details.KodBASLIK}</td>
                                <td>${resp.details.Kod}</td>
                                <td>${resp.details.Parabir}</td>
                                <td>${resp.details.Paraiki}</td>
                            </tr>
                         `);
                    }, 1000);
                }
            }
        })
    })
</script>
@endsection
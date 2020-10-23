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
<div style="height:51px" class="card card-default color-palette-bo">
    <div style="height:51px" class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-users"></i> Personal</h3>
        </div>
        <div class="d-inline-block float-right">
            <a data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)"class="btn btn-sm btn-outline-primary"><i class="fa fa-user-plus"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card-body">
        <form action="{{route('admin.employees.filter')}}" class="filterdata" method="post" accept-charset="utf-8">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="type" class="form-control">
                            <option value="all">All</option>
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select name="status" class="form-control">                            
                            <option value="1">Active</option>
                            <option value="0">Disabled</option>
                            <option value="all">All Status</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Suchen...">
                    </div>
                </div>
            </div>
        </form> 
    </div>

    <div class="card">
        <div class="card-body">
           <!-- Load Admin list (json request)-->
           <div class="data_container">    
                <div class="datalist">
                    {!! view('admin.contents.employees-listtable', ['employees' => $employees])->render(); !!}
                </div>
            </div>
        </div>
       
   </div>
</div>

@endsection

@section('modals')
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <form class="form-add-user" method="POST" action="{{route('admin.employees.store')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Adi')}}</label>
                            <input class="form-control " required name="name"/>
                        </div>
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Kullanici_Adi')}}</label>
                            <input class="form-control " required name="username"/>
                        </div>
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Sifresi')}}</label>
                            <input class="form-control " required name="password"/>
                        </div>
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">Role</label>
                            <select name="role" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Personel_Numarasi')}}</label>
                            <input class="form-control " required name="number"/>
                        </div>

                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Personel_Departman')}}</label>
                            <input class="form-control " required name="department"/>
                        </div>

                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Personel_Saat_Ucreti')}}</label>
                            <input class="form-control " required name="hour_fee"/>
                        </div>

                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Vergi_Durumu')}}</label>
                            <input class="form-control " required name="tax_status"/>
                        </div>

                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Ise_Giris_Tarihi')}}</label>
                            <input type="date" class="form-control " required name="login_date"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Izin_Gunu')}}</label>
                            <input class="form-control " required name="day_off"/>
                        </div>


                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Sokak_ve_Ev_Numarasi')}}</label>
                            <input class="form-control " required name="street"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Posta_Kodu_ve_Yer')}}</label>
                            <input class="form-control " required name="postal_code" />
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Dogum_Tarihi')}}</label>
                            <input type="date" class="form-control " required name="date_of_birth"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Dogum_Yeri')}}</label>
                            <input class="form-control " required name="place_of_birth"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Milliyet')}}</label>
                            <input class="form-control " required name="nationality"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Sosyal_Guvenlik_Numarasi')}}</label>
                            <input class="form-control " required name="sg_number"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Saglik_Sigortasi')}}</label>
                            <input class="form-control " required name="health_insurance"/>
                        </div>
                        
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Cikis')}}</label>
                            <input class="form-control " required name="exit"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Islev')}}</label>
                            <input class="form-control " required name="function"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_ST_Id_Num')}}</label>
                            <input class="form-control " required name="STIDNUM"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Ehliyet')}}</label>
                            <select class="form-control " required name="driving_license">
                            <option>Nein</option> <option>Ja</option></select>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_VDS_Kimligi')}}</label>
                            <select class="form-control " required name="vds_identity">
                            <option>Nein</option> <option>Ja</option></select>
                        </div>
                            <div class="form-group col-md-12 m05">
                            
                            </div>
                
                        
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Banka')}}</label>
                            <input class="form-control " required name="bank"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Iban')}}</label>
                            <input class="form-control " required name="IBAN"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Bic')}}</label>
                            <input class="form-control " required name="BIC"/>
                        </div>

                        <div class="col-md-12 vCheckRequired">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Bic')}}</label>

                            @foreach(App\Code::orderBy('KOD', 'ASC')->get() as $code)
                                <div>
                                    <input @if(count(App\EmployeeCode::where('PersonelID', Request::get('id'))->where('KodID', $code->KodID)->get()) > 0) checked @endif value="{{$code->KodID}}" type="checkbox" name="codes[{{$code->KodID}}]"> {{$code->KodBASLIK}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{route('admin.employees')}}" type="button" class="btn btn-default">Close</a>
                    <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <form class="form-update-user" method="POST" action="{{route('admin.employees.update')}}">
            @csrf 
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    Personal
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Adi')}}</label>
                            <input class="form-control"  name="name" required/>
                        </div>
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Kullanici_Adi')}}</label>
                            <input class="form-control "  name="username" required/>
                        </div>
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Sifresi')}}</label>
                            <input class="form-control "  name="password"/>
                        </div>
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">Role</label>
                            <select name="role" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Personel_Numarasi')}}</label>
                            <input class="form-control "  name="number"/>
                        </div>

                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Personel_Departman')}}</label>
                            <input class="form-control "  name="department"/>
                        </div>

                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Personel_Saat_Ucreti')}}</label>
                            <input class="form-control "  name="hour_fee"/>
                        </div>

                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Vergi_Durumu')}}</label>
                            <input class="form-control "  name="tax_status"/>
                        </div>

                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Ise_Giris_Tarihi')}}</label>
                            <input type="date" class="form-control "  name="login_date"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Ekle_Izin_Gunu')}}</label>
                            <input class="form-control "  name="day_off"/>
                        </div>


                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Sokak_ve_Ev_Numarasi')}}</label>
                            <input class="form-control "  name="street"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Posta_Kodu_ve_Yer')}}</label>
                            <input class="form-control "  name="postal_code" />
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Dogum_Tarihi')}}</label>
                            <input type="date" class="form-control "  name="date_of_birth"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Dogum_Yeri')}}</label>
                            <input class="form-control "  name="place_of_birth"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Milliyet')}}</label>
                            <input class="form-control "  name="nationality"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Sosyal_Guvenlik_Numarasi')}}</label>
                            <input class="form-control "  name="sg_number"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Saglik_Sigortasi')}}</label>
                            <input class="form-control "  name="health_insurance"/>
                        </div>
                        
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Cikis')}}</label>
                            <input class="form-control "  name="exit"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Islev')}}</label>
                            <input class="form-control "  name="function"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_ST_Id_Num')}}</label>
                            <input class="form-control "  name="STIDNUM" required/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Ehliyet')}}</label>
                            <select class="form-control "  name="driving_license">
                            <option>Nein</option> <option>Ja</option></select>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_VDS_Kimligi')}}</label>
                            <select class="form-control "  name="vds_identity">
                            <option>Nein</option> <option>Ja</option></select>
                        </div>
                            <div class="form-group col-md-12 m05">
                            
                            </div>
                
                        
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Banka')}}</label>
                            <input class="form-control "  name="bank" required/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Iban')}}</label>
                            <input class="form-control "  name="IBAN"/>
                        </div>
                        <div class="form-group col-md-4 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Bic')}}</label>
                            <input class="form-control "  name="BIC"/>
                        </div>

                        <div class="col-md-12 vCheck">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Admin_Personel_Ekle_Bic')}}</label>

                            @foreach(App\Code::orderBy('KOD', 'ASC')->get() as $code)
                                <div>
                                    <input value="{{$code->KodID}}" type="checkbox" name="codes[{{$code->KodID}}]"> {{$code->KodBASLIK}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button data-dismiss="modal" type="button" class="btn btn-default">Close</button>
                    <button  type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
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
    $(document).ready(function(){
        bsCustomFileInput.init();
        $("#example1").DataTable({
            "order": [[ 1,"asc"]],
            "pageLength": 25
        });

        $(".silbtn").click(function(){
            var href = $(this).attr("data-href");
            $(".mdlsilbtn").attr("href", href);
        });

        $('.form-add-user').on('submit', function(e){
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

        $('.btn-edit').on('click', function(e){
            e.preventDefault();
            $('#modal-edit').modal('show');
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


    })

    $(".selectable-all").click(function(){
        $('.selectable-item').not(this).prop('checked', this.checked);
    });

    $('.filterdata').on('change', 'select[name=type],select[name=status]', function(){
        filterData();
    });
    $('.filterdata').on('keyup', 'input[name=keyword]', function(){
        filterData();
    });

    function filterData(){
        $.ajax({
            url: $('.filterdata').attr('action'),
            type: 'POST',
            data: $('.filterdata').serialize(),
            success: function(resp){
                $('.datalist').html(resp.result);
                $("#example1").DataTable({
                    "order": [[ 1, "asc" ]],
                    "pageLength": 25
                });
            }
        }); 
    }

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
                        title: resp.msg,
                        showConfirmButton: false,
                    });

                    setTimeout(function() { location.reload(); }, 1000)
                }
            }
        });
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
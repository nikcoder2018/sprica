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
<div class="container" style="margin-left: 0px">

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Personal</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <form class="filtreformu" method="GET" action="">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label>Wähle Personal</label>
                                            <select class="form-control" name="id" onchange='this.form.submit()'>
                                                <option disabled selected>Wähle Mitarbeiter</option>
                                                @foreach($employees as $employee)
                                                    <option @if(\Request::get('id') == $employee->id) selected @endif value="{{$employee->id}}">
                                                        {{$employee->display_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2" style="padding-top: 32px">
                                            <div class="btn-group">
                                              
                                              <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu" role="menu">
                                                    <a href="{{route('admin.employees.list')}}" class="dropdown-item">
                                                        <i class="fas fa-users"></i> Alle Mitarbeiter
                                                        <span class="float-right text-muted text-sm"></span>
                                                    </a> 
                                              </ul>
                                            </div> 

                                        </div>
                                        <div class="col-md-2" style="padding-top: 32px">
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if(isset($user_details))
                    <div style="margin-top: 15px" class="col-md-12">
                        <div class="row">                 
                            <div class="col-md-6">
                                <div class="card text-black bg-light">
                                    <div class="card-header bg-light text-center"><b>Personaldaten</b></div>
                                    <table style="text-align:left" class="table table-sm table-striped table-responsive-md table-hover">
                                            <tr>
                                                <td><b>{{$lang::settings('Personel_Adi')}}</b></td>
                                                <td>{{$user_details->display_name}}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Personel_Ekle_Personel_Numarasi')}}</b></td>
                                                <td>{{$user_details->number}}</td>
                                              
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Personel_Ekle_Personel_Departman')}}</b></td>
                                                <td>{{$user_details->department}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Personel_Ekle_Personel_Saat_Ucreti')}}</b></td>
                                                <td>{{$user_details->hour_fee}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Personel_Ekle_Vergi_Durumu')}}</b></td>
                                                <td>{{$user_details->tax_status}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Personel_Ekle_Ise_Giris_Tarihi')}}</b></td>
                                                <td><time datetime="{{$user_details->login_date}}">{{$user_details->login_date}}</time></td>
                                            </tr>
                                             <tr>
                                                <td><b>{{$lang::settings('Personel_Ekle_Izin_Gunu')}}</b></td>
                                                <td>{{$user_details->day_off}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Sokak_ve_Ev_Numarasi')}}</b></td>
                                                <td>{{$user_details->street}}</td>
                                            </tr>

                                            <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Posta_Kodu_ve_Yer')}}</b></td>
                                                <td>{{$user_details->postal_code}}</td>
                                            </tr>

                                            <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Dogum_Tarihi')}}</b></td>
                                                <td>{{$user_details->date_of_birth}}</td>
                                            </tr>

                                            <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Dogum_Yeri')}}</b></td>
                                                <td>{{$user_details->place_of_birth}}</td>
                                            </tr>
                                             <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Milliyet')}}</b></td>
                                                <td>{{$user_details->nationality}}</td>
                                            </tr>
                                             <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Sosyal_Guvenlik_Numarasi')}}</b></td>
                                                <td>{{$user_details->sg_number}}</td>
                                            </tr>
                                             <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Saglik_Sigortasi')}}</b></td>
                                                <td>{{$user_details->health_insurance}}</td>
                                            </tr>
                                            
                                             <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Cikis')}}</b></td>
                                                <td>{{$user_details->exit}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Islev')}}</b></td>
                                                <td>{{$user_details->function}}</td>
                                            </tr>
                                             <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_ST_Id_Num')}}</b></td>
                                                <td>{{$user_details->STIDNUM}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Ehliyet')}}</b></td>
                                                <td>{{$user_details->driving_license}}</td>
                                            </tr>
                                             <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_VDS_Kimligi')}}</b></td>
                                                <td>{{$user_details->vds_identity}}</td>
                                            </tr>

                                            
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <div class="card text-black bg-light mb-4">
                                    <div class="card-header bg-light text-center"><b>Login Daten</b></div>
                                    <div>
                                        <table style="color: #424242" class="table table-sm table-striped table-responsive-md table-hover">
                                            <tr>
                                                <td><b>{{$lang::settings('Personel_Kullanici_Adi')}}</b></td>
                                                <td>{{$user_details->username}}</td> 
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Personel_Sifresi')}}</b></td>
                                                <td>{{$user_details->password}}</td> 
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="card text-black bg-light mb-4">
                                    <div class="card-header bg-light text-center"><b>Auslöse</b></div>
                                        <div style="width: 100%">
                                            <table style="width: 100%" class="table table-striped ttable-responsive-xl ttable-hover">
                                                <tr style="width: 100%">
                                                    <th style="font-size:15px;text-align:left">
                                                        @foreach(App\Code::orderBy('KOD', 'ASC')->get() as $code)
                                                        <div>
                                                            <input @if(count(App\EmployeeCode::where('PersonelID', Request::get('id'))->where('KodID', $code->KodID)->get()) > 0) checked @endif value="{{$code->KodID}}" type="checkbox" name="Kod-{{$code->KodID}}" disabled> {{$code->KodBASLIK}}
                                                        </div>
                                                        @endforeach
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card text-black bg-light">
                                        <div class="card-header bg-light text-center"><b>{{$lang::settings('Admin_Personel_Ekle_Banka_Baglantisi')}}</b></div>
                                        <table style="color: #424242" class="table table-sm table-striped table-responsive-md table-hover">
                                            
                                            <tr>
                                            
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Banka')}}</b></td>
                                                <td>{{$user_details->Banka}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Iban')}}</b></td>
                                                <td>{{$user_details->IBAN}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{{$lang::settings('Admin_Personel_Ekle_Bic')}}</b></td>
                                                <td>{{$user_details->BIC}}</td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="col-md-1">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12 text-right" style="margin-bottom: 15px; padding-right: 0px">
                                    <button data-id="{{Request::get('id')}}" class="btn btn-success btn-edit"><i class="icon wb-check" aria-hidden="true"></i>{{$lang::settings('Admin_Duzenle')}}</button>
                                </div>
                            </div>
                        </div>
                    @endif
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
<div class="modal fade" id="modal-lg">
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
                            <input class="form-control"  name="display_name" required/>
                        </div>
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Kullanici_Adi')}}</label>
                            <input class="form-control "  name="username" required/>
                        </div>
                        <div class="form-group col-md-6 m05">
                            <label class="form-control-label plabelno" for="inputBasicLastName">{{$lang::settings('Personel_Sifresi')}}</label>
                            <input class="form-control "  name="password" required/>
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
                    form.find('input[name=display_name]').val(user.display_name);
                    form.find('input[name=username]').val(user.username);
                    form.find('input[name=password]').val(user.password);
                    form.find('select[name=role]').val(user.role);
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

                }
            })
        });
    });
</script>
@endsection
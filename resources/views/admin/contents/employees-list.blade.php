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
                    <h3 class="card-title">Employees</h3>
                    <a data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)" class="btn btn-xs btn-success float-sm-right"> <i class="fas fa-pen-square" aria-hidden="true"></i></a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body table-responsive-md">
                 <!--   <div class="col-md-12 text-right" style="margin-bottom: 15px; padding-right: 0px">
                        <a data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)" class="btn btn-success"><i class="icon wb-check" aria-hidden="true"></i>Personal Hinzufügen</a>
                    </div> -->
                    <form method="POST">
                        <table id="example1" class="table table-sm table-hover ttable-bordered table-responsive-md table-striped" data-order='[[0, "asc"]]' data-page-length='100'>
                            <thead>
                            <tr style="background-color: #D3D3D3">
                                <th>{{$lang::settings('Personel_Adi')}}</th>
                                <th>Personalnr.</th>
                                <th>Urlaubsanspruch</th>
                                <th>{{$lang::settings('Personel_Kullanici_Adi')}}</th>
                                <th>{{$lang::settings('Personel_Sifresi')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($employees) > 0)
                                    @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$employee->display_name}}</td>
                                        <td>{{$employee->number}}</td>
                                        <td>{{$employee->day_off}}</td>
                                        <td>{{$employee->username}}</td>
                                        <td>{{$employee->password}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>{{$lang::settings('Personel_Adi')}}</th>
                                    <th>Personalnr.</th>
                                    <th>Urlaubsanspruch</th>
                                    <th>{{$lang::settings('Personel_Kullanici_Adi')}}</th>
                                    <th>{{$lang::settings('Personel_Sifresi')}}</th>
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
                            <input class="form-control " required name="display_name"/>
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
                    <a href="{{route('admin.employees.list')}}" type="button" class="btn btn-default">Close</a>
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
    $(document).ready(function(){
        bsCustomFileInput.init();
        $("#example1").DataTable();

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

                }
            })
        });

    })

    $(".selectable-all").click(function(){
        $('.selectable-item').not(this).prop('checked', this.checked);
    });
</script>


@endsection
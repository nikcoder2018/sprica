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
                        <div><button data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)" class="btn btn-xs btn-success float-sm-right"> <i style="color:white" class="nav-icon fas fa-play-circle"></i></button></div>
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
                                                            {{$member->display_name}} ({{\App\Watches::where('UyeID', $member->id)->sum('Onay')}})
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

                        <form method="POST" class="table-responsive-xl">
                            
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
                                        <th>{{\App\Helpers\Language::settings('Isci_Paneli_Tarih')}}</th>
                                        <th>{{\App\Helpers\Language::settings('Isci_Paneli_Saat')}}</th>
                                        <th>{{\App\Helpers\Language::settings('Isci_Paneli_Proje')}}</th>
                                        <th>{{\App\Helpers\Language::settings('Dokum_Auslose')}}</th>
                                        <th>{{\App\Helpers\Language::settings('Isci_Paneli_Gunduz_Mu')}}</th>
                                        <th>{{\App\Helpers\Language::settings('Islem_Onay_Durumu')}}</th>
                                        <th>{{\App\Helpers\Language::settings('Admin_Dokum_Tatil_Gunumu')}}</th>
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
                                                    <span class="badge badge-light">{{\App\Helpers\Language::settings('Isci_Paneli_Gündüz')}}</span>
                                                @else 
                                                    <span class="badge badge-danger">{{\App\Helpers\Language::settings('Isci_Paneli_Gece')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->Onay == 1)
                                                    <span class="badge badge-secondary">{{\App\Helpers\Language::settings('Admin_Onayli')}}</span>
                                                @else 
                                                    <span class="badge badge-danger">{{\App\Helpers\Language::settings('Admin_Onaysiz')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                            </td>
                                            <td class="text-right">
                                                
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
                                <input style="height: 37px; width: 170px;" type="submit" name="secilenleri_onayla" class="btn btn-success" value="{{\App\Helpers\Language::settings('Isci_Paneli_Secilenleri_Onayla')}}">

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
        $('#example1').DataTable( {
            "ordering": false
        } );

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
</script>
@endsection

<?php 
use App\Helpers\Language;
use App\Helpers\System;
$language = new Language;
$system = new System;
?>

@extends('layouts.admin.main')

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
                        <div><a data-toggle="modal" data-target="" class="btn btn-xs btn–block float-sm-right"><i class="fas fa-user" aria-hidden="true"></i></a></div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="card text-white bg-info mb-3">
                            <!--   <div class="card-header bg-light text-center"> <b style="color: black">Lohnplan</b> </div> -->
                            <div class="card-body">
                                <form class="filtreformu" method="GET" action="">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>{{$text['select_employees']}}</label>
                                                <select class="form-control" name="UyeID" onchange='this.form.submit()'>
                                                    <option value="" disabled selected>Mitarbeiter auswählen</option>
                                                    @foreach($all_members as $member)
                                                        <option @if(\Request::get('UyeID') == $member->id) selected @endif value="{{$member->id}}">
                                                            {{$member->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <?php
                                            $yil=date("Y");
                                            $ay =date("m");
                                            ?>
                                            <div class="col-md-3">
                                                <label>{{$language::settings('Admin_Yil_Seciniz')}}</label>
                                                <select class="form-control" name="Yil" onchange='this.form.submit()'>
                                                    @for($i = 2019; $i <= $yil; $i++)
                                                        <option @if(\Request::get('Yil') == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>{{$language::settings('Admin_Ay_Seciniz')}}</label>
                                                <select class="form-control" name="Ay" onchange='this.form.submit()'>
                                                    <option disabled selected>Wähle Monat</option>
                                                    <option @if(\Request::get('Ay') == '01') selected @endif value="01">{{$language::settings('Admin_Ay_Ocak')}}</option>
                                                    <option @if(\Request::get('Ay') == '02') selected @endif value="02">{{$language::settings('Admin_Ay_Subat')}}</option>
                                                    <option @if(\Request::get('Ay') == '03') selected @endif value="03">{{$language::settings('Admin_Ay_Mart')}}</option>
                                                    <option @if(\Request::get('Ay') == '04') selected @endif value="04">{{$language::settings('Admin_Ay_Nisan')}}</option>
                                                    <option @if(\Request::get('Ay') == '05') selected @endif value="05">{{$language::settings('Admin_Ay_Mayis')}}</option>
                                                    <option @if(\Request::get('Ay') == '06') selected @endif value="06">{{$language::settings('Admin_Ay_Haziran')}}</option>
                                                    <option @if(\Request::get('Ay') == '07') selected @endif value="07">{{$language::settings('Admin_Ay_Temmuz')}}</option>
                                                    <option @if(\Request::get('Ay') == '08') selected @endif value="08">{{$language::settings('Admin_Ay_Agustos')}}</option>
                                                    <option @if(\Request::get('Ay') == '09') selected @endif value="09">{{$language::settings('Admin_Ay_Eylul')}}</option>
                                                    <option @if(\Request::get('Ay') == '10') selected @endif value="10">{{$language::settings('Admin_Ay_Ekim')}}</option>
                                                    <option @if(\Request::get('Ay') == '11') selected @endif value="11">{{$language::settings('Admin_Ay_Kasim')}}</option>
                                                    <option @if(\Request::get('Ay') == '12') selected @endif value="12">{{$language::settings('Admin_Ay_Aralik')}}</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if(\Request::get('UyeID') != '')
                        <div style="margin-top: 15px" class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card text-black bg-light mb-4">
                                        <div class="card-header bg-light text-center"><b>Personaldaten</b></div>
                                        <div class="card-body">
                                            <table style="color: #424242" class="table table-sm table-striped table-responsive-xl table-hover">
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Personel_Adi')!!}</td>
                                                    <td>{{$profile->UyeADISOYADI}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Personel_Numarasi')!!}</td>
                                                    <td>{{$profile->UyeNUMARASI}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Departman')!!}</td>
                                                    <td>{{$profile->UyeDEPARTMAN}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Saat_Ucreti')!!}</td>
                                                    <td>{{$profile->UyeSAATUCRETI}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Vergi_Durumu')!!}</td>
                                                    <td>{{$profile->UyeVERGIDURUMU}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Ise_Giris_Tarihi')!!}</td>
                                                    <td>{{$profile->UyeISEGIRISTARIHI}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="card text-black bg-light mb-3">
                                        <div class="card-header bg-light text-center"><b>Urlaub</b></div>
                                        <div class="card-body">
                                            <table style="color: #424242" class="table table-sm table-striped taable-responsive-md table-hover">
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Ne_Kadar_Izın_Gunu_Kaldi')!!}</td>
                                                    <td>{{$profile->IzınGUNU}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Bu_Ay_Ne_Kadar_Izın_Gunu_Harcadi')!!}</td>
                                                    <td>{{$sick}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Toplam_Ne_Kadar_Izın_Gunu_Kaldi')!!}</td>
                                                    <td>{{$profile->IzınGUNU-$vacation}}</td>
                                                </tr>
                                                <tr style="background-color:#FAFAFA">
                                                    <td style="text-align: center; color: #424242" colspan="2">
                                                        <b>Krank</b></td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Bu_Ayki_Hasta_Gunleri')!!}</td>
                                                    <td>{{$sick}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Bu_Yilki_Hasta_Gunleri')!!}</td>
                                                    <td>{{$vacation}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card text-black bg-light mb-3">
                                        <div class="card-header bg-light text-center"><b>Geleistete Stunden</b>
                                        </div>
                                        <div class="card-body">
                                            <table style="color: #424242" class="table table-sm table-striped ttable-responsive-xl table-hover">
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Bu_Yilki_Calistigi_Gunler')!!}</td>
                                                    <td>{{$paid_hours['current_month']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Bu_Ay_Toplam_Odenecek_Saatler')!!}</td>
                                                    <td>{{$paid_hours['paid_out']}}</td>
                                                </tr>
                                                <tr style="background-color:#FAFAFA">
                                                    <td colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color:#A9F5A9">{!!$language::settings('Dokum_Tablosu_Toplam_Odenmeyen_Saatler')!!}</td>
                                                    <td style="background-color:#A9F5A9">{{$paid_hours['good_hours']}} Std.</td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color:#FAFAFA" colspan="2"></td>
                                                </tr>
                                                
                                                <tr style="background-color:#FAFAFA">
                                                    <td style="text-align: center; color: #424242" colspan="2">
                                                        <b>KUG</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Akt. Monat</b></td>
                                                    <td>{{$paid_hours['current_month_kug']}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card text-black bg-light mb-3">
                                        <div class="card-header bg-light text-center"><b>Zuschläge</b></div>

                                        @php 
                                        $first_day_month = Carbon\Carbon::create(Request::get('Yil'), Request::get('Ay'), 1);
                                        $last_day_month = Carbon\Carbon::create(Request::get('Yil'), Request::get('Ay'), 1)->endOfMonth()->toDateString();

                                        $aydakigunler=cal_days_in_month(CAL_GREGORIAN,Request::get('Ay'),Request::get('Yil'));
                                        $isgunleri=0;

                                        for($i=1 ;$i<=$aydakigunler ;$i++){
                                            if($system::tatilmi_bak("$i-".Request::get('Ay')."-".Request::get('Yil'))==false){
                                                $isgunleri++;
                                            }
                                        }
                                        
                                        $calismasigereken=$isgunleri*8;
                                        $uyesaatleri=0;
                                        $aydakigunler=cal_days_in_month(CAL_GREGORIAN,Request::get('Ay'),Request::get('Yil'));
                                        $isgunleri=0;
                                        for($i=1 ;$i<=$aydakigunler ;$i++){
                                            if($system::tatilmi_bak("$i-".Request::get('Ay')."-".Request::get('Yil'))==false){
                                                $isgunleri++;
                                            }
                                        }
                                        $calismasigereken=$isgunleri*8;
                                        $uyesaatleri=0;

                                        $watches = App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('UyeID', Request::get('UyeID'))->get();
                                        foreach($watches as $row){
                                            $uyesaatleri+=intval($row->Saat);
                                        }
                                        @endphp
                                        <div class="card-body">
                                            <table style="color: #424242" class="table table-sm table-striped ttable-responsive-xl table-hover">
                                                <tr class="col-md-12">
                                                    <td class="col-md-7">{!!$language::settings('Dokum_Tablosu_Arti_Saatler')!!}</td>
                                                    <td class="col-md-5">{{$uyesaatleri-$calismasigereken<0?'0':$uyesaatleri-$calismasigereken}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Gece_Calistigi_Toplam_Saat')!!}</td>
                                                    @php
                                                    $gecesaatleri=0;
                                                    if(App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('UyeID', Request::get('UyeID'))->where('Gunduz', 2)->count() >0){
                                                        foreach(App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('UyeID', Request::get('UyeID'))->where('Gunduz', 2)->get() as $row){
                                                            $gecesaatleri+=$row->Saat;
                                                        }
                                                    }
                                                    @endphp
                                                    <td>{{$gecesaatleri}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Cumartesi_Gunleri')!!}</td>
                                                    @php
                                                    $cumartesisaatleri=0;
                                                    foreach(App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('UyeID', Request::get('UyeID'))->get() as $row)
                                                    {
                                                        if($system::cumartesimibak($row->Tarih)==true)
                                                        {
                                                            $cumartesisaatleri+=$row->Saat;
                                                        }
                                                    }
                                                    @endphp
                                                    <td>{{$cumartesisaatleri}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Pazar_Gunleri')!!}</td>
                                                    @php
                                                    $pazarsaatleri=0;
                                                    foreach(App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('UyeID', Request::get('UyeID'))->get() as $row){
                                                        if($system::pazarmibak($row->Tarih)==true)
                                                        {
                                                            $pazarsaatleri+=$row->Saat;
                                                        }
                                                    }
                                                    @endphp
                                                    <td>{{$pazarsaatleri}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Tatil_Gunleri')!!}</td>
                                                    @php
                                                    $tatilsaatleri=0;
                                                    if(App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('UyeID', Request::get('UyeID'))->where('Calisti', 2)->count() >0){
                                                        foreach(App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('UyeID', Request::get('UyeID'))->where('Calisti', 2)->get() as $row){
                                                            if($sistem->tatilmibak($row->Tarih)==true){
                                                                @$tatilsaatleri+=$row->Saat;
                                                            }
                                                        }
                                                    }
                                                    @endphp

                                                    <td>{{$tatilsaatleri}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card text-black bg-light mb-3">
                                        <div class="card-header bg-light text-center"><b>Auslöse</b></div>
                                        <div class="card-body">
                                            <table style="color: #424242" class="table table-sm table-striped ttable-responsive-xl table-hover">
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Bir_Puan_Toplamlari')!!}</td>
                                                    <td>{{$release['release']}} €</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Iki_Puan_Toplamlari')!!}</td>
                                                    <td>{{$release['release']}} €</td>
                                                </tr>
                                                <tr>
                                                    <td>{!!$language::settings('Dokum_Tablosu_Puan_Bir_ve_Iki_Puan_Toplamlari')!!}
                                                    </td>
                                                    <td>{{$release['total']}} €</td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="card text-black bg-light mb-4">
                                        <div class="card-header bg-light text-center"><b>{{$language::settings('Dokum_Odenecek_Tutari_Giriniz')}} / {{$language::settings('Benzin_Tutarini_Giriniz')}}</b></div>
                                        <div class="card-body">
                                            <table style="color: #424242" class="table ttable-striped table-sm table-responsive-xl ttable-hover">
                                                <tr>
                                                    <form method="POST" action="" id="odeneceksaat">
                                                        <div class="input-group mb-3"> 
                                                            @php $rp = App\RemainingPayment::where('Yil',Request::get('Yil'))->where('Ay',Request::get('Ay'))->where('UyeID',Request::get('UyeID'))->first(); @endphp
                                                            <input  style="text-align: center" 
                                                            @if(App\Islemyapildi::where('Yil', Request::get('Yil'))->where('Ay', Request::get('Ay'))->where('UyeID', Request::get('UyeID'))->count() > 0) disabled @endif 
                                                            class="form-control" 
                                                            placeholder="{{$language::settings('Dokum_Odenecek_Tutari_Giriniz')}}" 
                                                            name="OdenecekTUTAR" 
                                                            value="{{@$rp->KalanODEME}}">
                                                            
                                                            <input class="form-control" type="hidden" name="Yil" value="{{Request::get('Yil')}}">
                                                            <input class="form-control" type="hidden" name="Ay" value="{{Request::get('Ay')}}">
                                                            <input type="hidden" name="OdenecekTutarIslem" value="1">
                                                        
                                                        <div class="input-group-append">
                                                            <button class="btn btn-md btn-block btn-light" type="@if(App\Islemyapildi::where('Yil', Request::get('Yil'))->where('Ay', Request::get('Ay'))->where('UyeID', Request::get('UyeID'))->count() > 0) button @else submit @endif">{{$language::settings('Admin_Gonder')}}</button>
                                                        </div>
                                                        </div>
                                                    </form>
                                                </tr>
                                                <tr>
                                                    <form method="POST" action="">
                                                    <div class="input-group mb-3">
                                                        <input  style="text-align: center" 
                                                        @if(App\Islemyapildi::where('Yil', Request::get('Yil'))->where('Ay', Request::get('Ay'))->where('UyeID', Request::get('UyeID'))->count() > 0) disabled @endif 
                                                        class="form-control" 
                                                        placeholder="{{$language::settings('Dokum_Odenecek_Tutari_Giriniz')}}" 
                                                        name="OdenecekTUTAR" 
                                                        value="{{@$rp->KalanODEME}}">
                                                        
                                                        <input class="form-control" type="hidden" name="Yil" value="{{Request::get('Yil')}}">
                                                        <input class="form-control" type="hidden" name="Ay" value="{{Request::get('Ay')}}">
                                                        <input type="hidden" name="BenzinTutarIslem" value="1">
                                                        
                                                        <div class="input-group-append">
                                                            <button class="btn btn-md btn-block btn-light" type="@if(App\Islemyapildi::where('Yil', Request::get('Yil'))->where('Ay', Request::get('Ay'))->where('UyeID', Request::get('UyeID'))->count() > 0) button @else submit @endif">{{$language::settings('Admin_Gonder')}}</button>
                                                        </div>
                                                        
                                                    </div>
                                                    </form>
                                                </tr>
                                                <tr>
                                                    <div class="btn-group">
                                                        @if(App\Islemyapildi::where('Yil', Request::get('Yil'))->where('Ay', Request::get('Ay'))->where('UyeID', Request::get('UyeID'))->count() > 0)
                                                            <a style="margin-top: 5px; height: 30px; width: 120px;" class="btn btn-default btn-sm disabled" href="javascript:void(0);">{{$language::settings('_Islem_Yapildi')}}</a>
                                                        @else
                                                            <a role="button" style="margin-top: 5px; height: 30px; width: 120px;" class="btn btn-success btn-sm disabled" href="{{route('admin.hr-wage').'?UyeID='.$_GET["UyeID"].'&Yil='.$_GET["Yil"].'&Ay='.$_GET["Ay"].'&islemyapildi=1'}}"><i class="fas fa-check"></i> Offen</a>
                                                        @endif
                                                        <button style="margin-top: 5px; height: 30px; width: 130px;" onclick="sweet()" class="btn btn-success btn-sm">Abschließen</button>
                                                    </div>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-md-12">
                                    <div class="clearfix"></div>
                                    <form method="POST" class="table-responsive-xl">
                                        <table id="example1" class="table table-hover table-striped" data-page-length='100'>
                                            <thead>
                                            <tr style="background-color: #D3D3D3">
                                                <th>{{$language::settings('Dokum_Tarih')}}</th>
                                                <th>{{$language::settings('Dokum_Ist')}}</th>
                                                <th>{{$language::settings('Dokum_Tablosu_Proje_Ismi')}}</th>
                                                <th>{{$language::settings('Dokum_Von')}}</th>
                                                <th>{{$language::settings('Dokum_Bis')}}</th>
                                                <th>{{$language::settings('Dokum_Pause')}}</th>
                                                <th>{{$language::settings('Dokum_Auslose')}}</th>
                                                <th>{{$language::settings('Dokum_Auslose_iki')}}</th>
                                                <th>{{$language::settings('Dokum_Yatti_Veya_Yatmadi')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($wages as $row)
                                                    <tr>
                                                        <td>{{$system::cevir($row->Tarih)}} {{$system::gun_bas_kisa($row->Tarih)}}</td>
                                                        <td type="time">
                                                            @php
                                                            if(strstr($row->Saat,".")){
                                                                $explode = explode(".",$row->Saat);
                                                                if($explode[0]<10){
                                                                    echo "0".$explode[0].":30";
                                                                }else{
                                                                    echo $explode[0].":30";
                                                                }
                                                            }else{
                                                                if($row->Saat<10){
                                                                    echo "0".$row->Saat.":00a";
                                                                }else{
                                                                    echo $row->Saat.":00u";
                                                                }
                                                            }
                                                            @endphp
                                                        </td>
                                                        <td>{{$row->ProjeBASLIK}}</td>
                                                        <td>
                                                            @if($row->Gunduz==1)
                                                            07:00
                                                            @else 
                                                            20:00
                                                            @endif
                                                        </td>
                                                        @php
                                                        if($row->Gunduz==1){
                                                            if($row->Saat>=8){
                                                                $saat="10:00";
                                                            }else{
                                                                $saat="09:30";
                                                            }
                                                            $eklenecek=$row->Saat;
                                                        }else{
                                                            if($row->Saat>=8){
                                                                $saat="22:00";
                                                            }else{
                                                                $saat="21:30";
                                                            }
                                                            $eklenecek=$row->Saat;
                                                        }
                                                        $dort_saat=strtotime("+$eklenecek hours",strtotime($saat));
                                                        @endphp
                                                        <td>{{gmdate("H:i:s",$dort_saat)}}</td>
                                                        <td>
                                                            @if($row->Saat >= 8)
                                                            1:00
                                                            @else 
                                                            0:30
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{App\Code::where('KodID', $row->Kod)->first()->Parabir}}</td>
                                                        <td class="text-center">{{App\Code::where('KodID', $row->Kod)->first()->Paraiki}}</td>
                                                        <td class="text-center">
                                                            @if(App\Code::where('KodID', $row->Kod)->first()->Yatti == 0) 
                                                                <span class="badge badge-pill badge-secondary">{{$language::settings('Dokum_Tablosu_Yatmadi')}}</span>
                                                            @else
                                                                <span class="badge badge-pill badge-secondary">{{$language::settings('Dokum_Tablosu_Yatti')}}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                  @endforeach
                                            </tbody>
                                        </table>
                                    </form>
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
 </section>
<!-- /.content -->
@endsection
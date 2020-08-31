<?php 
use App\Helpers\Language;
$lang = new Language;
?>

@extends('layouts.admin.main')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container" style="margin-left: 0px">
        <div class="row">
            <div class="col-md-12">
            </div>
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{$lang::settings('Admin_Kontrol')}}</h3>
                        <div><a data-toggle="modal" data-target="" class="btn btn-xs btn–block float-sm-right"><i class="fas fa-users" aria-hidden="true"></i></a></div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-body ">
                                <form class="filtreformu" method="GET" action="">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <?php
                                            $yil = date("Y");
                                            $ay = date("m");
                                            ?>
                                            <div class="col-md-4">
                                                <label>{{$lang::settings('Admin_Yil_Seciniz')}}</label>
                                                <select class="form-control" name="Yil" onchange='this.form.submit()'>
                                                    @for($i = 2019; $i <= $yil; $i++)
                                                        <option @if(\Request::get('Yil') == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>{{\App\Helpers\Language::settings('Admin_Ay_Seciniz')}}</label>
                                                <select class="form-control" name="Ay" onchange='this.form.submit()'>
                                                    <option disabled selected>Wähle Monat</option>
                                                    <option @if(\Request::get('Ay') == '01') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Ocak')}}</option>
                                                    <option @if(\Request::get('Ay') == '02') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Subat')}}</option>
                                                    <option @if(\Request::get('Ay') == '03') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Mart')}}</option>
                                                    <option @if(\Request::get('Ay') == '04') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Nisan')}}</option>
                                                    <option @if(\Request::get('Ay') == '05') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Mayis')}}</option>
                                                    <option @if(\Request::get('Ay') == '06') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Haziran')}}</option>
                                                    <option @if(\Request::get('Ay') == '07') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Temmuz')}}</option>
                                                    <option @if(\Request::get('Ay') == '08') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Agustos')}}</option>
                                                    <option @if(\Request::get('Ay') == '09') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Eylul')}}</option>
                                                    <option @if(\Request::get('Ay') == '10') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Ekim')}}</option>
                                                    <option @if(\Request::get('Ay') == '11') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Kasim')}}</option>
                                                    <option @if(\Request::get('Ay') == '12') selected @endif value="01">{{\App\Helpers\Language::settings('Admin_Ay_Aralik')}}</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <style>
                            th.dondur {
                                /* Something you can count on */
                                height: 180px !important;
                                white-space: nowrap;
                            }
                            th.dondur > div {
                                -webkit-transform: rotate(-90deg);
                                /* Firefox */
                                -moz-transform: rotate(-90deg);
                                /* IE */
                                -ms-transform: rotate(-90deg);
                                /* Opera */
                                -o-transform: rotate(-90deg);
                                width: 0px;
                                margin: 0 auto;
                            }
                            th.dondur > div > span {
                                padding: 5px 10px;
                            }
                           .table tr td, {
                                line-height: 20px;
                                padding:0px!important;
                                vertical-align: middle;
                               padding:5px !important;
                            }
                            .table tr th {
                                padding:0px!important;
                                padding-top: 135px!important;
                                padding:5px !important;
                                border: 1px solid #dee2e6;
                            }
                            .table td, .table th {
                                padding:5px !important;
                                border: 1px solid #dee2e6;
                            }
                            }
                        </style>

                        @if(\Request::get('Yil') != '' && \Request::get('Ay') != '')
                            <div class="col-md-12 table-responsive-md no-padding">
                                <table class="table table-hover  table-striped" style="margin-top: 11px; width:100%;"> 
                                    <thead>
                                    <tr style="background-color: #D3D3D3;">
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Personel_Adi')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Personel_Numarasi')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>Steuerkl. / Kinderfr.</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Saat_Ucreti')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Tum_Dokum_Tablosu_Giris')!!} </span></div></th>
                                        
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Tum_Dokum_Tablosu_Toplam_Odenmis_Saatler')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Tatil_Gunleri_Diger')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Toplam_Dokum_Tablosu_Bu_Ayki_Hasta_Gunleri')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Tum_Dokum_Tablosu_Bu_Ay_Izın')!!}</span></div></th>
                                
                                        <th class="tableust dondur"><div><span>KUG</span></div></th>
                                        <th class="tableust dondur"><div><span>Arbeitsstd. - KUG</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Arti_Saatler')!!} </span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Gece_Calistigi_Toplam_Saat')!!} </span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Pazar_Gunleri')!!} </span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Tatil_Gunleri')!!} </span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Bir_Puan_Toplamlari')!!} </span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Dokum_Tablosu_Iki_Puan_Toplamlari')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Tum_Tokum_Tablosu_Avans')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('Tum_Tokum_Tablosu_Benzin')!!}</span></div></th>
                                        <th class="tableust dondur"><div><span>{!!$lang::settings('_Islem_Yapildi')!!}</span></div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_members as $member)
                                    <?php 
                                        $first_day_month = Carbon\Carbon::create(Request::get('Yil'), Request::get('Ay'), 1);
                                        $last_day_month = Carbon\Carbon::create(Request::get('Yil'), Request::get('Ay'), 1)->endOfMonth()->toDateString();
                                    ?>
                                        <tr>
                                            <td class="text-center">{{$member->UyeADISOYADI}}</td>
                                            <td class="text-center">{{$member->UyeNUMARASI}}</td>
                                            <td class="text-center">{{$member->UyeVERGIDURUMU}}</td>
                                            <td class="text-center">{{$member->UyeSAATUCRETI}}</td>
                                            <td class="text-center">{{$member->UyeISEGIRISTARIHI}}</td>
                                            <td class="text-center">
                                                {{App\RemainingPayment::where('Yil',Request::get('Yil'))->where('Ay',Request::get('Ay'))->where('UyeID',$member->UyeID)->sum('KalanODEME')}}
                                            </td>
                                            
                                            <td class="text-center">
                                                {{$tatilsaatleri = App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('ProjeID', 7)->where('UyeID', $member->UyeID)->sum('Saat')}}
                                            </td>
                                            
                                            <td class="text-center">
                                                {{$buayizinkullandigisayis = 8*App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('ProjeID', 2)->where('UyeID',$member->UyeID)->count()}}
                                            </td>
                                            
                                            <td class="text-center">
                                                {{$buayizinkullandigisayi = 8*App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('ProjeID', 1)->where('UyeID',$member->UyeID)->count()}}
                                            </td>

                                            
                                            <!-- KUG -->
                                            <td class="text-center">
                                                {{$buaysaatlerkug = App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('ProjeID', 10)->where('UyeID',$member->UyeID)->sum('Saat')}}
                                            </td>
                                            
                                            <!-- Arbeitsstunden - KUG -->
                                            <td class="text-center">
                                                {{App\RemainingPayment::where('Yil',Request::get('Yil'))->where('Ay',Request::get('Ay'))->where('UyeID',$member->UyeID)->sum('KalanODEME')-$buayizinkullandigisayi-$buayizinkullandigisayis-$tatilsaatleri-$buaysaatlerkug}}
                                            </td>
                                            <td>
                                                {{cal_days_in_month(CAL_GREGORIAN , $_GET["Ay"], $_GET["Yil"])}}
                                            </td>
                                            <td></td>
                                            {{--
                                            <td class="text-center">
                                                <?php
                                                $aydakigunler = cal_days_in_month(CAL_GREGORIAN , $_GET["Ay"], $_GET["Yil"]);
                                                $isgunleri =0;
                                                for($i =1; $i<=$aydakigunler; $i++)
                                                {
                                                    if($sistem->tatilmi_bak("$i-".$_GET["Ay"]."-".$_GET["Yil"])==false)
                                                    {
                                                        $isgunleri++;
                                                    }
                                                }
                                                $calismasigereken = $isgunleri*8;
                                                $uyesaatleri =0;
                                                ?>

                                                $db->VeriOkuCokluSorgu ("SELECT * FROM saatler WHERE  Tarih >='$yil-$ay-01' AND Tarih<='$yil-$ay-31'  AND Onay=1 AND UyeID=$uyebilgileri->UyeID");
                                                foreach ($db->bilgial as $row)
                                                {
                                                    $uyesaatleri +=$row->Saat;
                                                }
                                                ?>
                                                <?=$uyesaatleri-$calismasigereken<1?'0':$uyesaatleri-$calismasigereken?>
                                            </td>
                                            --}}


                                            <td class="text-center">
                                                {{$gecesaatleri = App\Watches::where('Tarih', '>=', $first_day_month)->where('Tarih', '<=', $last_day_month)->where('Onay', 1)->where('Gunduz', 2)->where('UyeID',$member->UyeID)->sum('Saat')}}
                                            </td>
                                            
                                            {{--
                                            <td class="text-center">
                                                <?php
                                                $pazarsaatleri =0;
                                                $db->VeriOkuCokluSorgu ("SELECT * FROM saatler WHERE  Tarih >='$yil-$ay-01' AND Tarih<='$yil-$ay-31' AND Onay=1 AND UyeID=$uyebilgileri->UyeID");
                                                foreach ($db->bilgial as $row)
                                                {
                                                    if($sistem->pazarmibak  ($row->Tarih)==true)
                                                    {
                                                        $pazarsaatleri+=$row->Saat;
                                                    }
                                                }
                                                echo $pazarsaatleri;
                                                ?>
                                            </td>
                                            --}}
                                            {{--
                                            <td class="text-center">
                                                <?php
                                                $tatilsaatleri =0;
                                                if($db->veriSaydirSorgu("SELECT * FROM saatler WHERE  Tarih >='$yil-$ay-01' AND Tarih<='$yil-$ay-31' AND Calisti=1  AND Onay=1 AND UyeID=$uyebilgileri->UyeID")>0)
                                                {
                                                    $db->VeriOkuCokluSorgu ("SELECT * FROM saatler WHERE  Tarih >='$yil-$ay-01' AND Tarih<='$yil-$ay-31' AND Calisti=1  AND Onay=1 AND UyeID=$uyebilgileri->UyeID");
                                                    foreach ($db->bilgial as $row)
                                                    {
                                                        if($sistem->tatilmibak  ($row->Tarih)==true)
                                                        {
                                                            $tatilsaatleri+=$row->Saat;
                                                        }
                                                    }
                                                }
                                                echo $tatilsaatleri;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $parabirler =0;
                                                $db->VeriOkuCokluSorgu ("SELECT * FROM saatler WHERE   Tarih >='$yil-$ay-01' AND Tarih<='$yil-$ay-31' AND Onay=1 AND UyeID=$uyebilgileri->UyeID");
                                                foreach ($db->bilgial as $row)
                                                {
                                                    @$parabirler+=$db->VeriOkuTek ("kodlar","Parabir","KodID",$row->Kod);
                                                }
                                                echo $parabirler;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $paraikiler =0;
                                                $db->VeriOkuCokluSorgu ("SELECT * FROM saatler WHERE   Tarih >='$yil-$ay-01' AND Tarih<='$yil-$ay-31' AND Onay=1 AND UyeID=$uyebilgileri->UyeID");
                                                foreach ($db->bilgial as $row)
                                                {
                                                    if($db->VeriOkuTek ("kodlar","Paraiki","KodID",$row->Kod)!="")
                                                    {
                                                        $paraikiler+=$db->VeriOkuTek ("kodlar","Paraiki","KodID",$row->Kod);
                                                    }
                                                }
                                                echo $paraikiler;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $avanslar =0;
                                                if($db->veriSaydirSorgu("SELECT * FROM avanslar WHERE Tarih >='$yil-$ay-01' AND Tarih<='$yil-$ay-31' AND UyeID=$uyebilgileri->UyeID")>0)
                                                {
                                                    $db->VeriOkuCokluSorgu ("SELECT * FROM avanslar WHERE Tarih >='$yil-$ay-01' AND Tarih<='$yil-$ay-31' AND UyeID=$uyebilgileri->UyeID");
                                                    foreach ($db->bilgial as $row)
                                                    {
                                                        $avanslar+=$row->Tutar;
                                                    }
                                                }
                                                echo $avanslar;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?=@$db->VeriOkuTekCoklu ("benzinodemesiay","KalanODEME",array("Yil","Ay","UyeID"),array($_GET["Yil"],$_GET["Ay"],$uye->UyeID),"AND","=")?>
                                            </td>
                                            <td class="text-center">
                                                <?=$db->veriSaydir("islemyapildi",array("Yil","Ay","UyeID"),array($_GET["Yil"],$_GET["Ay"],$uye->UyeID))>0?_İslem_Yapildi_Evet:_İslem_Yapildi_Hayır?>
                                            </td>
                                            --}}
                                        </tr>
                                    @endforeach
                                    </tbody> {{--<caption>Arbeitsstunden (Soll) <?php echo $isgunleri*8?></caption>--}}
                                </table>
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
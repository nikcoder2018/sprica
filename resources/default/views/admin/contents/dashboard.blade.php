<?php 
use App\Helpers\Language;
$lang = new Language;
?>
@extends('layouts.admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>{{$page_title}}</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Projekte</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h5 class="mb-2">Your statistics</h5>
                    <div class="row" style="margin-left:0px; margin-right: 0px;">
                        <div class="col-lg-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fas fa-hourglass-end"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Working hours this month</span>
                                    <span class="info-box-number">{{$me_this_month}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fas fa-hourglass-end"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Working hours total</span>
                                    <span class="info-box-number">{{$me_total}}</span>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <h5 class="mb-2">All users</h5>
                    <div class="row" style="margin-left:0px; margin-right: 0px;">
                        <div class="col-lg-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fas fa-hourglass-end"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{$lang::settings('_Bugun_Calisilan_Saatler')}}</span>
                                    <span class="info-box-number">{{$hours_worked_today}} {{$lang::settings('Genel_Saat')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fas fa-hourglass-end"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{$lang::settings('_Bu_Ay_Ne_Kadar_Calismis')}}</span>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                                    <span class="info-box-number">{{$this_month}} {{$lang::settings('Genel_Saat')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fas fa-hourglass-end"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{$lang::settings('_Bu_Yil_Ne_Kadar_Calismis')}}</span>
                                    <span class="info-box-number">{{$this_year}} {{$lang::settings('Genel_Saat')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fas fa-clock"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{$lang::settings('_DashBoard_Odenmemis_Saatler')}}</span>
                                    <span class="info-box-number">{{$hours}} {{$lang::settings('Genel_Saat')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fas fa-plane"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{$lang::settings('_DashBoard_Kalan_Izın_Gunu')}}</span>
                                    <span class="info-box-number">{{$vacation}} {{$lang::settings('Genel_Gun')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                        </div>
                    </div> 
                </div>  <!-- erster Tab ender hier -->
    
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-lg-12 col-12"></div>

                                            <div class="col-md-8">
                                                <div class="card bg-light mb-3">
                                                    <div class="card-header bg-success text-center"><b>Montage</b>
                                                    </div>
                                                        
                                                        <div class="card-body table-responsive-md">
                                                            <table style="color: #424242" class="table table-sm table-striped table-hover">
                                                                <tr style="background: #BDBDBD">
                                                                    <th><b>Monat</b></th>
                                                                    <th><b>Gesamt</b></th>
                                                                    <th><b>Montage</b></th>
                                                                    <th><b>Urlaub</b></th>
                                                                    <th><b>Krank</b></th>
                                                                    <th><b>KUG</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Januar</td>
                                                                    <td>{{$project['jan']}}</td>
                                                                    <td>{{$project['jan_proj_8']}}</td>
                                                                    <td>{{$project['jan_proj_1']}}</td>
                                                                    <td>{{$project['jan_proj_2']}}</td>
                                                                    <td>{{$project['jan_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Februar</td>
                                                                    <td>{{$project['feb']}}</td>
                                                                    <td>{{$project['feb_proj_8']}}</td>
                                                                    <td>{{$project['feb_proj_1']}}</td>
                                                                    <td>{{$project['feb_proj_2']}}</td>
                                                                    <td>{{$project['feb_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>März</td>
                                                                    <td>{{$project['mar']}}</td>
                                                                    <td>{{$project['mar_proj_8']}}</td>
                                                                    <td>{{$project['mar_proj_1']}}</td>
                                                                    <td>{{$project['mar_proj_2']}}</td>
                                                                    <td>{{$project['mar_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>April</td>
                                                                    <td>{{$project['apr']}}</td>
                                                                    <td>{{$project['apr_proj_8']}}</td>
                                                                    <td>{{$project['apr_proj_1']}}</td>
                                                                    <td>{{$project['apr_proj_2']}}</td>
                                                                    <td>{{$project['apr_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mai</td>
                                                                    <td>{{$project['may']}}</td>
                                                                    <td>{{$project['may_proj_8']}}</td>
                                                                    <td>{{$project['may_proj_1']}}</td>
                                                                    <td>{{$project['may_proj_2']}}</td>
                                                                    <td>{{$project['may_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Juni</td>
                                                                    <td>{{$project['jun']}}</td>
                                                                    <td>{{$project['jun_proj_8']}}</td>
                                                                    <td>{{$project['jun_proj_1']}}</td>
                                                                    <td>{{$project['jun_proj_2']}}</td>
                                                                    <td>{{$project['jun_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Juli</td>
                                                                    <td>{{$project['jul']}}</td>
                                                                    <td>{{$project['jul_proj_8']}}</td>
                                                                    <td>{{$project['jul_proj_1']}}</td>
                                                                    <td>{{$project['jul_proj_2']}}</td>
                                                                    <td>{{$project['jul_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>August</td>
                                                                    <td>{{$project['aug']}}</td>
                                                                    <td>{{$project['aug_proj_8']}}</td>
                                                                    <td>{{$project['aug_proj_1']}}</td>
                                                                    <td>{{$project['aug_proj_2']}}</td>
                                                                    <td>{{$project['aug_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>September</td>
                                                                    <td>{{$project['sep']}}</td>
                                                                    <td>{{$project['sep_proj_8']}}</td>
                                                                    <td>{{$project['sep_proj_1']}}</td>
                                                                    <td>{{$project['sep_proj_2']}}</td>
                                                                    <td>{{$project['sep_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Oktober</td>
                                                                    <td>{{$project['oct']}}</td>
                                                                    <td>{{$project['oct_proj_8']}}</td>
                                                                    <td>{{$project['oct_proj_1']}}</td>
                                                                    <td>{{$project['oct_proj_2']}}</td>
                                                                    <td>{{$project['oct_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>November</td>
                                                                    <td>{{$project['nov']}}</td>
                                                                    <td>{{$project['nov_proj_8']}}</td>
                                                                    <td>{{$project['nov_proj_1']}}</td>
                                                                    <td>{{$project['nov_proj_2']}}</td>
                                                                    <td>{{$project['nov_proj_10']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Dezember</td>
                                                                    <td>{{$project['dec']}}</td>
                                                                    <td>{{$project['dec_proj_8']}}</td>
                                                                    <td>{{$project['dec_proj_1']}}</td>
                                                                    <td>{{$project['dec_proj_2']}}</td>
                                                                    <td>{{$project['dec_proj_10']}}</td>

                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <b>Gesamt</b>
                                                                    </td>

                                                                    <td><b>{{$project['total']['proj_0']}}</b>
                                                                    </td>

                                                                    <td>
                                                                        <b>{{$project['total']['proj_8']}}</b>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{$project['total']['proj_1']}}</b>
                                                                    </td>
                                                                    <td><b>{{$project['total']['proj_2']}}</b>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{$project['total']['proj_10']}}</b>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="card bg-light mb-3">
                                                    
                                                            <div class="card-header bg-success text-center"><b>Induzeit</b>
                                                            </div>
                                                        
                                                        <div class="card-body">
                                                            <table style="color: #424242" class="table table-sm table-striped ttable-responsive-xl table-hover">

                                                                <tr style="background: #BDBDBD">
                                                                    <th><b>
                                                                            Monat
                                                                        </b></th>

                                                                    <th>
                                                                        <b>Std.</b>
                                                                    </th>

                                                                    <th>
                                                                        <b>Induzeit</b>
                                                                    </th>


                                                                </tr>
                                                                <tr>
                                                                    <td>Januar</td>
                                                                    <td>{{$project['jan']}}</td>
                                                                    <td>{{$project['jan_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Februar</td>
                                                                    <td>{{$project['feb']}}</td>
                                                                    <td>{{$project['feb_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>März</td>
                                                                    <td>{{$project['mar']}}</td>
                                                                    <td>{{$project['mar_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>April</td>
                                                                    <td>{{$project['apr']}}</td>
                                                                    <td>{{$project['apr_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mai</td>
                                                                    <td>{{$project['may']}}</td>
                                                                    <td>{{$project['may_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Juni</td>
                                                                    <td>{{$project['jun']}}</td>
                                                                    <td>{{$project['jun_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Juli</td>
                                                                    <td>{{$project['jul']}}</td>
                                                                    <td>{{$project['jul_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>August</td>
                                                                    <td>{{$project['aug']}}</td>
                                                                    <td>{{$project['aug_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>September</td>
                                                                    <td>{{$project['sep']}}</td>
                                                                    <td>{{$project['sep_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Oktober</td>
                                                                    <td>{{$project['oct']}}</td>
                                                                    <td>{{$project['oct_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>November</td>
                                                                    <td>{{$project['nov']}}</td>
                                                                    <td>{{$project['nov_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Dezember</td>
                                                                    <td>{{$project['dec']}}</td>
                                                                    <td>{{$project['dec_proj_11']}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Gesamt</b></td>
                                                                    <td><b>{{$project['total']['proj_0']}}</b></td>
                                                                    <td><b>{{$project['total']['proj_11']}}</b></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  <!-- Hier endet 2. Tab -->

            </div>    <!-- Hier enden alle Tabs -->
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('modals')

@endsection
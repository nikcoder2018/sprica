@extends('layouts.app')

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
            <h5 class="mb-2">Your statistics</h5>
            <div class="row" style="margin-left:0px; margin-right: 0px;">
                <div class="col-lg-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fas fa-hourglass-end"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Working hours this month</span>
                            <span class="info-box-number">{{$this_month}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fas fa-hourglass-end"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Working hours total</span>
                            <span class="info-box-number">{{$total}}</span>
                        </div>
                    </div>
                </div>
            </div> 
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- ./wrapper -->
@endsection

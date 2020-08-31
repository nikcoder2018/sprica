<?php 
use App\Helpers\Language;
$lang = new Language;
?>

@extends('layouts.admin.main')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container" style="margin-left:0px">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <form class="form-update-gensettings" action="{{route('admin.settings.general-update')}}" method="POST">
                @csrf
                    <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{$lang::settings('admin_genel_ayarlar')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

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
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                        </div>

                </div>
                <!-- /.card -->
                </form>
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->



<section class="content">
    <div class="container" style="margin-left:0px">
        <div class="row">
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Sprache</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
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
                <!-- /.card -->
            </div>

            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section> 
@endsection

@section('scripts')
<script>
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
</script>
@endsection
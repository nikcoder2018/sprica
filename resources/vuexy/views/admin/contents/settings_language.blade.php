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
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Sprache</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" enctype="multipart/form-data" class="form-update-language" action="{{route('admin.settings.language-update')}}" method="POST">
                    @csrf
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <td style="width: 30%">Sprache</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($languages as $language)
                                    <tr>
                                        <td>
                                            <strong>{{$language->DilBASLIK}}</strong> <br>
                                            {{$language->DilKARSILIK}}
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="{{$language->DilBASLIK}}">{{$language->DilKARSILIK}}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
                    </div>
                    </form>

                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script type="text/javascript">
    $('.form-update-language').on('submit', function(e){
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
<?php 
use App\Helpers\Language;
use App\Helpers\System;
$lang = new Language;
$system = new System;
?>
@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
<div style="height:51px" class="card card-default color-palette-bo">
    <div style="height:51px" class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-users"></i> {{$page_title}}</h3>
        </div>
        <div class="d-inline-block float-right">
            <a data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)"class="btn btn-sm btn-outline-primary"><i class="fa fa-play-circle"></i></a>
        </div>
    </div>
</div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                      
                    
                      
                    <div class="">
                      <table id="example1" class="table ttable-bordered table-striped table-hover">
                        <thead>
                        <tr>
                          <th data-sort="2015-08-27T" style="width:29%">{{$lang::settings('Isci_Paneli_Tarih')}}</th>
                          <th style="width:19%">{{$lang::settings('Isci_Paneli_Saat')}}</th>
                          <th class="text-center" colspan="1">{{$lang::settings('Isci_Paneli_Proje')}}</th>
                          <th style="width:20%"></th>
                                            
                        </tr>
                        </thead>
                        <tbody>
                          @if(count($timelogs) > 0)
                            @foreach($timelogs as $log)
                            <tr>
                              <td>{{$system->cevir($log->Tarih)}} {{$system->gun_bas_kisa($log->Tarih)}}</td>
                              <td>{{$log->Saat}}</td>
                              <td>
                                @if($log->ProjeBASLIK != '')
                                  {{$log->ProjeBASLIK}}
                                @else 
                                  {{\App\Project::where('ProjeID', $log->ProjeID)->first()->ProjeBASLIK}}
                                @endif
                              </td>
                              <td>
                                @if($log->Onay != 1)
                                  <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{$log->SaatID}}"><i class="nav-icon fas fa-trash"></i></button>  
                                @endif
                                  @if($log->Onay != 0)
                                  
                                  <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                @endif
                              </td>
                            </tr>
                            @endforeach
                          @endif
                      </table>
                    </div>
                  </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('modals')
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
      <form method="POST" class="form-add-time" action="{{route('timetracking.store')}}">
        @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">{{$lang::settings('Admin_Panel_Saatler_Ekle')}}</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="form-group col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Proje_Seciniz')}}</label>
                          <select class="custom-select " required name="ProjeID">
                              <option selceted disabled>Wähle Projekt</option>
                            @foreach($projects as $project)
                                <option value="{{$project->ProjeID}}">{{$project->ProjeBASLIK}}</option>
                            @endforeach
                        </select>
                      </div>
                   
                      <div class="form-group col-md-6">
                          <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Proje_Giriniz')}}</label>
                          <input required type="text" class="custom-select vRequired" id="inputBasicFirstName" name="ProjeBASLIK" placeholder="Stadt">
                      </div>
                      
                        @php
                          $datum = mktime(0, 0, 0, date("m")  , date("d")-7, date("y")); 
                          $gestern = date("Y-m-d",$datum);       
                       
                          $datum = mktime(0, 0, 0, date("m")  , date("d")+1, date("y")); 
                          $morgen = date("Y-m-d",$datum);       
                        @endphp
                    
                      
                      <div class="form-group col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Tarih')}} ({{$gestern}} - {{$morgen}}) </label>
                          <input required type="date" min='{{$gestern}}' max='{{$morgen}}' class="form-control vRequired" id="inputBasicFirstName" name="Tarih" placeholder="">
                      </div>


                      <div class="form-group col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Saat')}}</label>
                          <select type="text" class="custom-select vRequired" id="inputBasicFirstName" name="Saat" placeholder="">
                              <option value="0.5">0:30</option>
                              <option value="1">1:00</option>
                              <option value="1.5">1:30</option>
                              <option value="2">2:00</option>
                              <option value="2.5">2:30</option>
                              <option value="3">3:00</option>
                              <option value="3.5">3:30</option>
                              <option value="4">4:00</option>
                              <option value="4.5">4:30</option>
                              <option value="5">5:00</option>
                              <option value="5.5">5:30</option>
                              <option value="6">6:00</option>
                              <option value="6.5">6:30</option>
                              <option value="7">7:00</option>
                              <option value="7.5">7:30</option>
                              <option value="8">8:00</option>
                              <option value="8.5">8:30</option>
                              <option value="9">9:00</option>
                              <option value="9.5">9:30</option>
                              <option value="10">10:00</option>
                          </select>
                      </div>
                      <div class="form-group col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Isci_Paneli_Gunduz_Mu')}}</label>
                          <select class="custom-select" name="Gunduz">
                              <option value="1">{{$lang::settings('Isci_Paneli_Gündüz')}}</option>
                              <option value="2">{{$lang::settings('Isci_Paneli_Gece')}}</option>
                          </select>
                      </div>
                      <div class="form-group col-md-4">
                          <label class="form-control-label" for="inputBasicFirstName">{{$lang::settings('Admin_Saatler_Ekle_Kod_Seciniz')}}</label>
                          <select class="custom-select" name="Kod">
                              <option value="99">Keine Auslöse</option>
                              @foreach($codes as $code)
                                @if(\App\EmployeeCode::where('PersonelID', Auth::user()->id)->where('KodID', $code->KodID)->exists() && $code->Kod != '99')
                                  <option value="{{$code->KodID}}">{{$code->KodBASLIK}}</option>
                                @endif
                              @endforeach
                          </select>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                <!--  <a href="" type="button" class="btn btn-default">Close</a> -->
                  <button type="submit" class="btn btn-primary btn-block">{{$lang::settings('Isci_Paneli_Kaydet')}}</button>
              </div>
          </div>
      </form>
  </div>
  <!-- /.modal-content -->
</div>

<div class="modal fade" id="modal-danger">
  <div class="modal-dialog">
      <div class="modal-content">
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
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{$lang::settings('Isci_Paneli_Hayir')}}</button>
              <button class="btn btn-danger btn-delete-go">{{$lang::settings('Isci_Paneli_Evet_Sil')}}</button>
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

<script>
    $("#example1").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "pageLength": 25,
        "autoWidth": false,
        "order": [[0, "desc"]],
        "columnDefs": [{ "type": "date", "targets": 0 }]
    });

    $('.form-add-time').on('submit', function(e){
      e.preventDefault();

      $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: $(this).serialize(),
          success: function(resp){
              if(resp.success){
                  Toast.fire({
                      icon: 'success',
                      toast: true,
                        timerProgressBar: false,
                      title: resp.msg,
                      showConfirmButton: false,
                  });

                  setTimeout(function() { document.location = "{{route('timetracking')}}"; }, 1000)
              }
          }
      })
    });

    $('.btn-delete').on('click', function(){
        $('#modal-danger').modal('show');
        $('.btn-delete-go').attr('data-id', $(this).data('id'));
    });

    $('.btn-delete-go').on('click', function(){
        $.ajax({
            url: "{{route('timetracking.destroy')}}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                SaatID : $(this).data('id')
            },
            success: function(resp){
                if(resp.success){
                    
                    Toast.fire({
                        icon: 'success',
                        toast: true,
                        timerProgressBar: false,
                        title: resp.msg,
                        showConfirmButton: false,
                    });

                    setTimeout(function() { document.location = "{{route('timetracking')}}"; }, 1000)
                }
            }
        })
    });
</script>
@endsection

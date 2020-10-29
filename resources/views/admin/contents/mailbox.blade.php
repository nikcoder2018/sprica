@extends('layouts.admin.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mailbox</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <a href="{{route('mailbox.compose')}}" class="btn btn-primary btn-block mb-3">Compose</a>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Folders</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              @if(auth()->user()->myrole->name == 'admin')
              <li class="nav-item">
                <a href="{{route('admin.mailbox')}}" class="nav-link">
                  <i class="far fa-envelope"></i> Inbox
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.mailbox.sent')}}" class="nav-link">
                  <i class="far fa-file-alt"></i> Sent
                </a>
              </li>
              @else 
              <li class="nav-item">
                <a href="{{route('mailbox')}}" class="nav-link">
                  <i class="far fa-envelope"></i> Inbox
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('mailbox.sent')}}" class="nav-link">
                  <i class="far fa-file-alt"></i> Sent
                </a>
              </li>
              @endif
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Inbox</h3>

            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="mailbox-controls">
              <!-- Check all button -->
              <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
              </div>
              <!-- /.btn-group -->
              <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
              <div class="float-right">
                1-50/200
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                </div>
                <!-- /.btn-group -->
              </div>
              <!-- /.float-right -->
            </div>
            <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-striped">
                <tbody>
                  @if(count($mailbox) > 0)
                    @foreach($mailbox as $email)
                    <tr>
                      <td>
                        <div class="icheck-primary">
                          <input type="checkbox" value="" id="check1">
                          <label for="check1"></label>
                        </div>
                      </td>
                      @if(auth()->user()->myrole->name == 'admin')
                      <td class="mailbox-name"><a href="{{route('admin.mailbox.read', $email->id)}}">{{$email->from}}</a></td>
                      @else 
                      <td class="mailbox-name"><a href="{{route('mailbox.read', $email->id)}}">{{$email->from}}</a></td>
                      @endif
                      <td class="mailbox-subject"><b>{{$email->subject}}</b>
                      </td>
                      <td class="mailbox-attachment"></td>
                      <td class="mailbox-date">{{Carbor\Carbon::parse($email->created_at)->diffForHumans()}}</td>
                    </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
              <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
@endsection
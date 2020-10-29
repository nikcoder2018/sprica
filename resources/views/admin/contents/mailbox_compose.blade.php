@extends('layouts.admin.main')
@section('external_css')
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Compose</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Compose</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <a href="{{route('mailbox')}}" class="btn btn-primary btn-block mb-3">Back to Inbox</a>
  
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
                  <h3 class="card-title">Compose New Message</h3>
                </div>
                <form class="form-compose-email" action="{{route('mailbox.compose')}}" method="POST">
                  @csrf
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <select class="select2bs4" multiple="multiple" name="recipient[]" data-placeholder="To" style="width: 100%;">
                      @foreach($users as $user)
                        <option value="{{$user->email}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="subject" placeholder="Subject:">
                  </div>
                  <div class="form-group">
                      <textarea id="compose-textarea" class="form-control" name="content"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="float-right">
                    <button type="submit" name="send" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                  </div>
                  <button type="reset" class="btn btn-default btn-discard"><i class="fas fa-times"></i> Discard</button>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
@section('external_js')
  <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endsection

@section('scripts')
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Add text editor
    $('#compose-textarea').summernote({
      height: 300
    })

    $('.form-compose-email').on('submit', function(e){
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
              setTimeout(function() { location.href="{{route('mailbox.sent')}}"; }, 1000);
            }
          }
        })
    })

    $('.btn-discard').on('click', function(){
        location.href = "{{route('mailbox')}}";
    });
  })
</script>
@endsection
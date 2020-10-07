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
        <div class="container-fluid">
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
                      <li class="nav-item">
                        <a href="{{route('mailbox')}}" class="nav-link">
                          <i class="far fa-envelope"></i> Sent
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('mailbox.drafts')}}" class="nav-link">
                          <i class="far fa-file-alt"></i> Drafts
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('mailbox.templates')}}" class="nav-link">
                          <i class="far fa-file-alt"></i> Templates
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Sent Mail</h3>
    
                    <div class="card-tools">
                    <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="mailbox-read-info">
                    <h5>Subject: {{$email->subject}}</h5>
                    <h6>To: {{$email->to}}
                        <span class="mailbox-read-time float-right">{{date('d M, Y H:i A', strtotime($email->created_at))}}</span></h6>
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">{!! $email->content !!}</div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-white">
                    <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li>
                        <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
    
                        <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <span>1,245 KB</span>
                                <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                            </span>
                        </div>
                    </li>
                    <li>
                        <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>
    
                        <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <span>1,245 KB</span>
                                <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                            </span>
                        </div>
                    </li>
                    <li>
                        <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>
    
                        <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <span>2.67 MB</span>
                                <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                            </span>
                        </div>
                    </li>
                    <li>
                        <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>
    
                        <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo2.png</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <span>1.9 MB</span>
                                <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                            </span>
                        </div>
                    </li>
                    </ul>
                </div>
                <!-- /.card-footer -->
                <div class="card-footer">
                    <div class="float-right">
                    <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                    <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
                    </div>
                    <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
                    <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                </div>
                <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
@endsection
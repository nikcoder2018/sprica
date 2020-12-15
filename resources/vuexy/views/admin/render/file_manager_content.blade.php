<!-- Folders Container Starts -->
<div class="view-container">
    <h6 class="files-section-title mt-25 mb-75">Folders</h6>
    @forelse($folders as $index=>$folder)
        <div class="card file-manager-item folder">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck{{$index}}" />
                <label class="custom-control-label" for="customCheck{{$index}}"></label>
            </div>
            <div class="card-img-top file-logo-wrapper">
                <div class="dropdown float-right">
                    <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                </div>
                <div class="d-flex align-items-center justify-content-center w-100">
                    <i data-feather="folder"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="content-wrapper">
                    <p class="card-text file-name mb-0">{{$folder->name}}</p>
                    <p class="card-text file-size mb-0">{{System::formatBytes($folder->size)}}</p>
                    <p class="card-text file-date">{{$folder->created_at->format('M d, Y')}}</p>
                </div>
                <small class="file-accessed text-muted">Last accessed: 21 hours ago</small>
            </div>
        </div>
    @empty 
        <div class="flex-grow-1 align-items-center no-result mb-3">
            <i data-feather="alert-circle" class="mr-50"></i>
            No Results
        </div>
    @endforelse
</div>
<!-- /Folders Container Ends -->

<!-- Files Container Starts -->
<div class="view-container">
    <h6 class="files-section-title mt-2 mb-75">Files</h6>
    @forelse($files as $index=>$file)
        <div class="card file-manager-item file">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck10" />
                <label class="custom-control-label" for="customCheck10"></label>
            </div>
            <div class="card-img-top file-logo-wrapper">
                <div class="dropdown float-right">
                    <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                </div>
                <div class="d-flex align-items-center justify-content-center w-100">
                    <img src="{{asset(env('APP_THEME','default').'/app-assets/images/icons/json.png')}}" alt="file-icon" height="35" />
                </div>
            </div>
            <div class="card-body">
                <div class="content-wrapper">
                    <p class="card-text file-name mb-0">{{$file->name}}</p>
                    <p class="card-text file-size mb-0">{{System::formatBytes($file->size)}}</p>
                    <p class="card-text file-date">{{$file->created_at->format('M d, 2020')}}</p>
                </div>
                <small class="file-accessed text-muted">Last accessed: 1 hour ago</small>
            </div>
        </div>
    @empty
    <div class="flex-grow-1 align-items-center no-result mb-3">
        <i data-feather="alert-circle" class="mr-50"></i>
        No Results
    </div>
    @endforelse
</div>
<!-- /Files Container Ends -->
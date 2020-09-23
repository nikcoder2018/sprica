@php 
use App\Helpers\System;
$messages_count = count(System::getLatestMessages());
$messages = System::getLatestMessages();
@endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
              <i class="far fa-comments"></i>
              @if($messages_count > 0)
                <span class="badge badge-danger navbar-badge">{{$messages_count}}</span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if($messages_count > 0)
                    @foreach($messages as $message)
                    <a href="{{route('messages.hasSender', $message->from->id)}}" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                        <img src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$message->from->avatar) }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ strlen($message->from->name) > 12 ? trim(substr($message->from->name,0,12)).'..' : $message->from->name }} 
                            </h3>
                            @if($message->attachment == null)
                            <p class="text-sm">
                                {{
                                    strlen($message->body) > 30 
                                    ? trim(substr($message->body, 0, 30)).'..'
                                    : $message->body
                                }}
                            </p>
                            @else
                            <span class="fas fa-file"></span> Attachment
                            @endif
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    @endforeach
                @endif
                <a href="{{route('messages')}}" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
              <span class="dropdown-item dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
          </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-ellipsis-v"></i>
                <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Menü</span>
                
                <a href="{{route('admin.profile')}}" class="dropdown-item">
                    <i class="fas fa-user"></i> Profile
                    <span class="float-right text-muted text-sm"></span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                     <i class="fas fa-sign-out-alt"></i> Abmelden
                     <span class="float-right text-muted text-sm"></span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
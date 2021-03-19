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
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            </div>
        </li>
        <li class="dropdown user-menu">
            <a href="#" class="dropdown-toggle ddt-large" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle" alt="Anna Smith">
            </a>
            <div class="dropdown-menu dropdown-menu-right">  
                <a href="{{route('admin.profile')}}" class="dropdown-item">
                    <i class="fas fa-user"></i> Profile
                    <span class="float-right text-muted text-sm"></span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     <i class="fas fa-sign-out-alt"></i> Logout
                     <span class="float-right text-muted text-sm"></span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
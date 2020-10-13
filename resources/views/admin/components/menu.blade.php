
@section('stylesheet')
<style>
    ul{
        border-radius:5px;
    }
    tr:hover td{
        background-color:#CECEF6;
    }
</style>
@endsection

<aside class="main-sidebar sidebar-dark-light elevation-4 ">
    
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
        <img src="{{asset('dist/img/klein.jpg')}}"
             alt="sprica"
             class="brand-image elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light" style="color:transparent">Sprica</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true" >
                @if(\App\Role::where('id', Auth::user()->role)->first()->name == 'employee')
                
                <li class="nav-item">
                    <a  href="{{route('dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{App\Helpers\Language::settings('_Isci_Paneli_DashBoard')}}</p>
                    </a>
                </li>
                
                
                <li class="nav-item">
                    <a href="{{route('timetracking')}}" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>My times</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('messages')}}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Messages</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('mailbox')}}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Mailbox</p>
                    </a>
                </li>
                @endif
                @if(\App\Role::where('id', Auth::user()->role)->first()->name == 'admin')

                <li class="nav-header">Administrator</li>
                <li class="nav-item">
                    <a  href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{App\Helpers\Language::settings('_Isci_Paneli_DashBoard')}}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('timetracking')}}" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>My times</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('messages')}}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Messages</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('mailbox')}}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Mailbox</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Email<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color:#555555;">
                        <li class="nav-item" >
                            <a  href="{{route('emailtemplates.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-envelope-square"></i>
                                <p>Templates</p>
                            </a>
                        </li>  
                        <li class="nav-item" >
                            <a  href="{{route('emailtriggers.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                <p>Triggers</p>
                            </a>
                        </li> 
                        <li class="nav-item" >
                            <a  href="{{route('emailactions.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-envelope-open"></i>
                                <p>Actions</p>
                            </a>
                        </li>       
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ana">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>HR<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color:#555555;">
                        <li class="nav-item" >
                            <a  href="{{route('admin.hr-control')}}" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>{{App\Helpers\Language::settings('Admin_Kontrol')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a  href="{{route('admin.hr-wage')}}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>{{App\Helpers\Language::settings('Admin_Dokum')}}</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a  href="{{route('admin.hr-wages-total')}}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>{{App\Helpers\Language::settings('Tum_Dokum_Al')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a  href="{{route('admin.hr-wages-advance')}}" class="nav-link">
                                <i class="nav-icon far fa-credit-card"></i>
                                <p>{{App\Helpers\Language::settings('Menu_Avanslar')}}</p>
                            </a>
                        </li>            
                    </ul>
                </li>
				<li class="nav-item has-treeview">
                    <a data-parents="projeler" href="{{route('admin.projects')}}" class="nav-link">
                        <i class="fas fa-suitcase nav-icon"></i>
                        <p>Projects <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color:#555555">
                        <li class="nav-item">
                            <a data-parents="genelayarlar" href="{{route('admin.projects')}}" class="nav-link">
                                <i class="fas fa-suitcase nav-icon"></i>
                                <p>
                                    All Projects
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a data-parents="genelayarlar" href="{{route('tasks.index')}}" class="nav-link">
                                <i class="fas fa-tasks nav-icon"></i>
                                <p>
                                    Tasks
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li class="nav-item">
                    <a data-parents="personeller" href="{{route('admin.employees')}}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        {{-- <p>{{App\Helpers\Language::settings('Admin_Personeller')}}</p> --}}
                        <p>Employees</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a data-parents="projeler" href="{{route('tickets.index')}}" class="nav-link">
                        <i class="fas fa-ticket-alt nav-icon"></i>
                        <p>Tickets <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color:#555555">
                        <li class="nav-item">
                            <a data-parents="genelayarlar" href="{{route('tickets.index')}}" class="nav-link">
                                <i class="fas fa-ticket-alt nav-icon"></i>
                                <p>
                                    All Tickets
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a data-parents="genelayarlar" href="{{route('tickettypes.index')}}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Types
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a data-parents="projeler" href="#" class="nav-link">
                        <i class="fas fa-car nav-icon"></i>
                        <p>Car Management <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color:#555555">
                        <li class="nav-item">
                            <a href="{{route('vehicles.index')}}" class="nav-link">
                                <i class="fas fa-car nav-icon"></i>
                                <p>
                                    Vehicles
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('vehiclegroups.index')}}" class="nav-link">
                                <i class="fas fa-car nav-icon"></i>
                                <p>
                                    Vehicle Groups
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('fuels.index')}}" class="nav-link">
                                <i class="fas fa-gas-pump nav-icon"></i>
                                <p>
                                    Fuels
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ana">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{-- {{App\Helpers\Language::settings('admin_genel_ayarlar')}} --}}
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="background-color:#555555">
            
                        <li class="nav-item">
                            <a data-parents="genelayarlar" href="{{route('admin.settings.general')}}" class="nav-link">
                                <i class="fas fa-cog nav-icon"></i>
                                <p>
                                    {{App\Helpers\Language::settings('admin_genel_ayarlar')}}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a data-parents="genelayarlar"  href="{{route('admin.settings.code')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{App\Helpers\Language::settings('Admin_Kodlar')}}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a data-parents="genelayarlar" href="{{route('admin.settings.vacationdays')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{App\Helpers\Language::settings('Admin_Tatil_Gunleri')}}
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                @endif


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
        
</aside>


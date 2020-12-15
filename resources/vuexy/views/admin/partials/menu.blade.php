<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-dark/index.html"><span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                        <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <h2 class="brand-text">Vuexy</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('dashboard')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'timesheet' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('timetracking')}}">
                    <i data-feather="clock"></i>
                    <span class="menu-title text-truncate">My Times</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'todo' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('timetracking')}}">
                    <i data-feather="check-square"></i>
                    <span class="menu-title text-truncate">Todo</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'messagers' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('messages')}}">
                    <i data-feather="message-square"></i>
                    <span class="menu-title text-truncate">Chat</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'mailbox' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('mailbox')}}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Mailbox</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'tickets' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('tickets.index')}}">
                    <i data-feather="frown"></i>
                    <span class="menu-title text-truncate">Tickets</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'news' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('notices.index')}}">
                    <i data-feather="bell"></i>
                    <span class="menu-title text-truncate">News</span>
                </a>
            </li>
            
            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">Administrator</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                <i data-feather="users"></i><span class="menu-title text-truncate">Users Management</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(1) === 'users' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('users.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Users</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'roles' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('roles.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Roles</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'permissions' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route("permissions.index")}}">
                            <i data-feather="circle"></i><span class="menu-item">Permissions</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                <i data-feather="book"></i><span class="menu-title text-truncate">Human Resource</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(1) === 'control' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('admin.hr-control')}}">
                            <i data-feather="circle"></i><span class="menu-item">{{Language::get('Admin_Kontrol')}}</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'wages' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('admin.hr-wage')}}">
                            <i data-feather="circle"></i><span class="menu-item">{{Language::get('Admin_Dokum')}}</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'wages_total' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('admin.hr-wages-total')}}">
                            <i data-feather="circle"></i><span class="menu-item">{{Language::get('Tum_Dokum_Al')}}</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'wages_advance' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('admin.hr-wages-advance')}}">
                            <i data-feather="circle"></i><span class="menu-item">{{Language::get('Menu_Avanslar')}}</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'employees' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('admin.employees')}}">
                            <i data-feather="circle"></i><span class="menu-item">Employees</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                <i data-feather="box"></i><span class="menu-title text-truncate">Projects</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(1) === 'projects' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('admin.projects')}}">
                            <i data-feather="circle"></i><span class="menu-item">All</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'tasks' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('tasks.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Task</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) === 'users' ? 'calendar' : null }}">
                        <a class="d-flex align-items-center" href="{{route('admin.projects.calendar')}}">
                            <i data-feather="circle"></i><span class="menu-item">Calendar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                <i data-feather="dollar-sign"></i><span class="menu-title text-truncate">Finance</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(2) === 'estimates' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Estimates</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) === 'invoices' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Invoices</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) === 'payments' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Payments</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) === 'expenses' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Expenses</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) === 'credit_note' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Credit Note</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'documents' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('documents.index')}}">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate">Documents</span>
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'signing_request' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="">
                    <i data-feather='edit-2'></i>
                    <span class="text-truncate">Signing Requests</span>
                </a>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                <i data-feather="truck"></i><span class="menu-title text-truncate">Vehicles</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(1) === 'vehicles' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('vehicles.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Vehicles</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'vehiclegroups' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('vehiclegroups.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Vehicle Groups</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'fuels' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('fuels.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Fuels</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'general_settings' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('admin.settings.general')}}">
                    <i data-feather="settings"></i><span class="menu-title text-truncate">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
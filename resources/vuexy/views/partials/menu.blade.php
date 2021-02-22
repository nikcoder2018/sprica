<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/dashboard">
                    <span class="brand-logo">
                        <img style="text-align:center; width: 100% !important"
                            src="{{ asset('dist/img/logo-auth.jpg') }}">
                    </span>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="/dashboard">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'timesheet' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('timetracking') }}">
                    <i data-feather="clock"></i>
                    <span class="menu-title text-truncate">My Times</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'todo' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('todo.index') }}">
                    <i data-feather="check-square"></i>
                    <span class="menu-title text-truncate">Todo</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'messagers' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('messages') }}">
                    <i data-feather="message-square"></i>
                    <span class="menu-title text-truncate">Chat</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'mailbox' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('mailbox') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Mailbox</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'tickets' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('tickets.index') }}">
                    <i data-feather="frown"></i>
                    <span class="menu-title text-truncate">Tickets</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'news' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('notices.index') }}">
                    <i data-feather="bell"></i>
                    <span class="menu-title text-truncate">News</span>
                </a>
            </li>

            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">Administrator</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="book"></i>
                    <span class="menu-title text-truncate">Human Resource</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(1) === 'control' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('controlling.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Controlling</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'wages' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('payroll.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Payroll</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'employees' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('employees.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Employees</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'holidays' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('holidays.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Holidays</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="box"></i>
                    <span class="menu-title text-truncate">Projects</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(1) === 'projects' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('projects.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">All</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'tasks' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('tasks.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Task</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) === 'calendar' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.projects.calendar') }}">
                            <i data-feather="circle"></i><span class="menu-item">Calendar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                    <i data-feather="dollar-sign"></i><span class="menu-title text-truncate">Finance</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(2) === 'estimates' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('finance.estimates.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Estimates</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) === 'invoices' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('finance.invoices.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Invoices</span>
                        </a>
                    </li>
                    {{-- <li
                        class="{{ Request::segment(2) === 'payments' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Payments</span>
                        </a>
                    </li> --}}
                    <li class="{{ Request::segment(2) === 'expenses' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('finance.expenses.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Expenses</span>
                        </a>
                    </li>
                    {{-- <li
                        class="{{ Request::segment(2) === 'credit_note' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Credit Note</span>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'documents' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('documents.index') }}">
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
                        <a class="d-flex align-items-center" href="{{ route('vehicles.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Vehicles</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'vehiclegroups' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('vehiclegroups.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Vehicle Groups</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'fuels' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{ route('fuels.index') }}">
                            <i data-feather="circle"></i><span class="menu-item">Fuels</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'general_settings' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('admin.settings.general') }}">
                    <i data-feather="settings"></i><span class="menu-title text-truncate">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/charts/apexcharts.css')}}">
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/dashboard-ecommerce.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/charts/chart-apex.css')}}">
@endsection

@section('content')
<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->
        <div class="col-xl-5 col-md-6 col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body">
                    <h5>Welcome back, {{auth()->user()->name}}!</h5>
                    <p class="card-text font-small-3">You didn't worked yet today</p>
                    <h3 class="mb-75 mt-2 pt-50">
                        <a href="javascript:void(0);">0 Hrs.</a>
                    </h3>
                    <button type="button" class="btn btn-primary">Time in Now!</button>
                    <img src="{{asset(env('APP_THEME','default').'/app-assets/images/illustration/badge.svg')}}" class="congratulation-medal" alt="Medal Pic" />
                </div>
            </div>
        </div>
        <!--/ Medal Card -->

        <!-- Statistics Card -->
        <div class="col-xl-7 col-md-6 col-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Company Statistics</h4>
                    <div class="d-flex align-items-center">
                        <p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-primary mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">230</h4>
                                    <p class="card-text font-small-3 mb-0">Worked Hours</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-info mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">8.549</h4>
                                    <p class="card-text font-small-3 mb-0">Employees</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                            <div class="media">
                                <div class="avatar bg-light-danger mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="box" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">423</h4>
                                    <p class="card-text font-small-3 mb-0">Unpaid Invoices</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="media">
                                <div class="avatar bg-light-success mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">9745</h4>
                                    <p class="card-text font-small-3 mb-0">Unresolved Tickets</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>

    <div class="row match-height">
        <div class="col-lg-5 col-12">
            <div class="row match-height">
                <!-- Bar Chart - Orders -->
                <div class="col-lg-6 col-md-3 col-6">
                    <div class="card">
                        <div class="card-body pb-50">
                            <h6>This Week</h6>
                            <h3 class="font-weight-bolder mb-1">120 Hrs.</h3>
                            <div id="statistics-order-chart"></div>
                        </div>
                    </div>
                </div>
                <!--/ Bar Chart - Orders -->

                <!-- Line Chart - Profit -->
                <div class="col-lg-6 col-md-3 col-6">
                    <div class="card card-tiny-line-stats">
                        <div class="card-body pb-50">
                            <h6>This Month</h6>
                            <h3 class="font-weight-bolder mb-1">340 Hrs.</h3>
                            <div id="statistics-profit-chart"></div>
                        </div>
                    </div>
                </div>
                <!--/ Line Chart - Profit -->

                <!-- Earnings Card -->
                <div class="col-lg-12 col-md-6 col-12">
                    <div class="card earnings-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="card-title mb-1">Earnings</h4>
                                    <div class="font-small-2">This Month</div>
                                    <h5 class="mb-1">$4055.56</h5>
                                    <p class="card-text text-muted font-small-2">
                                        <span class="font-weight-bolder">68.2%</span><span> more earnings than last month.</span>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <div id="earnings-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Earnings Card -->
            </div>
        </div>

        <!-- Projects Report Card -->
        <div class="col-lg-7 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h4 class="card-title">Projects Status</h4>
                    <div class="dropdown chart-dropdown">
                        <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Last 7 Days
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem4">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                            <h1 class="font-large-2 font-weight-bolder mt-2 mb-0">163</h1>
                            <p class="card-text">Total</p>
                        </div>
                        <div class="col-sm-10 col-12 d-flex justify-content-center">
                            <div id="support-trackers-chart"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <div class="text-center">
                            <p class="card-text mb-50">Completed</p>
                            <span class="font-large-1 font-weight-bold">29</span>
                        </div>
                        <div class="text-center">
                            <p class="card-text mb-50">On Hold</p>
                            <span class="font-large-1 font-weight-bold">63</span>
                        </div>
                        <div class="text-center">
                            <p class="card-text mb-50">Canceled</p>
                            <span class="font-large-1 font-weight-bold">43</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Projects Report Card -->
    </div>

    <div class="row match-height">
        <!-- Projects Table Card -->
        <div class="col-lg-12 col-12">
            <div class="card card-company-table">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Total</th>
                                    <th>Montage</th>
                                    <th>Illnes</th>
                                    <th>KUG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded">
                                                <div class="avatar-content">
                                                    <img src="../../../app-assets/images/icons/toolbox.svg" alt="Toolbar svg" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-weight-bolder">Dixons</div>
                                                <div class="font-small-2 text-muted">meguc@ruj.io</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-light-primary mr-1">
                                                <div class="avatar-content">
                                                    <i data-feather="monitor" class="font-medium-3"></i>
                                                </div>
                                            </div>
                                            <span>Technology</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder mb-25">23.4k</span>
                                            <span class="font-small-2 text-muted">in 24 hours</span>
                                        </div>
                                    </td>
                                    <td>$891.2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">68%</span>
                                            <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded">
                                                <div class="avatar-content">
                                                    <img src="../../../app-assets/images/icons/parachute.svg" alt="Parachute svg" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-weight-bolder">Motels</div>
                                                <div class="font-small-2 text-muted">vecav@hodzi.co.uk</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-light-success mr-1">
                                                <div class="avatar-content">
                                                    <i data-feather="coffee" class="font-medium-3"></i>
                                                </div>
                                            </div>
                                            <span>Grocery</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder mb-25">78k</span>
                                            <span class="font-small-2 text-muted">in 2 days</span>
                                        </div>
                                    </td>
                                    <td>$668.51</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">97%</span>
                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded">
                                                <div class="avatar-content">
                                                    <img src="../../../app-assets/images/icons/brush.svg" alt="Brush svg" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-weight-bolder">Zipcar</div>
                                                <div class="font-small-2 text-muted">davcilse@is.gov</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-light-warning mr-1">
                                                <div class="avatar-content">
                                                    <i data-feather="watch" class="font-medium-3"></i>
                                                </div>
                                            </div>
                                            <span>Fashion</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder mb-25">162</span>
                                            <span class="font-small-2 text-muted">in 5 days</span>
                                        </div>
                                    </td>
                                    <td>$522.29</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">62%</span>
                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded">
                                                <div class="avatar-content">
                                                    <img src="../../../app-assets/images/icons/star.svg" alt="Star svg" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-weight-bolder">Owning</div>
                                                <div class="font-small-2 text-muted">us@cuhil.gov</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-light-primary mr-1">
                                                <div class="avatar-content">
                                                    <i data-feather="monitor" class="font-medium-3"></i>
                                                </div>
                                            </div>
                                            <span>Technology</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder mb-25">214</span>
                                            <span class="font-small-2 text-muted">in 24 hours</span>
                                        </div>
                                    </td>
                                    <td>$291.01</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">88%</span>
                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded">
                                                <div class="avatar-content">
                                                    <img src="../../../app-assets/images/icons/book.svg" alt="Book svg" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-weight-bolder">Cafés</div>
                                                <div class="font-small-2 text-muted">pudais@jife.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-light-success mr-1">
                                                <div class="avatar-content">
                                                    <i data-feather="coffee" class="font-medium-3"></i>
                                                </div>
                                            </div>
                                            <span>Grocery</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder mb-25">208</span>
                                            <span class="font-small-2 text-muted">in 1 week</span>
                                        </div>
                                    </td>
                                    <td>$783.93</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">16%</span>
                                            <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded">
                                                <div class="avatar-content">
                                                    <img src="../../../app-assets/images/icons/rocket.svg" alt="Rocket svg" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-weight-bolder">Kmart</div>
                                                <div class="font-small-2 text-muted">bipri@cawiw.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-light-warning mr-1">
                                                <div class="avatar-content">
                                                    <i data-feather="watch" class="font-medium-3"></i>
                                                </div>
                                            </div>
                                            <span>Fashion</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder mb-25">990</span>
                                            <span class="font-small-2 text-muted">in 1 month</span>
                                        </div>
                                    </td>
                                    <td>$780.05</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">78%</span>
                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded">
                                                <div class="avatar-content">
                                                    <img src="../../../app-assets/images/icons/speaker.svg" alt="Speaker svg" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-weight-bolder">Payers</div>
                                                <div class="font-small-2 text-muted">luk@izug.io</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-light-warning mr-1">
                                                <div class="avatar-content">
                                                    <i data-feather="watch" class="font-medium-3"></i>
                                                </div>
                                            </div>
                                            <span>Fashion</span>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder mb-25">12.9k</span>
                                            <span class="font-small-2 text-muted">in 12 hours</span>
                                        </div>
                                    </td>
                                    <td>$531.49</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">42%</span>
                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Projects Table Card -->

        <!-- Browser States Card -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-browser-states">
                <div class="card-header">
                    <div>
                        <h4 class="card-title">Browser States</h4>
                        <p class="card-text font-small-2">Counter August 2020</p>
                    </div>
                    <div class="dropdown chart-dropdown">
                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="browser-states">
                        <div class="media">
                            <img src="../../../app-assets/images/icons/google-chrome.png" class="rounded mr-1" height="30" alt="Google Chrome" />
                            <h6 class="align-self-center mb-0">Google Chrome</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">54.4%</div>
                            <div id="browser-state-chart-primary"></div>
                        </div>
                    </div>
                    <div class="browser-states">
                        <div class="media">
                            <img src="../../../app-assets/images/icons/mozila-firefox.png" class="rounded mr-1" height="30" alt="Mozila Firefox" />
                            <h6 class="align-self-center mb-0">Mozila Firefox</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">6.1%</div>
                            <div id="browser-state-chart-warning"></div>
                        </div>
                    </div>
                    <div class="browser-states">
                        <div class="media">
                            <img src="../../../app-assets/images/icons/apple-safari.png" class="rounded mr-1" height="30" alt="Apple Safari" />
                            <h6 class="align-self-center mb-0">Apple Safari</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">14.6%</div>
                            <div id="browser-state-chart-secondary"></div>
                        </div>
                    </div>
                    <div class="browser-states">
                        <div class="media">
                            <img src="../../../app-assets/images/icons/internet-explorer.png" class="rounded mr-1" height="30" alt="Internet Explorer" />
                            <h6 class="align-self-center mb-0">Internet Explorer</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">4.2%</div>
                            <div id="browser-state-chart-info"></div>
                        </div>
                    </div>
                    <div class="browser-states">
                        <div class="media">
                            <img src="../../../app-assets/images/icons/opera.png" class="rounded mr-1" height="30" alt="Opera Mini" />
                            <h6 class="align-self-center mb-0">Opera Mini</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">8.4%</div>
                            <div id="browser-state-chart-danger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Browser States Card -->

        <!-- Goal Overview Card -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Goal Overview</h4>
                    <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
                </div>
                <div class="card-body p-0">
                    <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                    <div class="row border-top text-center mx-0">
                        <div class="col-6 border-right py-1">
                            <p class="card-text text-muted mb-0">Completed</p>
                            <h3 class="font-weight-bolder mb-0">786,617</h3>
                        </div>
                        <div class="col-6 py-1">
                            <p class="card-text text-muted mb-0">In Progress</p>
                            <h3 class="font-weight-bolder mb-0">13,561</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Goal Overview Card -->

        <!-- Transaction Card -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-transaction">
                <div class="card-header">
                    <h4 class="card-title">Transactions</h4>
                    <div class="dropdown chart-dropdown">
                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="transaction-item">
                        <div class="media">
                            <div class="avatar bg-light-primary rounded">
                                <div class="avatar-content">
                                    <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="transaction-title">Wallet</h6>
                                <small>Starbucks</small>
                            </div>
                        </div>
                        <div class="font-weight-bolder text-danger">- $74</div>
                    </div>
                    <div class="transaction-item">
                        <div class="media">
                            <div class="avatar bg-light-success rounded">
                                <div class="avatar-content">
                                    <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="transaction-title">Bank Transfer</h6>
                                <small>Add Money</small>
                            </div>
                        </div>
                        <div class="font-weight-bolder text-success">+ $480</div>
                    </div>
                    <div class="transaction-item">
                        <div class="media">
                            <div class="avatar bg-light-danger rounded">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="transaction-title">Paypal</h6>
                                <small>Add Money</small>
                            </div>
                        </div>
                        <div class="font-weight-bolder text-success">+ $590</div>
                    </div>
                    <div class="transaction-item">
                        <div class="media">
                            <div class="avatar bg-light-warning rounded">
                                <div class="avatar-content">
                                    <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="transaction-title">Mastercard</h6>
                                <small>Ordered Food</small>
                            </div>
                        </div>
                        <div class="font-weight-bolder text-danger">- $23</div>
                    </div>
                    <div class="transaction-item">
                        <div class="media">
                            <div class="avatar bg-light-info rounded">
                                <div class="avatar-content">
                                    <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="transaction-title">Transfer</h6>
                                <small>Refund</small>
                            </div>
                        </div>
                        <div class="font-weight-bolder text-success">+ $98</div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Transaction Card -->
    </div>
</section>
@endsection

@section('modals')

@endsection

@section('scripts')
    <!-- BEGIN: Page JS-->
    <script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script>
    <script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <!-- END: Page JS-->
@endsection
@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection
@section('stylesheets')
    <style>
        .thead-light > tr > th{
            vertical-align: bottom;
            white-space: nowrap;
            height: 180px;
            /* transform: rotate(-90deg);
             
             background:#283046 !important;
             vertical-align:unset !important;
             padding-left: 10px !important; */
        }
        .thead-light > tr > th > div {
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            width: 0px;
            margin: 0 auto;
        }
    </style>
@endsection
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
    <div class="form-group breadcrumb-right">
        <div class="dropdown">
            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{route('payroll.index')}}">
                    <i class="mr-1" data-feather="check-square"></i><span class="align-middle">Payroll</span>
                </a>
                <a class="dropdown-item" href="{{route('advances.index')}}">
                    <i class="mr-1" data-feather="message-square"></i><span class="align-middle">Advance</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="app-user-list">
    <!-- users filter start -->
    <div class="card">
        <h5 class="card-header">Search Filter</h5>
        <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
            <div class="col-md-4 form-group">
                <label>Employee</label>
                <select class="select2 filters filter-employee form-control text-capitalize mb-md-0 mb-2xx">
                    <option value=""> Select Employee </option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}"> {{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label>Year</label>
                <select name="year" class="form-control filters filter-year">
                    @for($i = date("Y")-1; $i<=date("Y");$i++)
                        <option value="{{$i}}"> {{$i}} </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label>Month</label>
                <select name="month" class="form-control filters filter-month">
                    <option value="">Select All</option>
                    <option value="1"> January </option>
                    <option value="2"> February </option>
                    <option value="3"> March </option>
                    <option value="4"> April </option>
                    <option value="5"> May </option>
                    <option value="6"> June </option>
                    <option value="7"> July </option>
                    <option value="8"> August </option>
                    <option value="9"> September </option>
                    <option value="10"> October </option>
                    <option value="11"> November </option>
                    <option value="12"> December </option>
                </select>
            </div>
        </div>
    </div>
    <!-- list section start -->
    <div class="card payroll-data">
        <div class="card-datatable table-responsive pt-0">
            <table class="payroll-list-table table">
                <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th><div><span>Name</span></div></th>
                        <th><div><span>Number</span></div></th>
                        <th><div><span>Tax Status</span></div></th>
                        <th><div><span>Hour Fee</span></div></th>
                        <th><div><span>Date Registered</span></div></th>
                        <th><div><span>FEIERTAG</span></div></th>
                        <th><div><span>KRANK (Std.)</span></div></th>
                        <th><div><span>Urlaub (Std.)</span></div></th>
                        <th><div><span>KUG</span></div></th>
                        <th><div><span>Arbeitsstd. - KUG</span></div></th>
                        <th><div><span>Überstunden 25%</span></div></th>
                        <th><div><span>Nachtarbeit 25%</span></div></th>
                        <th><div><span>Sonntag 50%</span></div></th>
                        <th><div><span>Feiertag 100%</span></div></th>
                        <th><div><span>Auslöse</span></div></th>
                        <th><div><span>Auslöse, Zusch.</span></div></th>
                        <th><div><span>Lohnvorschuss</span></div></th>
                        <th><div><span>Fahrtkosten</span></div></th>
                        <th><div><span>Abgeschlossen</span></div></th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
    <!-- list section end -->
</section>
@endsection

@section('external_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/forms/form-select2.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-payroll-total.js')}}"></script>
@endsection
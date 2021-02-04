@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/calendars/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/pages/app-calendar.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('stylesheets')
<style>
    .holiday-color-options {
        margin-top : 1.5rem;
        margin-bottom : 1.2rem;
    }

    .holiday-color-options .color-option {
        border : 1px solid transparent;
        border-radius : 50%;
        position : relative;
        cursor : pointer;
        padding : 3px;
    }

    .holiday-color-options .color-option .filloption {
    height : 18px;
    width : 18px;
    border-radius : 50%;
    }

    .holiday-color-options .selected .b-primary {
    border-color : #7367F0;
    }

    .holiday-color-options .selected .b-primary .filloption {
    box-shadow : 0 2px 4px 0 rgba(115, 103, 240, 0.4);
    }

    .holiday-color-options .selected .b-success {
    border-color : #28C76F;
    }

    .holiday-color-options .selected .b-success .filloption {
    box-shadow : 0 2px 4px 0 rgba(40, 199, 111, 0.4);
    }

    .holiday-color-options .selected .b-danger {
    border-color : #EA5455;
    }

    .holiday-color-options .selected .b-danger .filloption {
    box-shadow : 0 2px 4px 0 rgba(234, 84, 85, 0.4);
    }

    .holiday-color-options .selected .b-warning {
    border-color : #FF9F43;
    }

    .holiday-color-options .selected .b-warning .filloption {
    box-shadow : 0 2px 4px 0 rgba(255, 159, 67, 0.4);
    }

    .holiday-color-options .selected .b-info {
    border-color : #00CFE8;
    }

    .holiday-color-options .selected .b-info .filloption {
    box-shadow : 0 2px 4px 0 rgba(0, 207, 232, 0.4);
    }

    .holiday-color-options .b-primary .filloption {
    box-shadow : 0 2px 4px 0 rgba(115, 103, 240, 0.4);
    }

    .holiday-color-options .b-success .filloption {
    box-shadow : 0 2px 4px 0 rgba(40, 199, 111, 0.4);
    }

    .holiday-color-options .b-danger .filloption {
    box-shadow : 0 2px 4px 0 rgba(234, 84, 85, 0.4);
    }

    .holiday-color-options .b-warning .filloption {
    box-shadow : 0 2px 4px 0 rgba(255, 159, 67, 0.4);
    }

    .holiday-color-options .b-info .filloption {
    box-shadow : 0 2px 4px 0 rgba(0, 207, 232, 0.4);
    }
</style>
@endsection

@section('header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        @include('partials.breadcrumbs', ['title' => $title])
    </div>
@endsection
@section('content')
<section>
    <div class="app-calendar overflow-hidden border">
        <div class="row no-gutters">
            <!-- Sidebar -->
            <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
                <div class="sidebar-wrapper">
                    <div class="card-body d-flex justify-content-center">
                        <button class="btn btn-primary btn-toggle-sidebar btn-block" data-toggle="modal" data-target="#add-new-modal">
                            <i data-feather='plus-circle'></i> <span class="align-middle">Add Holiday</span>
                        </button>
                    </div>
                    {{-- <div class="card-body pb-0">
                        <h5 class="section-label mb-1">
                            <span class="align-middle">Holidays</span>
                        </h5>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input select-all" id="select-all" checked />
                            <label class="custom-control-label" for="select-all">View All</label>
                        </div>
                        <div class="calendar-events-filter">
                            <div class="custom-control custom-control-danger custom-checkbox mb-1">
                                <input type="checkbox" class="custom-control-input input-filter" id="personal" data-value="New Year" checked />
                                <label class="custom-control-label" for="personal">New Year</label>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- /Sidebar -->

            <!-- Calendar -->
            <div class="col position-relative">
                <div class="card shadow-none border-0 mb-0 rounded-0">
                    <div class="card-body pb-0">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            <!-- /Calendar -->
            <div class="body-content-overlay"></div>
        </div>
    </div>
</section>

@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="add-new-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('holidays.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="occasion" placeholder="Occasion" required />
                        </div>
                        <div class="form-group position-relative">
                            <label for="start-date" class="form-label">Date</label>
                            <input type="text" class="form-control" name="date" placeholder="Date" />
                        </div>
                        <div class="holiday-color-options">
                            <input type="hidden" name="color" value="primary">
                            <h6>Colors</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block selected" color="primary">
                                    <div class="color-option b-primary">
                                        <div class="filloption bg-primary"></div>
                                    </div>
                                </li>
                                <li class="d-inline-block" color="success">
                                    <div class="color-option b-success">
                                        <div class="filloption bg-success"></div>
                                    </div>
                                </li>
                                <li class="d-inline-block" color="danger">
                                    <div class="color-option b-danger">
                                        <div class="filloption bg-danger"></div>
                                    </div>
                                </li>
                                <li class="d-inline-block" color="warning">
                                    <div class="color-option b-warning">
                                        <div class="filloption bg-warning"></div>
                                    </div>
                                </li>
                                <li class="d-inline-block" color="info">
                                    <div class="color-option b-info">
                                        <div class="filloption bg-info"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-new-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST"> 
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="occasion" placeholder="Occasion" required />
                        </div>
                        <div class="form-group position-relative">
                            <label for="start-date" class="form-label">Date</label>
                            <input type="text" class="form-control" name="date" placeholder="Date" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@endsection

@section('external_js')
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('scripts')
<script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/pages/app-holidays.js') }}"></script>
@endsection

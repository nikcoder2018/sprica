<?php
use App\Helpers\Language;
$lang = new Language();
?>

@extends('layouts.admin.main')

@section('stylesheets')
    <link href="{{ asset('css/quill/quill.snow.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link href="{{ asset('dist/css/validation_master.css') }}" rel="stylesheet">

    <style>
        .dataTables_length,
        .dataTables_filter,
        .dataTables_iinfo,
        .ddataTables_paginate {
            display: none;
        }

        .ql-toolbar.ql-snow {
            border: 0;
            padding: 0px;

        }

        .ql-toolbar.ql-snow .ql-formats {
            padding: 2px;
            border: 1px solid #d6d6d68a;
            border-radius: 3px;
        }

        .editor {
            margin-top: 10px;
            border: 1px solid #d6d6d68a !important;
            border-radius: 3px;
            height: 500px;
        }

        .modal-input-title {
            height: calc(3rem + 2px);
            border-bottom: 1px solid #babfc7;
            border-top: 0px !important;
            border-left: 0px !important;
            border-right: 0px !important;
            border-radius: 0px !important;
            padding: 0;
            font-size: 1.5rem;
        }



        .hide {
            display: none;
        }

    </style>
@endsection
@section('content')
    <div class="content m-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <ul class="nav nav-pills flex-column nav-left" id="settings-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="settings-general-tabs" data-toggle="pill"
                                href="#settings-tabs-general" role="tab" aria-controls="settings-tabs-general"
                                aria-selected="true">
                                <span class="font-weight-bold">General</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-language-tabs" data-toggle="pill"
                                href="#settings-tabs-language" role="tab" aria-controls="settings-tabs-language"
                                aria-selected="false">
                                <span class="font-weight-bold">Language</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-release-tabs" data-toggle="pill"
                                href="#settings-tabs-release" role="tab" aria-controls="settings-tabs-release"
                                aria-selected="false">
                                <span class="font-weight-bold">Codes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-holidays-tabs" data-toggle="pill"
                                href="#settings-tabs-holidays" role="tab" aria-controls="settings-tabs-holidays"
                                aria-selected="false">
                                <span class="font-weight-bold">Holidays</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-ticket-types-tabs" data-toggle="pill"
                                href="#settings-tabs-ticket-types" role="tab"
                                aria-controls="settings-tabs-ticket-types" aria-selected="false">
                                <span class="font-weight-bold">Ticket Types</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-email-templates" data-toggle="pill"
                                href="#settings-tabs-email-templates" role="tab"
                                aria-controls="settings-tabs-email-templates" aria-selected="false">
                                <span class="font-weight-bold">Email Templates</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-email-tiggers" data-toggle="pill"
                                href="#settings-tabs-email-triggers" role="tab"
                                aria-controls="settings-tabs-email-triggers" aria-selected="false">
                                <span class="font-weight-bold">Email Triggers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-email-actions" data-toggle="pill"
                                href="#settings-tabs-email-actions" role="tab"
                                aria-controls="settings-tabs-email-actions" aria-selected="false">
                                <span class="font-weight-bold">Email Actions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings-time-management" data-toggle="pill" aria-controls="settings-time-management" aria-selected="false" class="nav-link" id="settings-time-management-button">
                                <span class="font-weight-bold">Time Management</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card card-info card-outline card-tabs">
                        <div class="card-body">
                            <div class="tab-content" id="settings-tabs-content">
                                <div class="tab-pane fade" id="settings-tabs-language" role="tabpanel" aria-labelledby="settings-tabs-language">
                                    <form autocomplete="off" enctype="multipart/form-data" class="ajaxFormFalse" action=""
                                        method="POST">
                                        <div class="card-body table-responsive-md">
                                            <table class="table table-striped ttable-bordered datatable-extended">
                                                <thead>
                                                    <tr>
                                                        <th>Sprache</th>
                                                        <th class="text-right">Bearbeiten</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Deutsch</td>
                                                        <td class="text-right">
                                                            <div class="dropdown pull-right">
                                                                <button type="button"
                                                                    class="btn btn-primary dropdown-toggle btn-sm"
                                                                    data-toggle="dropdown"
                                                                    aria-expanded="false">Bearbeiten</button>
                                                                <div class="dropdown-menu dropdown-menu-primary"
                                                                    aria-labelledby="exampleColorDropdown2" role="menu">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.settings.language', 'edit') }}"
                                                                        role="menuitem">Bearbeiten</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="settings-tabs-release" role="tabpanel" aria-labelledby="settings-tabs-release">
                                    <div style="height: 51px; padding-bottom: 5rem !important;" class="card card-default color-palette-bo">
                                        <div style="height:51px" class="card-header">
                                            <div class="d-inline-block">
                                                <h3 class="card-title"><i class="fas fa-code"></i> Codes</h3>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                    data-target="#add_code_modal"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-default color-palette-bo">
                                        <div class="card-body table-responsive">
                                            <table id="example1"
                                                class="table table-hover table-bordered table-striped table-code"
                                                data-order='[[1, "asc"]]' data-page-length='100'>
                                                <thead>
                                                    <tr>
                                                        <th>{{ $lang::settings('Kodlar_Kod_Basligi') }}</th>
                                                        <th>{{ $lang::settings('Kodlar_Kod') }}</th>
                                                        <th>{{ $lang::settings('Kodlar_Para_Bir') }}</th>
                                                        <th>{{ $lang::settings('Kodlar_Para_Iki') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($codes as $code)
                                                        <tr>
                                                            <td>{{ $code->KodBASLIK }}</td>
                                                            <td>{{ $code->Kod }}</td>
                                                            <td>{{ $code->Parabir }}</td>
                                                            <td>{{ $code->Paraiki }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>{{ $lang::settings('Kodlar_Kod_Basligi') }}</th>
                                                        <th>{{ $lang::settings('Kodlar_Kod') }}</th>
                                                        <th>{{ $lang::settings('Kodlar_Para_Bir') }}</th>
                                                        <th>{{ $lang::settings('Kodlar_Para_Iki') }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="settings-tabs-holidays" role="tabpanel" aria-labelledby="settings-tabs-holidays">
                                    <div style="height: 51px; padding-bottom: 5rem !important;" class="card card-default color-palette-bo">
                                        <div style="height:51px" class="card-header">
                                            <div class="d-inline-block">
                                                <h3 class="card-title"><i class="fas fa-compass"></i> Holidays</h3>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                    data-target="#add_vacation_modal"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-default color-palette-bo">
                                        <div class="card-body table-responsive">
                                            <table id="example1" class="table table-bordered table-striped table-vacation"
                                                data-page-length='10' data-order='[[0, "desc"]]'>
                                                <thead>
                                                    <tr>
                                                        <th>{{ $lang::settings('Admin_Tatil_Gunleri_Tarih') }}</th>
                                                        <th>Feiertag</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($vacationdays as $vacation)
                                                        <tr data-id="{{ $vacation->GunID }}">
                                                            <td>{{ $vacation->Tarih }}</td>
                                                            <td>{{ $vacation->GunBASLIK }}</td>

                                                            <td class="text-right">
                                                                <div class="dropdown pull-right">
                                                                    <button type="button"
                                                                        class="btn btn-warning dropdown-toggle btn-sm"
                                                                        data-toggle="dropdown" aria-expanded="false">{!!
                                                                        $lang::settings('Isci_Paneli_Islem_Seciniz')
                                                                        !!}</button>
                                                                    <div class="dropdown-menu dropdown-menu-primary"
                                                                        aria-labelledby="exampleColorDropdown2" role="menu">
                                                                        <button class="dropdown-item btn-edit-vacation"
                                                                            data-id="{{ $vacation->GunID }}">{{ $lang::settings('Admin_Duzenle') }}</button>
                                                                        <button class="dropdown-item btn-delete-vacation"
                                                                            data-id="{{ $vacation->GunID }}">{{ $lang::settings('Isci_Paneli_Sil') }}</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>

                                                        <th>{{ $lang::settings('Admin_Tatil_Gunleri_Tarih') }}</th>
                                                        <th>Feiertag</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="settings-tabs-ticket-types" role="tabpanel"
                                    aria-labelledby="#settings-tabs-ticket-types">

                                    <div style="height: 51px; padding-bottom: 5rem !important;" class="card card-default color-palette-bo">
                                        <div style="height:51px" class="card-header">
                                            <div class="d-inline-block">
                                                <h3 class="card-title"><i class="fas fa-envelope"></i> Tickets</h3>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                    data-target="#add_type_modal"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-default color-palette-bo">
                                        <div class="card-body table-responsive">
                                            <table id="example1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ticket_types as $type)
                                                        <tr>
                                                            <td>{{ $type->name }}</td>
                                                            <td>
                                                                <a href="#" class="btn-edit-type"
                                                                    data-id="{{ $type->id }}"><i
                                                                        class="fa fa-fw fa-edit text-primary"></i></a>
                                                                <a href="#" class="btn-delete-type"
                                                                    data-id="{{ $type->id }}"><i
                                                                        class="fa fa-fw fa-trash text-danger "></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="settings-tabs-email-templates" role="tabpanel"
                                    aria-labelledby="#settings-tabs-email-templates">
                                    <div style="height: 51px; padding-bottom: 5rem !important;" class="card card-default color-palette-bo">
                                        <div style="height:51px" class="card-header">
                                            <div class="d-inline-block">
                                                <h3 class="card-title"><i class="fas fa-envelope"></i> Email Templates</h3>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <button class="btn btn-sm btn-outline-primary btn_add_email_template"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-default color-palette-bo">
                                        <div class="card-body table-responsive p-0">
                                            <table id="example1" class="table table-striped table-emailtemplate">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Subject</th>
                                                        <th>Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($templates as $template)
                                                        <tr>
                                                            <td>{{ $template->title }}</td>
                                                            <td>{{ $template->subject }}</td>
                                                            <td>
                                                                <a href="#" class="edit_template"
                                                                    data-id="{{ $template->id }}"><i
                                                                        class="fa fa-fw fa-pencil text-warning"></i></a>
                                                                <a href="#" class="view_template"
                                                                    data-id="{{ $template->id }}"><i
                                                                        class="fa fa-fw fa-eye text-primary"></i></a>
                                                                <a href="#" class="delete_template"
                                                                    data-id="{{ $template->id }}"><i
                                                                        class="fa fa-fw fa-trash text-danger "></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="settings-tabs-email-triggers" role="tabpanel"
                                    aria-labelledby="#settings-tabs-email-triggers">
                                    <div style="height: 51px; padding-bottom: 5rem !important;" class="card card-default color-palette-bo">
                                        <div style="height:51px" class="card-header">
                                            <div class="d-inline-block">
                                                <h3 class="card-title"><i class="fas fa-envelope"></i> Email Triggers</h3>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                    data-target="#add_emailtrigger_modal"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body p-0 table-responsive">
                                            <table id="example1" class="table table-striped table-emailtrigger">
                                                <thead>
                                                    <tr>
                                                        <th>Triggers when</th>
                                                        <th>Email Template</th>
                                                        <th>Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($triggers as $trigger)
                                                        <tr>
                                                            <td>{{ $trigger->action->description }}</td>
                                                            <td>{{ $trigger->template->title }}</td>
                                                            <td>
                                                                <a href="#" class="edit_trigger"
                                                                    data-id="{{ $trigger->id }}"><i
                                                                        class="fa fa-fw fa-edit text-primary"></i></a>
                                                                <a href="#" class="delete_trigger"
                                                                    data-id="{{ $trigger->id }}"><i
                                                                        class="fa fa-fw fa-trash text-danger "></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="settings-tabs-email-actions" role="tabpanel"
                                    aria-labelledby="#settings-tabs-email-actions">
                                    <div style="height: 51px; padding-bottom: 5rem !important;" class="card card-default color-palette-bo">
                                        <div style="height:51px" class="card-header">
                                            <div class="d-inline-block">
                                                <h3 class="card-title"><i class="fas fa-envelope"></i> Email Actions</h3>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                    data-target="#add_action_modal"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body p-0 table-responsive">
                                            <table id="example1" class="table table-striped table-actions">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Command</th>
                                                        <th>Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($actions as $action)
                                                        <tr>
                                                            <td>{{ $action->description }}</td>
                                                            <td>{{ $action->command->code }}</td>
                                                            <td>
                                                                <a href="#" class="edit_action"
                                                                    data-id="{{ $action->id }}"><i
                                                                        class="fa fa-fw fa-edit text-primary"></i></a>
                                                                <a href="#" class="delete_action"
                                                                    data-id="{{ $action->id }}"><i
                                                                        class="fa fa-fw fa-trash text-danger "></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="settings-time-management" role="tabpanel" aria-labelledby="settings-time-management">
                                    <div style="height: 51px; padding-bottom: 5rem !important;" class="card card-default color-palette-bo">
                                        <div style="height:51px" class="card-header">
                                            <div class="d-inline-block">
                                                <h3 class="card-title">
                                                    Times Management
                                                </h3>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#addTimeModal">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <div class="modal fade" id="addTimeModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="addTimeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addTimeModalLabel">Add Time</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form id="add-time-form" action="{{ route('times.store') }}" method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="hours">Hour/s</label>
                                                                        <input type="text" name="hours" id="hours" placeholder="Hours"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="break">Break</label>
                                                                        <input type="text" name="break" id="break" step=".01" placeholder="Break"
                                                                            class="form-control form-control-sm">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body p-0 table-responsive">
                                            <table class="table table-striped table-actions">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ID</th>
                                                        <th class="text-center">Hour/s</th>
                                                        <th class="text-center">Break</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($times as $time)
                                                        <tr data-id="{{ $time->id }}">
                                                            <td class="text-center">{{ $time->id }}</td>
                                                            <td class="text-center">{{ $time->hours }}</td>
                                                            <td class="text-center">{{ $time->break }}</td>
                                                            <td class="text-center">
                                                                <a href="#" data-toggle="modal" data-target="#editTimeModal{{ $time->id }}"><i
                                                                        class="fa fa-fw fa-edit text-primary"></i></a>
                                                                <div class="modal fade" id="editTimeModal{{ $time->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="editTimeModalLabel{{ $time->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="editTimeModalLabel{{ $time->id }}">
                                                                                    Edit Time</h5>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form class="edit-time-form"
                                                                                action="{{ route('times.update', ['time' => $time->id]) }}"
                                                                                data-id="{{ $time->id }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <label for="hours-{{ $time->id }}">Hour/s</label>
                                                                                        <input type="text" name="hours"
                                                                                            id="hours-{{ $time->id }}" placeholder="Hours"
                                                                                            class="form-control form-control-sm"
                                                                                            value="{{ $time->hours }}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="break-{{ $time->id }}">Break</label>
                                                                                        <input type="text" name="break"
                                                                                            id="break-{{ $time->id }}" step=".01" placeholder="Break"
                                                                                            class="form-control form-control-sm"
                                                                                            value="{{ $time->break }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary btn-sm">Save</button>
                                                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                                                        data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#deleteTimeModal{{ $time->id }}"><i
                                                                        class="fa fa-fw fa-trash text-danger "></i></a>
                                                                <div class="modal fade" id="deleteTimeModal{{ $time->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="deleteTimeModalLabel{{ $time->id }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="deleteTimeModalLabel{{ $time->id }}">
                                                                                    Delete Time</h5>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form class="delete-time-form"
                                                                                action="{{ route('times.destroy', ['time' => $time->id]) }}"
                                                                                data-id="{{ $time->id }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    Are you sure you want to delete this time?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger btn-sm">Confirm</button>
                                                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                                                        data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade active show" id="settings-tabs-general" role="tabpanel" aria-labelledby="settings-tabs-general">
                                    <form class="form-update-gensettings" action="{{ route('admin.settings.general-update') }}" method="POST">
                                        @csrf
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Profile</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="media mb-1">
                                                    <a href="#" class="mr-25">
                                                        <img id="account-upload-preview" src="{{ auth()->user()->avatar ?: asset('vuexy/app-assets/images/portrait/small/avatar-s-11.jpg') }}" height="80" width="80" alt="" class="rounded mr-50">
                                                    </a>
                                                    <div class="media-body mt-75 ml-1">
                                                        <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75 waves-effect waves-float waves-light">Upload</label>
                                                        <input type="file" id="account-upload" hidden="" name="avatar" accept="image/*">
                                                        <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                                    </div>
                                                </div>
                                                <div class="validate-form mt-2">
                                                    <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                        <label for="account-username">Username</label>
                                                        <input type="text" class="form-control" id="account-username" name="username" placeholder="Username" value="{{ auth()->user()->username }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                        <label for="account-name">Name</label>
                                                        <input type="text" class="form-control" id="account-name" name="name" placeholder="Name" value="{{ auth()->user()->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                        <label for="account-e-mail">E-mail</label>
                                                        <input type="email" class="form-control" id="account-e-mail" name="email" placeholder="Email" value="{{ auth()->user()->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                        <label for="account-company">Company</label>
                                                        <input type="text" class="form-control" id="account-company" name="company" placeholder="Company name" value="{{ auth()->user()->company }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ $lang::settings('admin_genel_ayarlar') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label class="form-control-label"
                                                            for="inputBasicLastName">{{ $lang::settings('Admin_Site_URL') }}</label>
                                                        <input type="text" value="{{ $genset->SiteURL }}" name="SiteURL"
                                                            id="form-field-166" class="form-control " required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="form-control-label"
                                                            for="inputBasicLastName">{{ $lang::settings('Bir_Gun_Proje') }}</label>
                                                        <input type="text" value="{{ $genset->KacSAAT }}" name="KacSAAT"
                                                            id="form-field-16" class="form-control " required>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="form-control-label">Default Start Time</label>
                                                        <input type="text" name="default_start_time" class="form-control flatpickr-date-time" placeholder="HH:MM" value="{{ $default_start_time }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">{{ $lang::settings('Isci_Paneli_Kaydet') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> 
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(() => {
            $('#add-time-form').submit(function(e) {
                e.preventDefault();

                const url = $(this).attr('action');
                const data = $(this).serialize();
                axios.post(url, data).then(() => {
                    $('#addTimeModal').on('hidden.bs.modal', () => {
                        toastr.success('Time added successfully.');
                        window.location.reload();
                    });
                    $('#addTimeModal').modal('hide');
                });
            });

            $('.edit-time-form').submit(function(e) {
                e.preventDefault();
                const form = $(this);
                const id = form.attr('data-id');
                const modal = $(`#editTimeModal${id}`);
                const url = form.attr('action');
                const data = form.serialize();

                axios.post(url, data).then(() => {
                    modal.on('hidden.bs.modal', () => {
                        toastr.success('Time updated successfully.');
                        window.location.reload();
                    });
                    modal.modal('hide');
                });
            });

            $('.delete-time-form').submit(function(e) {
                e.preventDefault();
                const form = $(this);
                const id = form.attr('data-id');
                const modal = $(`#deleteTimeModal${id}`);
                const url = form.attr('action');
                modal.on('hidden.bs.modal', () => {
                    axios.post(url).then(() => {
                        toastr.success('Time deleted successfully.');
                        window.location.reload();
                    });
                });
                modal.modal('hide');

            });
        });

    </script>
@endsection

@section('modals')
    <div class="modal fade" id="add_code_modal">
        <div class="modal-dialog modal-lg">
            <form class="form-add-code" method="POST" action="{{ route('admin.settings.code-add') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $lang::settings('Admin_Kodlar') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Kodlar_Kod_Basligi') }}</label>
                                <input class="form-control " required name="KodBASLIK" />
                            </div>
                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Kodlar_Kod') }}</label>
                                <input class="form-control " required name="Kod" />
                            </div>
                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Kodlar_Para_Bir') }}</label>
                                <input class="form-control " required name="Parabir" />
                            </div>
                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Kodlar_Para_Iki') }}</label>
                                <input class="form-control " required name="Paraiki" />
                            </div>

                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Kodlar_Yatti_Mi') }}</label>
                                <select class="form-control " required name="Yatti">
                                    <option value="0">{{ $lang::settings('Kodlar_Hayir') }}</option>
                                    <option value="1">{{ $lang::settings('Kodlar_Evet') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('admin.settings.code') }}" type="button" class="btn btn-default">Close</a>
                        <button type="submit" class="btn btn-primary">{{ $lang::settings('Isci_Paneli_Kaydet') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <div class="modal fade" id="add_type_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tickettypes.store') }}" class="form-add-type" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Ticket Type</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>

                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="submit"> Save </button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_type_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tickettypes.update') }}" class="form-edit-type" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Ticket Type</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="submit"> Save </button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_vacation_modal">
        <div class="modal-dialog modal-lg">
            <form class="form-add-vacationdays" method="POST" action="{{ route('admin.settings.vacationdays-add') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $lang::settings('Admin_Tatil_Gunleri') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Admin_Tatil_Gunleri_Tarih') }}</label>
                                <input class="form-control " required type="date" name="Tarih" />
                            </div>

                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Tatil_Ismi') }}</label>
                                <input class="form-control " required type="text" name="GunBASLIK" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">{{ $lang::settings('Isci_Paneli_Kaydet') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <div class="modal fade" id="edit_vacation_modal">
        <div class="modal-dialog modal-lg">
            <form class="form-edit-vacationdays" method="POST" action="{{ route('admin.settings.vacationdays-update') }}">
                @csrf
                <input type="hidden" name="GunID">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $lang::settings('Admin_Tatil_Gunleri') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Admin_Tatil_Gunleri_Tarih') }}</label>
                                <input class="form-control " required type="date" name="Tarih" />
                            </div>

                            <div class="form-group col-md-12 m05">
                                <label class="form-control-label plabelno"
                                    for="inputBasicLastName">{{ $lang::settings('Tatil_Ismi') }}</label>
                                <input class="form-control " required type="text" name="GunBASLIK" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">{{ $lang::settings('Isci_Paneli_Kaydet') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <div class="modal fade" id="add_emailtemplate_modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form action="{{ route('emailtemplates.store') }}" method="POST">
                    <div class="modal-header">
                        <input type="text" name="title" class="form-control round modal-input-title" value="" required>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    @csrf
                    <div class="modal-body bg">
                        <div class="form-body mt-1">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <label for="subject">Subject</label>
                                                <input type="text" class="form-control" name="subject" required>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <label for="message">Message</label>

                                                <div id="snow-wrapper">
                                                    <div id="snow-container">
                                                        <div class="editor">

                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row skin skin-flat">
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-1" name="word_template">
                                                        <label for="input-1">Make this as Text Templates</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h3>Add variable</h3>
                                    <p><i>
                                            <small>Variables are populated with custom information when applied to an
                                                invoice. </small>
                                        </i></p>

                                    <p><i>
                                            <small>Place your cursor in the location where you would like to insert the
                                                variable, the <strong>click below to insert</strong></small>
                                        </i></p>

                                    <div class="options">
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block"
                                            data-variable="name"> NAME <br> <small>[[ name ]]</small></button>
                                    </div>

                                    @if (count($text_templates) > 0)
                                        <div class="form-group mt-2">
                                            <label>Use word template</label>
                                            <select class="form-control select-word-template">
                                                <option value="">none</option>
                                                @foreach ($text_templates as $text)
                                                    <option value="{{ $text->id }}">{{ $text->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="template-preview mt-1 hide">

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary preview-button">Preview</button>
                        <button class="btn btn-outline-success" type="submit"> Save </button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_emailtrigger_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('emailtriggers.store') }}" class="form-add-trigger" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Trigger</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>

                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="action_id">Trigger when</label>
                                        <select name="action_id" class="form-control" required>
                                            <option value="">Select action</option>
                                            @if (count($actions) > 0)
                                                @foreach ($actions as $action)
                                                    <option value="{{ $action->id }}">{{ $action->description }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="template_id">Email Template</label>
                                        <select name="template_id" class="form-control" required>
                                            <option value="">Select template</option>
                                            @if (count($templates) > 0)
                                                @foreach ($templates as $template)
                                                    <option value="{{ $template->id }}">{{ $template->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="submit"> Save </button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_emailtrigger_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('emailtriggers.update') }}" class="form-edit-trigger" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Trigger</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="action_id">Trigger when</label>
                                        <select name="action_id" class="form-control" required>
                                            <option value="">Select action</option>
                                            @if (count($actions) > 0)
                                                @foreach ($actions as $action)
                                                    <option value="{{ $action->id }}">{{ $action->description }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="template_id">Email Template</label>
                                        <select name="template_id" class="form-control" required>
                                            <option value="">Select template</option>
                                            @if (count($templates) > 0)
                                                @foreach ($templates as $template)
                                                    <option value="{{ $template->id }}">{{ $template->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="submit"> Save </button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_action_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('emailactions.store') }}" class="form-add-action" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Action</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>

                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" class="form-control"
                                            placeholder="E.g When new task assigned to employee">
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="command_id">Command</label>
                                        <select name="command_id" class="form-control" required>
                                            <option value="">Select command</option>
                                            @if (count($commands) > 0)
                                                @foreach ($commands as $command)
                                                    <option value="{{ $command->id }}">{{ $command->code }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="submit"> Save </button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_action_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('emailactions.update') }}" class="form-edit-action" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Action</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" class="form-control"
                                            placeholder="E.g When new task assigned to employee">
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="command_id">Command</label>
                                        <select name="command_id" class="form-control" required>
                                            <option value="">Select command</option>
                                            @if (count($commands) > 0)
                                                @foreach ($commands as $command)
                                                    <option value="{{ $command->id }}">{{ $command->code }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="submit"> Save </button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('name')
    
@endsection

@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/quill/quill.js') }}"></script>
    <script>
        $(document).ready(() => {
            $(`#account-upload`).on('change', e => {
                if(e.target.files.length > 0) {
                    const reader = new FileReader();

                    reader.onload = event => {
                        $(`#account-upload-preview`).attr('src', event.target.result);
                    };

                    reader.readAsDataURL(e.target.files.item(0));
                }
            });

            // not defined
            // bsCustomFileInput.init();

            $("#example1").DataTable();
            $('.form-update-gensettings').submit(function(e) {
                e.preventDefault();
                axios.post($(this).attr('action'), new FormData(this)).then(({ data }) => {
                    if (data.success) {
                        toastr.success(data.msg);

                        setTimeout(function() {
                            document.location = "{{ route('admin.settings.general') }}";
                        }, 1000)
                    }
                });
            });

            $('.form-add-type').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        if (resp.success) {
                            Toast.fire({
                                icon: 'success',
                                title: resp.msg,
                                showConfirmButton: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000)
                        }
                    }
                })
            });

            $('.btn-edit-type').on('click', async function() {
                let edit_modal = $('#edit_type_modal');
                let form = edit_modal.find('form');
                let id = $(this).data().id;
                edit_modal.modal();
                const type = await $.ajax({
                    url: "{{ route('tickettypes.edit') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    }
                });

                form.find('input[name=id]').val(type.id);
                form.find('input[name=name]').val(type.name);
            });

            $('.form-edit-type').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        if (resp.success) {
                            Toast.fire({
                                icon: 'success',
                                title: resp.msg,
                                showConfirmButton: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000)
                        }
                    }
                })
            });

            $('.btn-delete-type').on('click', async function() {
                let id = $(this).data().id;

                Swal.fire({
                    text: 'Are you sure you want to delete this type?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    confirmButtonClass: "btn btn-primary",
                    cancelButtonClass: "btn btn-danger ml-1"
                }).then(async result => {
                    if (result.value) {
                        const delete_type = await $.ajax({
                            url: "{{ route('tickettypes.destroy') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id
                            }
                        });

                        if (delete_type.success) {
                            Swal.fire({
                                text: delete_type.msg,
                                type: 'success',
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            });

            $('.form-add-vacationdays').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        Toast.fire({
                            icon: 'success',
                            title: resp.msg,
                            showConfirmButton: false,
                        });

                        setTimeout(function() {
                            $('#add_vacation_modal').modal('toggle');
                            $('.table-vacation tbody').prepend(`
                            <tr data-id="${resp.details.GunID}">
                                <td>${resp.details.Tarih}</td>
                                <td>${resp.details.GunBASLIK}</td>
                                
                                <td class="text-right">
                                    <div class="dropdown pull-right">
                                        <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="fass fa-pen-square" aria-hidden="true"></i></button>
                                        <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu">
                                            <button class="dropdown-item btn-edit-vacation" data-id="${resp.details.GunID}">Bearbeiten}</button>
                                            <button class="dropdown-item btn-delete-vacation" data-id="${resp.details.GunID}">Löschen</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            `).hide().fadeIn(300);
                        }, 1000);
                    }
                })
            });

            $('.form-edit-vacationdays').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        Toast.fire({
                            icon: 'success',
                            title: resp.msg,
                            showConfirmButton: false,
                        });

                        setTimeout(function() {
                            $('#edit_vacation_modal').modal('toggle');
                            $('.table-vacation tbody tr[data-id=' + resp.details.GunID + ']').hide()
                                .replaceWith(
                                    `
                                <tr data-id="${resp.details.GunID}">
                                    <td>${resp.details.Tarih}</td>
                                    <td>${resp.details.GunBASLIK}</td>
                                    
                                    <td class="text-right">
                                        <div class="dropdown pull-right">
                                            <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="fass fa-pen-square" aria-hidden="true"></i></button>
                                            <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu">
                                                <button class="dropdown-item btn-edit-vacation" data-id="${resp.details.GunID}">Bearbeiten}</button>
                                                <button class="dropdown-item btn-delete-vacation" data-id="${resp.details.GunID}">Löschen</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                `
                                ).fadeIn(1000);
                        }, 1000);
                    }
                })
            });

            $('.table-vacation').on('click', '.btn-edit-vacation', function() {
                $("#edit_vacation_modal").modal('show');
                let form = $('.form-edit-vacationdays');
                $.ajax({
                    url: "{{ route('admin.settings.vacationdays-edit') }}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        GunID: $(this).data('id')
                    },
                    success: function(resp) {
                        form.find('input[name=GunID]').val(resp.GunID);
                        form.find('input[name=Tarih]').val(resp.Tarih);
                        form.find('input[name=GunBASLIK]').val(resp.GunBASLIK);
                    }
                })
            });

            $('.table-vacation').on('click', '.btn-delete-vacation', async function() {
                let id = $(this).data().id;

                Swal.fire({
                    text: 'Are you sure you want to delete this vacation?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    confirmButtonClass: "btn btn-primary",
                    cancelButtonClass: "btn btn-danger ml-1"
                }).then(async result => {
                    if (result.value) {
                        const deleteItem = await $.ajax({
                            url: "{{ route('admin.settings.vacationdays-delete') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                GunID: $(this).data('id')
                            }
                        });

                        if (deleteItem.success) {
                            Swal.fire({
                                text: deleteItem.msg,
                                type: 'success',
                            }).then(() => {
                                $('.table-vacation tbody tr[data-id=' + deleteItem.id + ']')
                                    .fadeOut(600).remove();
                            });
                        }
                    }
                });
            });

            $('.form-add-code').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        if (resp.success) {
                            Toast.fire({
                                icon: 'success',
                                title: resp.msg,
                                showConfirmButton: false,
                            });

                            setTimeout(function() {
                                $('#add_code_modal').modal('hide');
                                $('.table-code tbody').append(`
                                    <tr>
                                        <td>${resp.details.KodBASLIK}</td>
                                        <td>${resp.details.Kod}</td>
                                        <td>${resp.details.Parabir}</td>
                                        <td>${resp.details.Paraiki}</td>
                                    </tr>
                                `);
                            }, 1000);
                        }
                    }
                })
            });

            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons

                [{
                    'header': 1
                }, {
                    'header': 2
                }], // custom button values
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }, 'blockquote', 'code-block'],

                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }], // superscript/subscript

                [{
                    'size': ['small', false, 'large', 'huge']
                }], // custom dropdown

                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],

                [{
                    'color': []
                }, {
                    'background': []
                }], // dropdown with defaults from theme
                [{
                    'font': []
                }],

                [{
                    'align': []
                }],

                ['link', 'image'],

                ['clean'] // remove formatting button
            ];

            let quill = new Quill('.editor', {
                modules: {
                    toolbar: {
                        container: toolbarOptions,
                        handlers: {
                            image: imageHandler
                        }
                    }
                },
                theme: 'snow'
            });

            function imageHandler() {
                var range = this.quill.getSelection();
                var value = prompt('What is the image URL');
                if (value) {
                    this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
                }
            }

            $('.btn_add_email_template').on('click', function() {
                let add_modal = $('#add_emailtemplate_modal');
                let form = add_modal.find('form');

                $('.form-body').removeClass('hide');
                $('.template-preview').addClass('hide');
                $('.preview-button').text('Preview');

                add_modal.modal();
                form[0].reset();
                quill.root.innerHTML = "";
                form.find('input[name=id]').remove();
                form.attr('action', "{{ route('emailtemplates.store') }}");
                form.find('input[name=title]').val('New Template');
                form.find('input[name=title]').focus();
            });

            $('.table-emailtemplate').on('click', '.edit_template', async function() {
                $('.form-body').removeClass('hide');
                $('.template-preview').addClass('hide');
                $('.preview-button').text('Preview');

                let add_modal = $('#add_emailtemplate_modal');
                let form = add_modal.find('form');
                let id = $(this).data().id;

                add_modal.modal();
                quill.root.innerHTML = "";
                form[0].reset();
                form.attr('action', "{{ route('emailtemplates.update') }}");

                const result = await $.ajax({
                    url: "{{ route('emailtemplates.edit') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    }
                });

                const template = result['data'].template;
                form.find('input[name=id]').remove();
                form.prepend(`<input type="hidden" name="id" value="${template.id}" />`);
                form.find('input[name=title]').val(template.title);
                form.find('input[name=subject]').val(template.subject);
                form.find('input[name=sender]').val(template.sender);
                quill.root.innerHTML = template.body;

                switch (template.attach_invoice) {
                    case 0:
                        form.find('input[name=attach_invoice]').prop('checked', false);
                        break;
                    case 1:
                        form.find('input[name=attach_invoice]').prop('checked', true);
                        break;
                }

                switch (template.embed_invoice) {
                    case 0:
                        form.find('input[name=embed_invoice]').prop('checked', false);
                        break;
                    case 1:
                        form.find('input[name=embed_invoice]').prop('checked', true);
                        break;
                }

                switch (template.word_template) {
                    case 0:
                        form.find('input[name=word_template]').prop('checked', false);
                        break;
                    case 1:
                        form.find('input[name=word_template]').prop('checked', true);
                        break;
                }

                form.find('input[name=title]').focus();


                $('.template-preview').html('');

            });

            $('.table-emailtemplate').on('click', '.view_template', async function() {
                $('.template-preview').html('');
                $('.form-body').addClass('hide');
                $('.template-preview').removeClass('hide');
                $('.preview-button').text('Edit');

                let add_modal = $('#add_emailtemplate_modal');
                let form = add_modal.find('form');
                let id = $(this).data().id;

                add_modal.modal();
                quill.root.innerHTML = "";
                form[0].reset();
                form.attr('action', "{{ route('emailtemplates.update') }}");

                const result = await $.ajax({
                    url: "{{ route('emailtemplates.edit') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    }
                });

                const template = result['data'].template;
                form.find('input[name=id]').remove();
                form.prepend(`<input type="hidden" name="id" value="${template.id}" />`);
                form.find('input[name=title]').val(template.title);
                form.find('input[name=subject]').val(template.subject);
                form.find('input[name=sender]').val(template.sender);
                quill.root.innerHTML = template.body;

                switch (template.attach_invoice) {
                    case 0:
                        form.find('input[name=attach_invoice]').prop('checked', false);
                        break;
                    case 1:
                        form.find('input[name=attach_invoice]').prop('checked', true);
                        break;
                }

                switch (template.embed_invoice) {
                    case 0:
                        form.find('input[name=embed_invoice]').prop('checked', false);
                        break;
                    case 1:
                        form.find('input[name=embed_invoice]').prop('checked', true);
                        break;
                }

                form.find('input[name=title]').focus();




                $('.template-preview').html('<div class="ql-snow"><div class="ql-editor">' + quill.root.innerHTML +
                    '</div></div>');
            });

            $('.table-emailtemplate').on('click', '.delete_template', async function() {
                let id = $(this).data().id;

                Swal.fire({
                    text: 'Are you sure you want to delete this template?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    confirmButtonClass: "btn btn-primary",
                    cancelButtonClass: "btn btn-danger ml-1"
                }).then(async result => {
                    if (result.value) {
                        const delete_template = await $.ajax({
                            url: "{{ route('emailtemplates.destroy') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id
                            }
                        });

                        if (delete_template.success) {
                            Swal.fire({
                                text: delete_template.msg,
                                type: 'success',
                            }).then(() => {
                                let table = $('.table-emailtemplate tbody');
                                table.find('[data-id=' + delete_template.id + ']').parent()
                                    .parent().fadeOut(300);
                            });
                        }
                    }
                });
            });

            $('#add_emailtemplate_modal .options').on('click', 'button', function() {
                quill.focus();
                let data = $(this).data();
                let caretPosition = quill.getSelection(true);
                quill.insertText(caretPosition, '[[' + data.variable + ']]');
            });

            $('#add_emailtemplate_modal').on('submit', 'form', function(e) {
                e.preventDefault();
                let editor_content = quill.root.innerHTML;

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize() + '&body=' + editor_content,
                    success: function(resp) {
                        if (resp.success) {
                            Swal.fire({
                                text: resp.msg,
                                type: 'success'
                            }).then(() => {
                                $('#add_emailtemplate_modal').modal('hide');
                                if (resp.action == 'add') {
                                    let table = $('.table-emailtemplate tbody');
                                    table.append(`
                                    <tr>
                                        <td>${resp.template.title}</td>
                                        <td>${resp.template.subject}</td>
                                        <td>
                                            <a href="#" class="edit_template" data-id="${resp.template.id}"><i class="fas fa-fw fa-pencil text-warning"></i></a>
                                            <a href="#" class="view_template" data-id="${resp.template.id}"><i class="fas fa-fw fa-eye text-primary"></i></a>
                                            <a href="#" class="delete_template" data-id="${resp.template.id}"><i class="fas fa-fw fa-trash text-danger "></i></a>
                                        </td>
                                    </tr>
                                    `);
                                }

                                if (resp.action == 'edit') {
                                    let table = $('.table-emailtemplate tbody');
                                    table.find('[data-id=' + resp.template.id + ']').parent()
                                        .parent().hide().replaceWith(`
                                    <tr>
                                        <td>${resp.template.title}</td>
                                        <td>${resp.template.subject}</td>
                                        <td>
                                            <a href="#" class="edit_template" data-id="${resp.template.id}"><i class="fas fa-fw fa-pencil text-warning"></i></a>
                                            <a href="#" class="view_template" data-id="${resp.template.id}"><i class="fas fa-fw fa-eye text-primary"></i></a>
                                            <a href="#" class="delete_template" data-id="${resp.template.id}"><i class="fas fa-fw fa-trash text-danger "></i></a>
                                        </td>
                                    </tr>
                                    `);

                                }
                            })
                        }
                    }
                })
            });

            $('#add_emailtemplate_modal .select-word-template').on('change', async function() {

                const id = $(this).val();

                if (id != null && id != "") {
                    const {
                        data
                    } = await $.ajax({
                        url: "{{ route('emailtemplates.edit') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        }
                    });

                    quill.root.innerHTML = data.template.body;


                } else {
                    quill.root.innerHTML = "";
                }



            });

            $('#add_emailtemplate_modal').on('click', '.preview-button', function() {

                let content = quill.root.innerHTML;

                if ($('.form-body').hasClass('hide')) {
                    $(this).text('Preview');
                    $('.form-body').removeClass('hide');
                    $('.template-preview').addClass('hide');
                } else {
                    $('.form-body').addClass('hide');
                    $('.template-preview').removeClass('hide');
                    $('.template-preview').html('<div class="ql-snow"><div class="ql-editor">' + content +
                        '</div></div>');
                    $(this).text('Back');
                }
            });

            $('#edit_emailtrigger_modal').on('submit', 'form', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        if (resp.success) {
                            Toast.fire({
                                icon: 'success',
                                title: resp.msg,
                                showConfirmButton: false,
                            });
                            setTimeout(function() {
                                let table = $('.table-emailtrigger tbody');
                                $('#edit_emailtrigger_modal').modal('hide');
                                table.find('[data-id=' + resp.trigger.id + ']').parent().parent()
                                    .replaceWith(`
                                <tr>
                                    <td>${resp.trigger.action.description }</td>
                                    <td>${resp.trigger.template.title }</td>
                                    <td>
                                        <a href="#" class="edit_trigger" data-id="${resp.trigger.id}"><i class="fas fa-fw fa-edit text-primary"></i></a>
                                        <a href="#" class="delete_trigger" data-id="${resp.trigger.id}"><i class="fas fa-fw fa-trash text-danger "></i></a>
                                    </td>
                                </tr>
                                `).fadeIn(300);
                            }, 1000)
                        }
                    }
                })
            });

            $('.table-emailtrigger').on('click', '.edit_trigger', async function() {
                let edit_modal = $('#edit_emailtrigger_modal');
                let form = edit_modal.find('form');
                let id = $(this).data().id;
                edit_modal.modal();
                const trigger = await $.ajax({
                    url: "{{ route('emailtriggers.edit') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    }
                });

                form.find('input[name=id]').val(trigger.id);
                form.find('select[name=action_id]').val(trigger.action_id);
                form.find('select[name=template_id]').val(trigger.template_id);

            });

            $('#add_emailtrigger_modal').on('submit', 'form', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        if (resp.success) {
                            Toast.fire({
                                icon: 'success',
                                title: resp.msg,
                                showConfirmButton: false,
                            });
                            $('#add_emailtrigger_modal').modal('hide');
                            setTimeout(function() {
                                let table = $('.table-emailtrigger tbody');
                                table.append(`
                                    <tr>
                                        <td>${resp.trigger.action.description }</td>
                                        <td>${resp.trigger.template.title }</td>
                                        <td>
                                            <a href="#" class="edit_trigger" data-id="${resp.trigger.id}"><i class="fas fa-fw fa-edit text-primary"></i></a>
                                            <a href="#" class="delete_trigger" data-id="${resp.trigger.id}"><i class="fas fa-fw fa-trash text-danger "></i></a>
                                        </td>
                                    </tr>
                                `);
                            }, 1000)
                        }
                    }
                })
            });

            $('.table-emailtrigger').on('click', '.delete_trigger', async function() {
                let id = $(this).data().id;

                Swal.fire({
                    text: 'Are you sure you want to delete this trigger?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    confirmButtonClass: "btn btn-primary",
                    cancelButtonClass: "btn btn-danger ml-1"
                }).then(async result => {
                    if (result.value) {
                        const delete_trigger = await $.ajax({
                            url: "{{ route('emailtriggers.destroy') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id
                            }
                        });

                        if (delete_trigger.success) {
                            Swal.fire({
                                text: delete_trigger.msg,
                                type: 'success',
                            }).then(() => {
                                let table = $('.table-emailtrigger tbody');
                                table.find('[data-id=' + delete_trigger.id + ']').parent()
                                    .parent().fadeOut(600);
                            });
                        }
                    }
                });
            });

            $('#add_action_modal').on('submit', 'form', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        if (resp.success) {
                            Toast.fire({
                                icon: 'success',
                                title: resp.msg,
                                showConfirmButton: false,
                            });
                            $('#add_action_modal').modal('hide');
                            setTimeout(function() {
                                let table = $('.table-actions tbody');
                                table.append(`
                                    <tr>
                                        <td>${resp.action.description}</td>
                                        <td>${resp.action.command.code}</td>
                                        <td>
                                            <a href="#" class="edit_action" data-id="${resp.action.id}"><i class="fas fa-fw fa-edit text-primary"></i></a>
                                            <a href="#" class="delete_action" data-id="${resp.action.id}"><i class="fas fa-fw fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                `);
                            }, 1000);
                        }
                    }
                })
            });


            $('.table-actions').on('click', '.edit_action', async function() {
                let edit_modal = $('#edit_action_modal');
                let form = edit_modal.find('form');
                let id = $(this).data().id;
                edit_modal.modal();
                const action = await $.ajax({
                    url: "{{ route('emailactions.edit') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    }
                });

                form.find('input[name=id]').val(action.id);
                form.find('input[name=description]').val(action.description);
                form.find('select[name=command_id]').val(action.command_id);
            });

            $('#edit_action_modal').on('submit', '.form-edit-action', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        if (resp.success) {
                            Toast.fire({
                                icon: 'success',
                                title: resp.msg,
                                showConfirmButton: false,
                            });

                            setTimeout(function() {
                                let table = $('.table-actions tbody');
                                $('#edit_action_modal').modal('hide');
                                table.find('[data-id=' + resp.action.id + ']').parent().parent()
                                    .replaceWith(`
                                    <tr>
                                        <td>${resp.action.description}</td>
                                        <td>${resp.action.command.code}</td>
                                        <td>
                                            <a href="#" class="edit_action" data-id="${resp.action.id}"><i class="fas fa-fw fa-edit text-primary"></i></a>
                                            <a href="#" class="delete_action" data-id="${resp.action.id}"><i class="fas fa-fw fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                `);
                            }, 1000)
                        }
                    }
                })
            });

            $('.table-actions').on('click', '.delete_action', async function() {
                let id = $(this).data().id;

                Swal.fire({
                    text: 'Are you sure you want to delete this action?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    confirmButtonClass: "btn btn-primary",
                    cancelButtonClass: "btn btn-danger ml-1"
                }).then(async result => {
                    if (result.value) {
                        const delete_action = await $.ajax({
                            url: "{{ route('emailactions.destroy') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id
                            }
                        });

                        if (delete_action.success) {
                            Swal.fire({
                                text: delete_action.msg,
                                type: 'success',
                            }).then(() => {
                                let table = $('.table-actions tbody');
                                table.find('[data-id=' + delete_action.id + ']').parent()
                                    .parent().fadeOut(600);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection

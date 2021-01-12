@extends('layouts.admin.main')

@section('stylesheets')

    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        @include('admin.partials.breadcrumbs', ['title' => 'Expenses'])
    </div>
@endsection

@section('content')
    <div class="users-list-wrapper">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table id="expenses-table" class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Cost</th>
                            <th>Date</th>
                            <th class="cell-fit">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="add-expense-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/api/finance/expenses" id="add-expense-form" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" placeholder="Description" id="description" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="number" name="cost" id="cost" class="form-control" placeholder="Cost" />
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" name="date" id="date" class="form-control" placeholder="Date" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view-expense-modal" tabindex="-1" role="dialog" aria-labelledby="viewexampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewexampleModalCenterTitle">View Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="view-expense-name"></h4>
                    <div class="my-1">
                        Cost: <b id="view-expense-cost"></b>
                    </div>
                    <div class="my-1">
                        Date: <b id="view-expense-date"></b>
                    </div>
                    <div id="view-expense-description"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-expense-modal" tabindex="-1" role="dialog" aria-labelledby="deleteexampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteexampleModalCenterTitle">Delete Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this expense?</p>
                </div>
                <div class="modal-footer">
                    <button id="confirm-button" class="btn btn-danger btn-sm" data-id="-1" data-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/pages/app-finance-expenses.js') }}"></script>
@endsection

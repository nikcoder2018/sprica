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
    <style>
        .invoice-form-item {
            padding: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(34, 41, 47, 0.075);
            border-radius: 0.357rem;
            border: 1px solid #EBE9F1;
            margin: 1rem 0;
        }
    </style>
@endsection

@section('header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        @include('admin.partials.breadcrumbs', ['title' => 'Invoices'])
    </div>
@endsection

@section('content')
    <div class="users-list-wrapper">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table id="invoices-table" class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Invoice Number</th>
                            <th>Date of Issue</th>
                            <th>Total</th>
                            <th class="cell-fit">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="add-invoice-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/api/finance/invoices" id="add-invoice-form" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" placeholder="Address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="invoice_number">Invoice Number</label>
                            <input type="text" name="invoice_number" id="invoice_number" placeholder="Invoice Number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="date_of_issue">Date of Issue</label>
                            <input type="text" name="date_of_issue" id="date_of_issue" placeholder="Date of Issue" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="items">Items</label>
                            <div class="form-group">
                                <button type="button" class="btn btn-info btn-sm" id="add-invoice-item-button">Add Item</button>
                            </div>
                            <div id="invoice-form-items">
                                <div class="invoice-form-item">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-sm invoice-form-item-remove-button">Remove Item</button>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="items[0][name]" placeholder="Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="items[0][description]" placeholder="Description" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input type="number" name="items[0][cost]" placeholder="Cost" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" name="items[0][quantity]" placeholder="Quantity" class="form-control">
                                    </div>
                                </div>
                            </div>
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
    <div class="modal fade" id="view-invoice-modal" tabindex="-1" role="dialog" aria-labelledby="viewexampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewexampleModalCenterTitle">View Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div id="view-invoice-header">
                                <h4 id="view-invoice-name" class="card-title d-block"></h4>
                                <p class="card-text d-block" id="view-invoice-email"></p>
                                <p class="card-text d-block" id="view-invoice-address"></p>
                                <p class="card-text d-block" id="view-invoice-date-of-issue"></p>
                                <p id="view-invoice-number" class="card-text"></p>
                                <p class="card-text d-block" id="view-invoice-date-of-issue"></p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Cost</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="view-invoice-items"></tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    <tr>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center" id="view-invoice-total"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm btn-print">Print</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-invoice-modal" tabindex="-1" role="dialog" aria-labelledby="deleteexampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteexampleModalCenterTitle">Delete Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this invoice?</p>
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
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/pages/app-finance-invoices.js') }}"></script>
@endsection

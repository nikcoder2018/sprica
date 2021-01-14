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
            display : -webkit-box;
            display : -webkit-flex;
            display : -ms-flexbox;
            display :         flex;
            -webkit-flex-wrap : wrap;
                -ms-flex-wrap : wrap;
                    flex-wrap : wrap;
            margin-right : -1rem;
            margin-left : -1rem;
        }

        .form-group-button, .form-group-name,
        .form-group-description, .form-group-cost,
        .form-group-quantity, .form-group-amount {
            position : relative !important;
            width : 100% !important;
            padding-right : 1rem !important;
            padding-left : 1rem !important;
            -webkit-box-flex : 0;
            -webkit-flex : 0 0 100%;
                -ms-flex : 0 0 100%;
                    flex : 0 0 100%;
            max-width : 100%;
        }

        @media(min-width: 768px) {
            /* col-md-6 */
            .form-group-name, .form-group-cost, .form-group-quantity {
                -webkit-box-flex : 0;
                -webkit-flex : 0 0 50%;
                    -ms-flex : 0 0 50%;
                        flex : 0 0 50%;
                max-width : 50%;
            }
        }

        @media(min-width: 992px) {
            /* col-lg-4 */
            .form-group-name, .form-group-cost, .form-group-quantity {
                -webkit-box-flex : 0;
                -webkit-flex : 0 0 33.33333%;
                    -ms-flex : 0 0 33.33333%;
                        flex : 0 0 33.33333%;
                max-width : 33.33333%;
            }
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
                            <th>Project</th>
                            <th>Shipping Address</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Date Due</th>
                            <th>Status</th>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="project_id">Project</label>
                                    <select name="project_id" id="project_id" class="form-control">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="address">Shipping Address</label>
                                    <input type="text" name="address" id="address" placeholder="Shipping Address" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="invoice_number">Invoice Number</label>
                                    <input type="text" name="invoice_number" id="invoice_number" placeholder="Invoice Number" readonly class="form-control disabled">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="date_of_issue">Invoice Date</label>
                                    <input type="text" name="date_of_issue" id="date_of_issue" placeholder="Date of Issue" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="text" name="due_date" id="due_date" placeholder="Due Date" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Partially Paid">Partially Paid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="items">Items</label>
                            <div class="form-group">
                                <button type="button" class="btn btn-info btn-sm" id="add-invoice-item-button">Add Item</button>
                            </div>
                            <div id="invoice-form-items">
                                <div class="invoice-form-item">
                                    <div class="form-group form-group-button">
                                        <button type="button" class="btn btn-danger btn-sm invoice-form-item-remove-button">Remove Item</button>
                                    </div>
                                    <div class="form-group form-group-name">
                                        <label>Name</label>
                                        <input type="text" name="items[0][name]" placeholder="Name" class="form-control form-name">
                                    </div>
                                    <div class="form-group form-group-cost">
                                        <label>Cost</label>
                                        <input type="number" name="items[0][cost]" placeholder="Cost" class="form-control form-cost">
                                    </div>
                                    <div class="form-group form-group-quantity">
                                        <label>Quantity</label>
                                        <input type="number" name="items[0][quantity]" placeholder="Quantity" class="form-control form-quantity">
                                    </div>
                                    <div class="form-group form-group-description">
                                        <label>Description</label>
                                        <textarea name="items[0][description]" placeholder="Description" class="form-control form-description" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group form-group-amount">
                                        <label>Amount</label>
                                        <input type="text" name="items[0][amount]" placeholder="Amount" disabled value="$ 0" class="form-control disabled form-amount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="text" name="total" id="total" disabled placeholder="Total" value="$ 0" class="form-control disabled">
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
                                <p class="card-text d-block" id="view-invoice-project"></p>
                                <p class="card-text d-block" id="view-invoice-address"></p>
                                <p class="card-text d-block" id="view-invoice-date-of-issue"></p>
                                <p class="card-text d-block" id="view-invoice-number"></p>
                                <p class="card-text d-block" id="view-invoice-due-date"></p>
                                <p class="card-text d-block" id="view-invoice-status"></p>
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

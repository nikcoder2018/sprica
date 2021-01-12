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
        .estimate-form-item {
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
        @include('admin.partials.breadcrumbs', ['title' => 'Estimates'])
    </div>
@endsection

@section('content')
    <div class="users-list-wrapper">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table id="estimates-table" class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Estimate Number</th>
                            <th>Valid Until</th>
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
    <div class="modal fade" id="add-estimate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Estimate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/api/finance/estimates" id="add-estimate-form" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="estimate_number">Estimate Number</label>
                            <input type="text" name="estimate_number" id="estimate_number" readonly placeholder="Estimate Number" class="form-control disabled">
                        </div>
                        <div class="form-group">
                            <label for="valid_until">Valid Until</label>
                            <input type="text" name="valid_until" id="valid_until" placeholder="Valid Until" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="items">Items</label>
                            <div class="form-group">
                                <button type="button" class="btn btn-info btn-sm" id="add-estimate-item-button">Add Item</button>
                            </div>
                            <div id="estimate-form-items">
                                <div class="estimate-form-item">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-sm estimate-form-item-remove-button">Remove Item</button>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="items[0][name]" placeholder="Name" class="form-control form-name">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="items[0][description]" placeholder="Description" class="form-control form-description" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input type="number" name="items[0][cost]" placeholder="Cost" class="form-control form-cost">
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" name="items[0][quantity]" placeholder="Quantity" class="form-control form-quantity">
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" name="items[0][amount]" placeholder="Amount" disabled class="form-control form-amount disabled" value="$ 0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="text" name="total" id="total" disabled placeholder="Total" class="disabled form-control form-total" value="$ 0">
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
    <div class="modal fade" id="view-estimate-modal" tabindex="-1" role="dialog" aria-labelledby="viewexampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewexampleModalCenterTitle">View Estimate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div id="view-estimate-header">
                                <p class="card-text d-block" id="view-estimate-number"></p>
                                <p class="card-text d-block" id="view-estimate-valid-until"></p>
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
                                <tbody id="view-estimate-items"></tbody>
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
                                        <td class="text-center" id="view-estimate-total"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-info btn-sm btn-print">Print</button> --}}
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-estimate-modal" tabindex="-1" role="dialog" aria-labelledby="deleteexampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteexampleModalCenterTitle">Delete Estimate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this estimate?</p>
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
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/pages/app-finance-estimates.js') }}"></script>
@endsection

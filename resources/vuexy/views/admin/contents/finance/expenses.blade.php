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
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Employee</th>
                            <th>Purchased From</th>
                            <th>Purchase Date</th>
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label for="user_id">Choose Member</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label for="project_id">Project</label>
                                    <select name="project_id" id="project_id" class="form-control">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label for="purchased_from">Purchased From</label>
                                    <input type="text" name="purchased_from" id="purchased_from" placeholder="Purchased From" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label for="name">Purchase Date</label>
                                    <input type="text" name="purchase_date" id="purchase_date" placeholder="Purchase Date" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label for="category_id">
                                        Expense Category
                                        <i id="add-category-button" class="fas fa-plus fa-border rounded-circle" style="cursor: pointer;"></i>
                                    </label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" placeholder="Price" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label for="currency">Currency</label>
                                    <select name="currency" id="currency" class="form-control">
                                        <option value="USD">Dollars - ($)</option>
                                        <option value="GBP">Pounds - (£)</option>
                                        <option value="INR">Rupee - (₹)</option>
                                        <option value="EUR">Euro - (€)</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="bill">Bill</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="bill" name="bill">
                                        <label class="custom-file-label" for="bill">Choose file</label>
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
    <div class="modal fade" id="add-category-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="add-category-form" action="/api/finance/expenses/categories" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
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
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label>Name</label>
                                <p id="view-expense-name"></p>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label>Project</label>
                                <p id="view-expense-project"></p>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label>Category</label>
                                <p id="view-expense-category"></p>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label>Price</label>
                                <p id="view-expense-price"></p>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label>Employee</label>
                                <p id="view-expense-employee"></p>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label>Purchased From</label>
                                <p id="view-expense-purchased-from"></p>
                            </div>
                        </div>
                    </div>
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

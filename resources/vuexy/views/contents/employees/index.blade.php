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

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection
@section('content')
<section class="app-employees-list">
    <!-- users filter start -->
    <div class="card">
        <h5 class="card-header">Search Filter</h5>
        <div class="mx-50 row pt-0 pb-2">
            <div class="col-md-3 form-group">
                <label>Role</label>
                <select class="select2 filters filter-role form-control text-capitalize mb-md-0 mb-2xx">
                    <option value=""> Select Role </option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label>Status</label>
                <select class="form-control filters filter-status text-capitalize mb-md-0 mb-2xx">
                    <option value=""> All </option>
                    <option value="1"> Active </option>
                    <option value="0"> Inactive </option>
                </select>
            </div>
        </div>
    </div>
    <!-- users filter end -->
    <!-- list section start -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="employees-list-table table">
                <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Account Name</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
        
    </div>
    <!-- list section end -->
</section>
@endsection
@section('modals')
<div class="modal fade" id="new-users-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('users.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label>Re-type Password</label>
                                <input type="password" class="form-control" name="confirm_password" required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="select2 form-control form-control-lg" name="roles[]" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->title }}</option>
                                    @endforeach
                                </select>
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
@endsection
@section('external_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endsection
@section('scripts')
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/forms/form-select2.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-employees.js')}}"></script>
@endsection
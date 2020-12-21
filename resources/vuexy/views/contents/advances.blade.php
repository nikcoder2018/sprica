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
<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
  <div class="form-group breadcrumb-right">
      <div class="dropdown">
          <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
          <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{route('payroll.index')}}">
                  <i class="mr-1" data-feather="check-square"></i><span class="align-middle">Payroll</span>
              </a>
              <a class="dropdown-item" href="{{route('payrolltotal.index')}}">
                  <i class="mr-1" data-feather="message-square"></i><span class="align-middle">Payroll Total</span>
              </a>
          </div>
      </div>
  </div>
</div>
@endsection
@section('content')
<section class="advances-list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="advances-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Receied On</th>
                        <th>Debit On</th>
                        <th>Amount</th>
                        <th>Employee</th>
                        <th>Paid By</th>
                        <th class="cell-fit">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>    
@endsection

@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="new-advance-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('advances.store')}}">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12">
                          <label>Employee</label>
                          <select name="user_id" class="select2 form-control">
                              @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>

                        <div class="row">
                          <div class="form-group col-md-6">
                              <label>Receive On</label>
                              <input type="text" name="received_at" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" />
                          </div>
                          <div class="form-group col-md-6">
                            <label>Debit On</label>
                            <input type="text" name="debit_at" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" />
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <label>Amount</label>
                            <input type="number" name="amount" step="0.01"  class="form-control">
                          </div>
                          <div class="col-md-6">
                            <label>Paid By</label>
                            <select name="paid_by" class="select2 form-control">
                              <option value="cash">Cash</option>
                              <option value="cash">Bank</option>
                            </select>
                          </div>
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
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-advances.js')}}"></script>
@endsection
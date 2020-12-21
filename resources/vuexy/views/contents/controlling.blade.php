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
<section class="app-user-list">
    <!-- users filter start -->
    <div class="card">
        <h5 class="card-header">Search Filter</h5>
        <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
            <div class="col-md-3 form-group">
                <label>Employee</label>
                <select class="select2 filters filter-employee form-control text-capitalize mb-md-0 mb-2xx">
                    <option value=""> Select Employee </option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}"> {{$user->name}} ({{$user->totalConfirmedTimelog}}) </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label>Date from</label>
                <input type="text" id="fp-default" class="form-control filters filter-date-from flatpickr-date flatpickr-input" placeholder="YYYY-MM-DD" readonly="readonly">
            </div>
            <div class="col-md-3 form-group">
                <label>Date to</label>
                <input type="text" id="fp-default" class="form-control filters filter-date-to flatpickr-date flatpickr-input" placeholder="YYYY-MM-DD" readonly="readonly">
            </div>
            <div class="col-md-3 form-group">
                <label>Confirmed</label>
                <select class="form-control filters filter-confirmation text-capitalize mb-md-0 mb-2xx">
                    <option value=""> All </option>
                    <option value="1"> Yes </option>
                    <option value="0"> No </option>
                </select>
            </div>
        </div>
    </div>
    <!-- users filter end -->
    <!-- list section start -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="controlling-list-table table">
                <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Project</th>
                        <th>Expenses</th>
                        <th>Confirmed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- Modal to add new user starts-->
        <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
            <div class="modal-dialog">
                <form class="add-new-user modal-content pt-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                            <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" name="user-fullname" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-uname">Username</label>
                            <input type="text" id="basic-icon-default-uname" class="form-control dt-uname" placeholder="Web Developer" aria-label="jdoe1" aria-describedby="basic-icon-default-uname2" name="user-name" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" aria-describedby="basic-icon-default-email2" name="user-email" />
                            <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="user-role">User Role</label>
                            <select id="user-role" class="form-control">
                                <option value="subscriber">Subscriber</option>
                                <option value="editor">Editor</option>
                                <option value="maintainer">Maintainer</option>
                                <option value="author">Author</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label" for="user-plan">Select Plan</label>
                            <select id="user-plan" class="form-control">
                                <option value="basic">Basic</option>
                                <option value="enterprise">Enterprise</option>
                                <option value="company">Company</option>
                                <option value="team">Team</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-1 data-submit">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal to add new user Ends-->
    </div>
    <!-- list section end -->
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
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-controlling.js')}}"></script>
@endsection
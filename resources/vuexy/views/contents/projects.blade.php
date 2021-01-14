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
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="projects-list-table table">
                <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>Project</th>
                        <th>Client</th>
                        <td>Leader</td>
                        <th>Members</th>
                        <th>Progress</th>
                        <th>Hours</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- list section end -->
</section>
@endsection
@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="new-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('projects.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Project Info</h4>
                                <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="text" name="start_date" class="form-control flatpickr-date">
                                </div>
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input type="text" name="deadline" class="form-control flatpickr-date">
                                </div>
                                <div class="form-group">
                                    <label>Member</label>
                                    <select class="form-control select2" multiple name="members[]" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Leader</label>
                                    <select class="form-control select2" name="leader" required>
                                        <option value="" disabled selected>Select One</option>
                                      @foreach($users as $user)
                                          <option value="{{$user->id}}">{{$user->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title">Budget Info</h4>
                                <div class="form-group">
                                    <label>Estimated budget</label>
                                    <input type="number" name="budget" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Amount spent</label>
                                    <input type="number" name="spent" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select class="form-control select2bs4" name="currency" style="width: 100%;">
                                        <option value="usd">Dollars (USD)</option>
                                        <option value="gbp">Pounds (GBP)</option>
                                        <option value="eur">Euros (EUR)</option>
                                        <option value="inr">Rupee (INR)</option>
                                    </select>
                                </div>
                                <h4 class="card-title">Client Info</h4>
                                <div class="form-group">
                                    <label>Client Name/Company</label>
                                    <input type="text" name="company" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Project Status</label>
                                    <select name="status" class="form-control custom-select">
                                      <option selected="" disabled="">Select one</option>
                                      <option value="notstarted">Not Started</option>
                                      <option value="inprogress">In Progress</option>
                                      <option value="onhold">On Hold</option>
                                      <option value="canceled">Canceled</option>
                                      <option value="completed">Completed</option>
                                    </select>
                                </div>
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
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('projects.update')}}">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Project Info</h4>
                                <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="text" name="start_date" class="form-control flatpickr-date">
                                </div>
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input type="text" name="deadline" class="form-control flatpickr-date">
                                </div>
                                <div class="form-group">
                                    <label>Member</label>
                                    <select class="form-control select2 members_edit" multiple name="members[]" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Leader</label>
                                    <select class="form-control select2" name="leader" required>
                                        <option value="" disabled selected>Select One</option>
                                      @foreach($users as $user)
                                          <option value="{{$user->id}}">{{$user->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title">Budget Info</h4>
                                <div class="form-group">
                                    <label>Estimated budget</label>
                                    <input type="number" name="budget" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Amount spent</label>
                                    <input type="number" name="spent" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select class="form-control select2bs4" name="currency" style="width: 100%;">
                                        <option value="usd">Dollars (USD)</option>
                                        <option value="gbp">Pounds (GBP)</option>
                                        <option value="eur">Euros (EUR)</option>
                                        <option value="inr">Rupee (INR)</option>
                                    </select>
                                </div>
                                <h4 class="card-title">Client Info</h4>
                                <div class="form-group">
                                    <label>Client Name/Company</label>
                                    <input type="text" name="company" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Project Status</label>
                                    <select name="status" class="form-control custom-select">
                                      <option selected="" disabled="">Select one</option>
                                      <option value="notstarted">Not Started</option>
                                      <option value="inprogress">In Progress</option>
                                      <option value="onhold">On Hold</option>
                                      <option value="canceled">Canceled</option>
                                      <option value="completed">Completed</option>
                                    </select>
                                </div>
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
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection
@section('scripts')
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/forms/form-select2.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-projects.js')}}"></script>
@endsection

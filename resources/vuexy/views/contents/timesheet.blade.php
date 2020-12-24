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

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/app-permissions-list.css')}}">

@endsection

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection
@section('content')
<section class="timelog-list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="timelog-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Begin</th>
                        <th>End</th>
                        <th>Duration</th>
                        <th>Project</th>
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
    <div class="modal fade" id="new-timelog-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('timetracking.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                          <div class="form-group col-md-4">
                              <label>Start Date</label>
                              <input type="text" name="start_date" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" />
                          </div>
                          <div class="form-group col-md-4">
                            <label>End Time</label>
                            <input type="text" name="end_time" class="form-control flatpickr-time" placeholder="HH:MM" />
                          </div>
                          <div class="form-group col-md-2">
                            <label>Hours</label>
                            <input type="number" name="duration" class="form-control" step="0.01" />
                          </div>
                          <div class="form-group col-md-2">
                            <label>Break</label>
                            <input type="number" name="break" class="form-control" step="0.01" />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <label>Project</label>
                            <select name="project_id" class="select2 form-control">
                                @foreach($projects as $project)
                                  <option value="{{$project->id}}">{{$project->title}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <label>Tags</label>
                            <select name="tags[]" class="select2 form-control" multiple>
                                @foreach($tags as $tag)
                                  <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label>Expenses</label>
                            <select name="expenses_id" class="select2 form-control">
                                @foreach($expenses as $expense)
                                  <option value="{{$expense->id}}">{{$expense->title}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <label>Note</label>
                            <textarea name="note" cols="30" rows="5" class="form-control"></textarea>
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
    <div class="modal fade" id="edit-timelog-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="{{route('timetracking.update')}}">
                  @csrf
                  <input type="hidden" name="id">
                  <div class="modal-body">
                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Start Date</label>
                            <input type="text" name="start_date" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" />
                        </div>
                        <div class="form-group col-md-4">
                          <label>End Time</label>
                          <input type="text" name="end_time" class="form-control flatpickr-time" placeholder="HH:MM" />
                        </div>
                        <div class="form-group col-md-2">
                          <label>Hours</label>
                          <input type="number" name="duration" class="form-control" step="0.01" />
                        </div>
                        <div class="form-group col-md-2">
                          <label>Break</label>
                          <input type="number" name="break" class="form-control" step="0.01" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label>Project</label>
                          <select name="project_id" class="select2 form-control">
                              @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->title}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label>Tags</label>
                          <select name="tags[]" class="select2 tags-input form-control" multiple>
                              @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label>Expenses</label>
                          <select name="expenses_id" class="select2 form-control">
                              @foreach($expenses as $expense)
                                <option value="{{$expense->id}}">{{$expense->title}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label>Note</label>
                          <textarea name="note" cols="30" rows="5" class="form-control"></textarea>
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
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-timelog.js')}}"></script>
@endsection
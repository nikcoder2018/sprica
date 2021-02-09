@extends('layouts.main')

@section('vendors_css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('external_css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
<section class="app-news-list">
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="news-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Heading</th>
                        <th>Date</th>
                        <th class="cell-fit">Actions</th>
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
                        <h4 class="modal-title">Create News</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('notices.store') }}" class="form-add-ticket" method="POST"> 
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="heading">Heading <sup>*</sup></label>
                                        <input type="text" name="heading" class="form-control" required>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="details">Details</label>
                                        <textarea name="details" cols="30" rows="5" class="form-control"></textarea>
                                    </fieldset>
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
                        <h4 class="modal-title">Edit Ticket</h4>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('notices.update') }}" class="form-edit-ticket" method="POST"> 
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="heading">Heading <sup>*</sup></label>
                                        <input type="text" name="heading" class="form-control" required>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="details">Details</label>
                                        <textarea name="details" cols="30" rows="5" class="form-control"></textarea>
                                    </fieldset>
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
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-notices.js')}}"></script>
@endsection
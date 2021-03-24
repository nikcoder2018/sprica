@extends('layouts.main')

@section('vendors_css')
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('external_css')
    <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('header')
    <div class="content-header-left col-md-9 col-12 mb-2">
        @include('partials.breadcrumbs', ['title' => $title])
    </div>
@endsection
@section('content')
    <section class="timelog-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table class="timelog-list-table table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>id</th>
                                <th>Date</th>
                                <th>Duration</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Break</th>
                                <th>Project</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <div class="vertical-modal-ex">
        <div class="modal fade" id="new-timelog-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Time</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('timetracking.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Start Date</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control"
                                        placeholder="YYYY-MM-DD HH:MM" />
                                </div>
                                 @if (\App\GlobalSetting::get('timetracking-mode') === 'Mode 2')
                                    <div class="form-group col-md-3">
                                        <label>End Date</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control"
                                            placeholder="YYYY-MM-DD" />
                                    </div>
                                @elseif(\App\GlobalSetting::get('timetracking-mode') === 'Mode 3')
                                <div class="form-group col-md-3">
                                    <label>End Time</label>
                                    <input type="text" id="end_time" name="end_time" class="form-control"
                                        placeholder="HH:MM" disabled/>
                                </div>
                                @else 
                                    <div class="form-group col-md-3">
                                        <label>End Time</label>
                                        <input type="text" id="end_time" name="end_time" class="form-control"
                                            placeholder="HH:MM" />
                                    </div>
                                @endif
                                <div class="form-group col-md-3">
                                    <label>Duration</label>
                                    <input type="number" id="hours" name="duration" class="form-control" step="0.01" />
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Break</label>
                                    <input type="number" id="break" name="break" class="form-control" step="0.01" />
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Project</label>
                                    <select name="project_id" class="select2 form-control">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tags</label>
                                    <select name="tags[]" class="select2 form-control" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Expenses</label>
                                    <select name="expenses_id" class="select2 form-control">
                                        @foreach ($expenses as $expense)
                                            <option value="{{ $expense->id }}">{{ $expense->title }}</option>
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
        <div class="modal fade" id="edit-timelog-modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('timetracking.update') }}">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Start Date</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control"
                                        placeholder="YYYY-MM-DD HH:MM" />
                                </div>
                                @if (\App\GlobalSetting::get('timetracking-mode') === 'Mode 2')
                                    <div class="form-group col-md-3">
                                        <label>End Date</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control"
                                            placeholder="YYYY-MM-DD" />
                                    </div>
                                @elseif(\App\GlobalSetting::get('timetracking-mode') === 'Mode 3')
                                <div class="form-group col-md-3">
                                    <label>End Time</label>
                                    <input type="text" id="end_time" name="end_time" class="form-control"
                                        placeholder="HH:MM" disabled/>
                                </div>
                                @else 
                                    <div class="form-group col-md-3">
                                        <label>End Time</label>
                                        <input type="text" id="end_time" name="end_time" class="form-control"
                                            placeholder="HH:MM" />
                                    </div>
                                @endif
                                <div class="form-group col-md-3">
                                    <label>Duration</label>
                                    <input type="number" id="hours" name="duration" class="form-control" step="0.01" />
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Break</label>
                                    <input type="number" id="break" name="break" class="form-control" step="0.01" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Project</label>
                                    <select name="project_id" class="select2 form-control">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tags</label>
                                    <select name="tags[]" class="select2 tags-input form-control" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Expenses</label>
                                    <select name="expenses_id" class="select2 form-control">
                                        @foreach ($expenses as $expense)
                                            <option value="{{ $expense->id }}">{{ $expense->title }}</option>
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
@section('vendors_js')
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
@endsection

@section('scripts')
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <script>window.userDefaultStartTime = '{{ $default_start_time }}'.split(':').map((item) => Number(item));</script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/pages/app-timelog.js') }}"></script>
    <script defer>
        $(document).ready(() => {
            $('#end-date').flatpickr({
                enableTime: true,
                enableSeconds: true,
                disableMobile: true,
            });

            const hoursInput = $('input[name=duration]');

            hoursInput.on('change', () => {
                fetchHours();
            });

            window.fetchHours = () => {
                hoursInput.each(function() {
                    const hours = $(this)[0].value;
                    axios.get(`{{ route('times.search') }}?query=${hours}`, {
                        headers: {
                            Accept: 'application/json'
                        }
                    }).then(response => {
                        const times = response.data;
                        if (times.length > 0) {
                            const instance = times[0];
                            // ex '02:00 PM' - string needs to be split
                            // const time = instance.endtime.split(':').map((item, index, array) =>
                            //     index !== 1 ?
                            //     ((item) => {
                            //         // IIFE is used to check if 2nd element
                            //         // of array contains pm
                            //         // then we convert standard time
                            //         // to military time 
                            //         if (array[1].split(' ')[1] === 'PM') {
                            //             return Number(item) + 12;
                            //         }
                            //         // else we just return it as is
                            //         return Number(item);

                            //     })(item) :
                            //     Number(item.split(' ')[0]));
                            $(this).parents('form').find('input[name=break]').val(instance.break);
                            // const date = new Date(Date.now());
                            // date.setHours(time[0], time[1], 0);
                            // $('#end-time').flatpickr({
                            //     defaultDate: date,
                            //     enableTime: true,
                            //     enableSeconds: true,
                            //     disableMobile: true,
                            // });
                        }
                    });
                });
            }
        });

    </script>
@endsection

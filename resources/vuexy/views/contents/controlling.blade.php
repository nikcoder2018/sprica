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
                <select class="select2 hide-search form-control filters filter-confirmation text-capitalize mb-md-0 mb-2xx">
                    <option value="all"> All </option>
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
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Project</th>
                        <th>Expenses</th>
                        <th>Confirmed</th>
                        <th>Logged From</th>
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
                                <div class="form-group col-md-12">
                                    <label>Employee</label>
                                    <select class="select2 form-control text-capitalize mb-md-0 mb-2xx" name="employee">
                                        <option value=""> Select Employee </option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}"> {{$user->name}} ({{$user->totalConfirmedTimelog}}) </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                                <div class="col-md-6">
                                    <label>Project</label>
                                    <select name="project_id" class="select2 form-control">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Tasks</label>
                                    <select name="task_id" class="select2 form-control">
                                        @foreach ($tasks as $task)
                                            <option value="{{ $task->id }}">{{ $task->title }}</option>
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
<script>window.userDefaultStartTime = '{{ $default_start_time }}'.split(':').map((item) => Number(item));</script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-controlling.js')}}"></script>
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
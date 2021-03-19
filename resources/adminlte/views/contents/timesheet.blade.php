@extends('layouts.main')
@section('page_css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('stylesheets')
    
@endsection
@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-md-8">
            <h1>My times</h1>
        </div>
        <div class="col-md-4">
            <div class="breadcrumb float-right">
                <div class="box-tools">
                    <div class="btn-group">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-download"></i>
                                <span class="caret"></span>
                                <span class="sr-only">Show menu</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <div class="dropdown-item">CSV</div>
                                <div class="dropdown-item">Print</div>
                                <div class="dropdown-item">PDF</div>
                                <div class="dropdown-item">Excel</div>
                            </div>
                        </div>
                        <a class="btn btn-default btn-visibility" href="#" data-toggle="modal" data-target="#modal_timesheet">
                            <i class="far fa-eye"></i>
                        </a>
                        <a class="btn btn-default btn-create" href="#" data-toggle="modal" data-target="#new-timelog-modal">
                            <i class="far fa-plus-square"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="timelog-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="cell-fit"><input type="checkbox" id="multi_select_all" class="multiupdater"></th>
                                <th>Date</th>
                                <th>Duration</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Break</th>
                                <th>Project</th>
                                <th class="cell-fit">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modals')
<div class="modal fade" id="modal_timesheet">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change column visibility</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="timesheet_visibility">
                <div class="form-group">
                    <input type="checkbox" class="toggle-vis" data-column="1" id="column_date" checked>
                    <label class="control-label" for="column_date">Date</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="toggle-vis" data-column="2" id="column_duration" checked>
                    <label class="control-label" for="column_duration">Duration</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="toggle-vis" data-column="3" id="column_start" name="start" checked="checked">
                    <label class="control-label" for="column_start">Start</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="toggle-vis" data-column="4" id="column_end" name="end" checked="checked">
                    <label class="control-label" for="column_end">End</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="toggle-vis" data-column="5" id="column_break" name="break" checked="checked">
                    <label class="control-label" for="column_break">Break</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="toggle-vis" data-column="6" id="column_project" name="project" checked="checked">
                    <label class="control-label" for="column_project">Project</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="toggle-vis" data-column="7" id="column_action" name="action" checked="checked">
                    <label class="control-label" for="column_action">Actions</label>
                </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
@endsection
@section('page_js')
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
@endsection

@section('scripts')
<script>
    $(function(){
        "use strict";

    var dtTimelog = $("#timelog-table"),
        isRtl = $("html").attr("data-textdirection") === "rtl",
        API_URL = "/timesheet/logs",
        URL = "/timesheet",
        API_TOKEN = $("[name=api-token]").attr("content"),
        startDatePickr = $("input[name=start_date]"),
        startTimePickr = $("input[name=start_time]"),
        endDatePickr = $("input[name=end_date]"),
        endTimePickr = $("input[name=end_time]"),
        new_timelog_modal = "#new-timelog-modal",
        edit_timelog_modal = "#edit-timelog-modal",
        multi_select_all = $('#multi_select_all');
        

        if (dtTimelog.length) {
            var dt = dtTimelog.DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: false,
                autoWidth: true,
                ajax: {
                    url: API_URL,
                    type: "GET",
                    data: {
                        api_token: API_TOKEN,
                    },
                }, // JSON file to add data
                columns: [
                    // columns according to JSON
                    { data: "id" },
                    { data: "date" },
                    { data: "duration" },
                    { data: "start" },
                    { data: "end" },
                    { data: "break" },
                    { data: "project" },
                    { data: "" },
                ],
                columnDefs: [{
                        // For Responsive
                        targets: 0,
                        orderable: false,
                        render: function() {
                            return `<input type="checkbox" class="multi_select_single multiupdater">`;
                        },
                    },
                    {
                        targets: 2,
                        render: function(data, type, row) {
                            return `<span>${row.duration} Hours</span>`;
                        },
                    },
                    {
                        targets: 5,
                        render: function(data, type, row) {
                            if (row.break != null)
                                return `<span>${row.break} Hours</span>`;
                            else return "";
                        },
                    },
                    {
                        // Actions
                        targets: -1,
                        width: "80px",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return `
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="dropdown-item btn-edit" data-id="${row.id}">Edit</li>
                                        <li class="dropdown-item btn-delete" data-id="${row.id}">Delete</li>
                                    </ul>
                                </button>
                            `;
                        },
                    },
                ],
                order: [[1, 'desc']],
                initComplete: function() {
                    $(document).find('[data-toggle="tooltip"]').tooltip();
                    // Adding role filter once table initialized
                },
                drawCallback: function() {
                    $(document).find('[data-toggle="tooltip"]').tooltip();
                },
            });

            $('.toggle-vis').on( 'click', function () {
                // Get the column API object
                var column = dt.column( $(this).attr('data-column') );
        
                // Toggle the visibility
                column.visible( ! column.visible() );
            });

            $(document).on('click', '.dropdown-menu .dropdown-item', function(e){
                alert('1');
            });
            function deleteTimelog(id){
                //let id = $(this).data("id");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-outline-danger ml-1",
                    },
                    buttonsStyling: false,
                }).then(async function(result) {
                    if (result.isConfirmed) {
                        const deleteData = await $.get(`/timesheet/${id}/delete`);
                        if (deleteData.success) {
                            toastr["success"](deleteData.msg, "Deleted!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                            dt.ajax.reload();
                        }
                    }
                });
            }
        }

        multi_select_all.on('change', function(){
            if($(this).is(':checked')){
                $('.multi_select_single').prop('checked', true);
            }else{
                $('.multi_select_single').prop('checked', false);
            }
        });

       


    });
</script>
@endsection
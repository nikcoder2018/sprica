@extends('layouts.main')

@section('vendors_css')
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('leaves.store')}}" class="assign-form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="employeeId" class="mb-1">Choose Employee</label>
                                <select name="employee" id="employeeId" class="form-control select2">
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="leaveType" class="mb-1">Leave Type</label>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-leavetype-modal">Add Leave Type</button>
                                <select name="leave_type" id="leaveType" class="form-control">
                                    @foreach($leaveTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                            <div class="form-group">
                                <label for="status" class="mb-1">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="form-group">
                                <label for="duration">Select Duration</label>
                                <div class="demo-inline-spacing">
                                    <div class="custom-control custom-radio mt-1">
                                        <input type="radio" id="duration1" name="duration" class="custom-control-input" value="single" checked="">
                                        <label class="custom-control-label" for="duration1">Single</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-1">
                                        <input type="radio" id="duration2" name="duration" class="custom-control-input" value="multiple">
                                        <label class="custom-control-label" for="duration2">Multiple</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-1">
                                        <input type="radio" id="duration3" name="duration" class="custom-control-input" value="halfday">
                                        <label class="custom-control-label" for="duration3">Half Day</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="form-group basicDateInput">
                                <label for="selectDates" class="mb-1">Select Dates</label>
                                <input type="text" name="dates" id="selectDates" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                            </div>
                            <div class="form-group multiDateInput d-none">
                                <label for="selectMultiDates" class="mb-1">Select Dates</label>
                                <small class="text-muted">(You can select multiple dates.)</small>
                                <input type="text" name="dates" id="selectMultiDates" class="form-control flatpickr-multiple" placeholder="YYYY-MM-DD" disabled />
                            </div>
                        </div>
    
                        <div class="col-xl-12 col-md-12 col-12">
                            <div class="form-group">
                                <label for="reason">Reason for absence <span class="text-danger">*</span></label>
                                <textarea name="reason" id="reason" cols="30" rows="6" class="form-control" required></textarea>
                            </div>                    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"><i data-feather="check"></i> Save</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="add-leavetype-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Leave Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{route('leavetype.store')}}" class="leavetype-form" method="POST">
                                @csrf
                                <div class="form-group">
                                <label>Leave Type</label>
                                <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>No. of Leaves</label>
                                    <input type="number" name="number_of_leaves" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Leave Paid Status</label>
                                    <select name="paid_status" class="form-control">
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                            <form action="{{route('leavetype.update')}}" class="leavetype-edit-form d-none" method="POST">
                                @csrf
                                <input type="hidden" name="id">
                                <div class="form-group">
                                <label>Leave Type</label>
                                <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>No. of Leaves</label>
                                    <input type="number" name="number_of_leaves" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Leave Paid Status</label>
                                    <select name="paid_status" class="form-control">
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-success btn-open-new">Add New</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            @if($leaveTypes)
                            <div class="table-responsive">
                                <table class="table table-types">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Leave Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $c = 0; @endphp
                                        @foreach($leaveTypes as $type)
                                        <tr data-type-id="{{$type->id}}">
                                            <td>
                                                {{++$c}}
                                            </td>
                                            <td>{{$type->name}}</td>
                                            <td>
                                                <button class="btn btn-primary btn-edit-type btn-sm" data-id="{{$type->id}}"><i data-feather="edit"></i></button>
                                                <button class="btn btn-danger btn-delete-type btn-sm" data-id="{{$type->id}}"><i data-feather="trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else 
                            <p class="text-center">No results</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection

@section('vendors_js')
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('scripts')
    <script>
        $(function(){
            'use strict';

            var 
                form = $('.assign-form'),
                leaveTypeForm = $('.leavetype-form'),
                leaveTypeEditForm = $('.leavetype-edit-form'),
                basicPickr = $('.flatpickr-basic'),
                multiPickr = $('.flatpickr-multiple'),
                basicDateInput = $('.basicDateInput'),
                multiDateInput = $('.multiDateInput');

            // Default
            if (basicPickr.length) {
                basicPickr.flatpickr();
            }

            // Multiple Dates
            if (multiPickr.length) {
                multiPickr.flatpickr({
                weekNumbers: true,
                mode: 'multiple',
                minDate: 'today'
                });
            }

            $('input[name=duration]').on('change', function(){
                var val = $(this).val();

                switch(val){
                    case 'single': 
                        multiDateInput.addClass('d-none');
                        multiDateInput.find('input[name=dates]').prop('disabled', true);
                        basicDateInput.removeClass('d-none');
                        basicDateInput.find('input[name=dates]').prop('disabled', false);
                    break;
                    case 'multiple':
                        basicDateInput.addClass('d-none');
                        basicDateInput.find('input[name=dates]').prop('disabled', true); 
                        multiDateInput.removeClass('d-none');
                        multiDateInput.find('input[name=dates]').prop('disabled', false); 
                    break;
                    case 'halfday':
                        multiDateInput.addClass('d-none');
                        multiDateInput.find('input[name=dates]').prop('disabled', true);
                        basicDateInput.removeClass('d-none');
                        basicDateInput.find('input[name=dates]').prop('disabled', false);
                    break;
                }
            });

            form.on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp){
                        if(resp.success){
                            Swal.fire({
                                title: 'Success!',
                                text: resp.msg,
                                icon: 'success'
                            }).then(()=>{
                                window.location.href = "{{route('leaves.index')}}";
                            })
                        }else{
                            //show errors
                        }
                    }
                });
            });

            leaveTypeForm.on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(resp){
                        if(resp.success){
                            var table = $('.table-types');
                            var rowCount = $('.table-types tr').length;
                            table.find('tbody').append(`
                                <tr data-type-id="${resp.type.id}">
                                    <td>
                                        ${rowCount++}
                                    </td>
                                    <td>${resp.type.name}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" data-id="${resp.type.id}">Delete</button></div>
                                    </td>
                                </tr>
                            `);
                        }else{
                            //show errors
                        }
                    }
                });
            });

            $('.table-types').on('click', '.btn-delete-type', function(){
                var id = $(this).data('id');
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
                        const deleteData = await $.get(`/leavetype/${id}/destroy`);
                        if (deleteData.success) {
                            toastr["success"](deleteData.msg, "Deleted!", {
                                closeButton: true,
                                tapToDismiss: false
                            });
                            $('.table-types').find('tr[data-type-id='+id+']').fadeOut();
                        }
                    }
                });
            });

            $('.table-types').on('click', '.btn-edit-type', async function(){
                var id = $(this).data('id');
                
                const type = await $.get('/leavetype/'+id+'/edit');

                leaveTypeEditForm.find('input[name=id]').val(type.id);
                leaveTypeEditForm.find('input[name=name]').val(type.name);
                leaveTypeEditForm.find('input[name=number_of_leaves]').val(type.number_of_leaves);
                leaveTypeEditForm.find('select[name=paid_status]').val(type.paid_status).change();

                leaveTypeForm.addClass('d-none');
                leaveTypeEditForm.removeClass('d-none');

            });

            $('.btn-open-new').on('click', function(){
                leaveTypeEditForm.addClass('d-none');
                leaveTypeForm.removeClass('d-none');
            });
        });
    </script>
@endsection
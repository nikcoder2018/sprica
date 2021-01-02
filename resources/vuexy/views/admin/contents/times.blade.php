@extends('layouts.admin.main')


@section('stylesheets')
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <style>
        .dataTables_paginate {
            margin-top: 1.5rem !important;
        }

        .paginate_button {
            padding: 4px 14px !important;
            margin: 8px 4px !important;
            background-color: #7367F0 !important;
            border-radius: 8px !important;
            color: white;
        }

        .paginate_button: hover {
            color: white !important;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex w-100">
                            <h3 class="card-title align-self-center">Times</h3>
                            <div class="align-self-center ml-auto">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#addTimeModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <div class="modal fade" id="addTimeModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addTimeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addTimeModalLabel">Add Time</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="add-time-form" action="{{ route('times.store') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="hours">Hour/s</label>
                                                        <input type="text" name="hours" id="hours" placeholder="Hours"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="endtime">Endtime</label>
                                                        <input type="text" name="endtime" id="endtime" placeholder="Endtime"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="break">Break</label>
                                                        <input type="text" name="break" id="break" placeholder="Break"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Hour/s</th>
                                    <th class="text-center">Endtime</th>
                                    <th class="text-center">Break</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($times as $time)
                                    <tr data-id="{{ $time->id }}">
                                        <td class="text-center">{{ $time->id }}</td>
                                        <td class="text-center">{{ $time->hours }}</td>
                                        <td class="text-center">{{ $time->endtime }}</td>
                                        <td class="text-center">{{ $time->break }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm mx-1" data-toggle="modal"
                                                data-target="#editTimeModal{{ $time->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <div class="modal fade" id="editTimeModal{{ $time->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editTimeModalLabel{{ $time->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editTimeModalLabel{{ $time->id }}">
                                                                Edit Time</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="edit-time-form"
                                                            action="{{ route('times.update', ['time' => $time->id]) }}"
                                                            data-id="{{ $time->id }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="hours-{{ $time->id }}">Hour/s</label>
                                                                    <input type="text" name="hours"
                                                                        id="hours-{{ $time->id }}" placeholder="Hours"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $time->hours }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="endtime-{{ $time->id }}">Endtime</label>
                                                                    <input type="text" name="endtime"
                                                                        id="endtime-{{ $time->id }}" placeholder="Endtime"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $time->endtime }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="break-{{ $time->id }}">Break</label>
                                                                    <input type="text" name="break"
                                                                        id="break-{{ $time->id }}" placeholder="Break"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $time->break }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Save</button>
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm mx-1" data-toggle="modal"
                                                data-target="#deleteTimeModal{{ $time->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <div class="modal fade" id="deleteTimeModal{{ $time->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteTimeModalLabel{{ $time->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteTimeModalLabel{{ $time->id }}">
                                                                Delete Time</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="delete-time-form"
                                                            action="{{ route('times.destroy', ['time' => $time->id]) }}"
                                                            data-id="{{ $time->id }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this time?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Confirm</button>
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(() => {
            $('.table').DataTable();

            $('#add-time-form').submit(function(e) {
                e.preventDefault();

                const url = $(this).attr('action');
                const data = $(this).serialize();
                axios.post(url, data).then(() => {
                    $('#addTimeModal').on('hidden.bs.modal', () => {
                        toastr.success('Time added successfully.');
                        window.location.reload();
                    });
                    $('#addTimeModal').modal('hide');
                });
            });

            $('.edit-time-form').submit(function(e) {
                e.preventDefault();
                const form = $(this);
                const id = form.attr('data-id');
                const modal = $(`#editTimeModal${id}`);
                const url = form.attr('action');
                const data = form.serialize();

                axios.post(url, data).then(() => {
                    modal.on('hidden.bs.modal', () => {
                        toastr.success('Time updated successfully.');
                        window.location.reload();
                    });
                    modal.modal('hide');
                });
            });

            $('.delete-time-form').submit(function(e) {
                e.preventDefault();
                const form = $(this);
                const id = form.attr('data-id');
                const modal = $(`#deleteTimeModal${id}`);
                const url = form.attr('action');
                modal.on('hidden.bs.modal', () => {
                    axios.post(url).then(() => {
                        toastr.success('Time deleted successfully.');
                        window.location.reload();
                    });
                });
                modal.modal('hide');

            });
        });

    </script>
@endsection

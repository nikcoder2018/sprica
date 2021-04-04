$(function() {
    'use strict';

    var dtTable = $('.projects-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/projects/all',
        URL = '/projects',
        datePickr = $('.flatpickr-date'),
        new_modal = $('#new-modal'),
        edit_modal = $('#edit-modal');

    // datatable
    if (dtTable.length) {
        var dt = dtTable.DataTable({
            processing: true,
            serverSide: true,
            ajax: API_URL, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: "responsive_id" },
                { data: 'id' },
                { data: 'title' },
                { data: 'client' },
                { data: 'leader' },
                { data: 'members' },
                { data: 'progress' },
                { data: 'hours' },
                { data: 'status' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    targets: 1,
                    visible: false
                },
                {
                    targets: 2,
                    responsivePriority: 2,
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        var avatarGroup = '';
                        var avatar = '/vuexy/app-assets/images/avatars/noface.png';
                        if (row.leader != null) {
                            if (row.leader.avatar != '') {
                                // For Avatar image
                                var $output = `<img src="${row.leader.avatar}" alt="Avatar" width="32" height="32">`;
                            } else {
                                // For Avatar badge
                                var stateNum = row.leader.status;
                                var states = ['danger', 'success', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                var $state = states[stateNum],
                                    $name = row.leader.name,
                                    $initials = $name.match(/\b\w/g) || [];
                                $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                                $output = '<span class="avatar-content">' + $initials + '</span>';
                            }

                            var colorClass = row.leader.avatar === '' ? ' bg-light-' + $state + ' ' : '';
                            // Creates full output for row
                            var $row_output =
                                `<div class="d-flex justify-content-left align-items-center">
                                    <div class="avatar ${colorClass} mr-1" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" data-original-title="${row.leader.name}">
                                        ${$output}
                                    </div>
                                    <span class="emp_name text-truncate font-weight-bold">
                                        ${$name}
                                    </span>
                                </div>`;
                            return $row_output;

                        } else {
                            return '';
                        }
                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row) {
                        var avatarGroup = '';
                        $.each(row.members, function(index, member) {
                            if (member.avatar != '') {
                                // For Avatar image
                                var $output = `<img src="${member.avatar}" alt="Avatar" width="32" height="32">`;
                            } else {
                                // For Avatar badge
                                var stateNum = member.status;
                                var states = ['danger', 'success', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                var $state = states[stateNum],
                                    $name = member.name,
                                    $initials = $name.match(/\b\w/g) || [];
                                $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                                $output = '<span class="avatar-content">' + $initials + '</span>';
                            }

                            var colorClass = member.avatar === '' ? ' bg-light-' + $state + ' ' : '';

                            avatarGroup += `
                            <div class="avatar ${colorClass}" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" data-original-title="${member.name}">
                                ${$output}
                            </div>
                            `;
                        });
                        return `
                        <div class="d-flex justify-content-start align-items-center">
                            ${avatarGroup}
                        </div>
                        `;
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        return `
                        <div class="progress-wrapper">
                            <div id="example-caption-2">${row.progress}%</div>
                            <div class="progress progress-bar-primary">
                                <div class="progress-bar" role="progressbar" aria-valuenow="${row.progress}" aria-valuemin="${row.progress}" aria-valuemax="100" style="width: 25%" aria-describedby="example-caption-2"></div>
                            </div>
                        </div>
                        `;
                    }
                },
                {
                    targets: 7,
                    render: function(data, type, row) {
                        return `<span>${row.hours} Hours</span>`;
                    }
                },
                {
                    targets: 8,
                    render: function(data, type, row) {
                        switch (row.status) {
                            case 'notstarted':
                                return `<span class="badge badge-secondary badge-light-secondary mr-1">Not Started</span>`;
                                break;
                            case 'inprogress':
                                return `<span class="badge badge-info badge-light-info mr-1">In Progress</span>`;
                                break;
                            case 'onhold':
                                return `<span class="badge badge-warning badge-warning-info mr-1">On Hold</span>`;
                                break;
                            case 'canceled':
                                return `<span class="badge badge-danger badge-light-danger mr-1">Canceled</span>`;
                                break;
                            case 'completed':
                                return `<span class="badge badge-success badge-light-success mr-1">Completed</span>`;
                                break;
                        }
                    }
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return (
                            `<div class="d-flex align-items-center col-actions">
                                <a class="mr-1 btn-details" href="/projects/${full.id}/details" data-toggle="tooltip" data-placement="top" title="Details">${feather.icons['eye'].toSvg({ class: 'font-medium-2' })}</a>
                                <a class="mr-1 btn-edit" href="javascript:void(0);" data-id="${full.id}" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit-2'].toSvg({ class: 'font-medium-2' })}</a>
                                <a class="mr-1 btn-delete" href="javascript:void(0);" data-toggle="tooltip" data-id="${full.id}" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>
                            </div>
                            `
                        );
                    }
                }
            ],
            order: [
                [2, 'desc']
            ],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'Create Project',
                className: 'btn btn-primary btn-add-record ml-2',
                action: function(e, dt, button, config) {
                    $(new_modal).modal('show');
                }
            }],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data.project;
                        }
                    }),
                    type: 'column',
                    renderer: function(api, rowIdx, columns) {
                        console.log(columns);
                        var data = $.map(columns, function(col, i) {
                            if (col.columnIndex != 1 && col.columnIndex != 2)
                                return col.project !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ?
                                    '<tr data-dt-row="' +
                                    col.rowIndex +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>' :
                                    '';
                        }).join('');

                        return data ? $('<table class="table"/>').append(data) : false;
                    }
                }
            },
            initComplete: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
                // Adding role filter once table initialized
            },
            drawCallback: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

    $(new_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(new_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dt.ajax.reload();
                }
            }
        });
    });

    $(dtTable).on('click', '.btn-edit', async function() {
        let id = $(this).data().id;
        let form = $(edit_modal).find('form');
        let members = [];
        $(edit_modal).modal('show');

        const project = await $.get(`${URL}/${id}/edit`);

        $.each(project.members, function(index, member) {
            members.push(member.id);
        });
        form.find('input[name=id]').val(project.id);
        form.find('input[name=name]').val(project.title);
        form.find('textarea[name=description]').val(project.description);
        form.find('input[name=start_date]').val(project.start_date);
        form.find('input[name=deadline]').val(project.deadline);
        form.find('input[name=budget]').val(project.budget);
        form.find('input[name=spent]').val(project.spent);
        form.find('select[name=leader]').val(project.leader_id);
        //form.find('select[name=currency]').val(project.currency);
        form.find('select[name=status]').val(project.status);
        form.find('.members_edit').val(members);
        form.find('.members_edit').trigger('change');
    });
    $(edit_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(edit_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dt.ajax.reload();
                }
            }
        });
    });

    $(dtTable).on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false
        }).then(async function(result) {
            if (result.isConfirmed) {
                const deleteData = await $.ajax({ url: `${URL}/${id}`, type: 'DELETE', data: { _token: $('meta[name=csrf-token]').attr('content') } });
                if (deleteData.success) {
                    toastr['success'](deleteData.msg, 'Deleted!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dt.ajax.reload();
                }
            }
        });
    });

    // Date & TIme
    if (datePickr.length) {
        datePickr.flatpickr({
            enableTime: false
        });
    }
});
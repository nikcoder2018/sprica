$(function() {
    'use strict';

    var dtTaskTable = $('.task-list-table'),
        dtTimelogTable = $('.timelog-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        project_id = dtTaskTable.data('id'),
        API_URL = '/api/projects/' + project_id + '/details',
        URL = '/projects',
        datePickr = $('.flatpickr-date'),
        add_task_modal = $('#add_task_modal'),
        edit_task_modal = $('#edit_task_modal');

    // datatable
    if (dtTaskTable.length) {
        var dtTask = dtTaskTable.DataTable({
            ajax: {
                url: API_URL,
                type: "POST",
                data: {
                    category: 'tasks'
                }
            }, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'title' },
                { data: 'assigned' },
                { data: 'due_date' },
                { data: 'status' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    targets: 2,
                    render: function(data, type, row) {
                        var avatarGroup = '';
                        $.each(row.assigned, function(index, member) {
                            //default avatar if user avatar is not set
                            var avatar = '/vuexy/app-assets/images/avatars/noface.png';
                            if (member.avatar != '') {
                                avatar = member.avatar;
                            }
                            avatarGroup += `
                            <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="${member.name}">
                                <img src="${avatar}" alt="Avatar" height="26" width="26">
                            </div>
                            `;
                        });
                        return `
                        <div class="avatar-group">
                            ${avatarGroup}
                        </div>
                        `;
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        switch (row.status) {
                            case 'incomplete':
                                return `<span class="badge badge-info badge-light-info mr-1">Incomplete</span>`;
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
                                <a class="mr-1 btn-edit" href="javascript:void(0);" data-toggle="tooltip" data-id="${full.id}" data-placement="top" title="Edit">${feather.icons['edit-2'].toSvg({ class: 'font-medium-2' })}</a>
                                <a class="mr-1 btn-delete" href="javascript:void(0);" data-toggle="tooltip" data-id="${full.id}" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>
                            </div>
                            `
                        );
                    }
                }
            ],
            order: [
                [1, 'desc']
            ],
            dom: '<"row d-flex justify-content-between align-items-center m-1"' +
                '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
                '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search Tasks',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'Add Tasks',
                className: 'btn btn-primary btn-add-record ml-2',
                action: function(e, dt, button, config) {
                    $(add_task_modal).modal('show');
                }
            }],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data.title;
                        }
                    }),
                    type: 'column',
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table',
                        columnDefs: [{
                            targets: 1,
                            visible: false
                        }, {
                            targets: 2,
                            visible: false
                        }]
                    })
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
    if (dtTimelogTable.length) {
        var dtTimelog = dtTimelogTable.DataTable({
            ajax: {
                url: API_URL,
                type: "POST",
                data: {
                    category: 'timelogs'
                }
            }, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'user' },
                { data: 'start_date' },
                { data: 'end_date' },
                { data: 'duration' },
                { data: 'break' },
            ],
            columnDefs: [{
                // For Responsive
                className: 'control',
                responsivePriority: 2,
                targets: 0
            }, {
                targets: 1,
                render: function(data, type, row) {
                    return row.user.name;
                }
            }],
            order: [
                [1, 'desc']
            ],
            dom: '<"row d-flex justify-content-between align-items-center m-1"' +
                '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
                '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search Logs',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data.user.name;
                        }
                    }),
                    type: 'column',
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table',
                        columnDefs: [{
                            targets: 1,
                            visible: false
                        }, {
                            targets: 2,
                            visible: false
                        }]
                    })
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

    dtTask.on('click', '.btn-edit', async function() {
        edit_task_modal.modal('show');
        var task = await $.ajax({
            url: '/task/edit',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $(this).data('id'),
            }
        });

        let form = edit_task_modal.find('form');
        form.find('input[name=task_id]').val(task.id);
        form.find('input[name=title]').val(task.title);
        form.find('textarea[name=description]').val(task.description);
        form.find('input[name=start_date]').val(task.start_date);
        form.find('input[name=due_date]').val(task.due_date);
        form.find('select[name=status]').val(task.status);
        form.find('select[name=priority]').val(task.priority);

        let assignMembers = new Array();
        $.each(task.assigned, function(index, member) {
            assignMembers.push(member.id);
        });
        form.find('select[name="assign_to[]"]').select2().val(assignMembers).trigger('change');
    });
    dtTask.on('click', '.btn-delete', function() {
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
                const deleteData = await $.get(`/task/${id}/destroy`);
                if (deleteData.success) {
                    toastr['success'](deleteData.msg, 'Deleted!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dtTask.ajax.reload();
                }
            }
        });
    });
    add_task_modal.on('submit', 'form', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    toastr['success'](resp.msg, null, {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    add_task_modal.modal('hide');
                    dtTask.ajax.reload();
                }
            }
        })
    });

    edit_task_modal.on('submit', 'form', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    toastr['success'](resp.msg, null, {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    edit_task_modal.modal('hide');
                    dtTask.ajax.reload();
                }
            }
        })
    });

});
$(function() {
    'use strict';

    var dtTable = $('.tasks-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/tasks/all',
        URL = '/tasks',
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
                { data: 'id' },
                { data: 'title' },
                { data: 'project' },
                { data: 'assigned' },
                { data: 'due' },
                { data: 'status' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0,
                    render: function() {
                        return '';
                    }
                },
                {
                    targets: 3,
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
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return (
                            `<div class="d-flex align-items-center col-actions">
                              <a class="mr-1 btn-edit" href="javascript:void(0);" data-id="${full.id}" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit-2'].toSvg({ class: 'font-medium-2' })}</a>
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
                ">t" +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
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
                text: 'Create Task',
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
        let form = edit_modal.find('form');
        $(form)[0].reset();
        edit_modal.modal('show');

        var task = await $.ajax({
            url: '/task/edit',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $(this).data('id'),
            }
        });

        form.find('input[name=task_id]').val(task.id);
        form.find('input[name=title]').val(task.title);
        form.find('textarea[name=description]').val(task.description);
        form.find('input[name=start_date]').val(task.start_date);
        form.find('input[name=due_date]').val(task.due_date);
        form.find('select[name=status]').val(task.status);
        form.find('select[name=priority]').val(task.priority);
        form.find('select[name=project_id]').val(task.project_id);

        let assignMembers = new Array();
        $.each(task.assigned, function(index, member) {
            assignMembers.push(member.id);
        });
        form.find('select[name="assign_to[]"]').select2().val(assignMembers).trigger('change');
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
                const deleteData = await $.ajax({ url: `/task/${id}/destroy`, type: 'GET', data: { _token: $('meta[name=csrf-token]').attr('content') } });
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
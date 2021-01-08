$(function() {
    'use strict';

    var dtTable = $('.projects-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/projects/all',
        URL = '/projects',
        new_modal = $('#new-modal'),
        edit_modal = $('#edit-modal');

    // datatable
    if (dtTable.length) {
        var dt = dtTable.DataTable({
            ajax: API_URL, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'title' },
                { data: 'client' },
                { data: 'members' },
                { data: 'progress' },
                { data: 'hours' },
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
                    targets: 3,
                    render: function(data, type, row) {
                        var avatarGroup = '';
                        $.each(row.members, function(index, member) {
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
                    targets: 5,
                    render: function(data, type, row) {
                        return `<span>${row.hours} Hours</span>`;
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        switch (row.status) {
                            case 'on_process':
                                return `<span class="badge badge-primary badge-light-primary mr-1">On Proccess</span>`;
                                break;
                            case 'on_progress':
                                return `<span class="badge badge-info badge-light-info mr-1">On Progress</span>`;
                                break;
                            case 'on_hold':
                                return `<span class="badge badge-warning badge-warning-info mr-1">On Hold</span>`;
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
                '>t' +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search Projects',
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
        let id = $(this).data().id;
        let form = $(edit_modal).find('form');
        $(edit_modal).modal('show');

        const project = await $.get(`${URL}/${id}/edit`);

        form.find('input[name=id]').val(project.id);
        form.find('input[name=title]').val(project.title);
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
                const deleteData = await $.get(`${URL}/${id}/delete`);
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

});
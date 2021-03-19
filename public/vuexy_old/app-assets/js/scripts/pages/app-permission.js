/*=========================================================================================
    File Name: app-invoice-list.js
    Description: app-invoice-list Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function() {
    'use strict';

    var dtPermissionTable = $('.permissions-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/permissions/all',
        URL = '/permissions',
        new_permission_modal = '#new-permission-modal', //new-permission-modal
        edit_permission_modal = '#edit-permission-modal';

    // datatable
    if (dtPermissionTable.length) {
        var dtPermission = dtPermissionTable.DataTable({
            ajax: API_URL, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'title' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    targets: 1,
                    render: function(data, type, row) {
                        return `<span>${row.title}</span>`;
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
                searchPlaceholder: 'Search Permission',
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

    $(new_permission_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(new_permission_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dtPermission.ajax.reload();
                }
            }
        });
    });

    $(dtPermissionTable).on('click', '.btn-edit', async function() {
        let id = $(this).data().id;
        let form = $(edit_permission_modal).find('form');
        $(edit_permission_modal).modal('show');

        const permission = await $.get(`${URL}/${id}/edit`);

        form.find('input[name=id]').val(permission.id);
        form.find('input[name=title]').val(permission.title);
    });

    $(edit_permission_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(edit_permission_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dtPermission.ajax.reload();
                }
            }
        });
    });

    $(dtPermissionTable).on('click', '.btn-delete', function() {
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
                    dtPermission.ajax.reload();
                }
            }
        });
    });

});
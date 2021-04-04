/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function() {
    'use strict';

    var dtTable = $('.employees-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/employees',
        URL = '/employees',
        API_TOKEN = $('[name=api-token]').attr('content'),
        new_user_modal = "#new-users-modal",
        filters = $('.filters'),
        datePickr = $('.flatpickr-date');

    var dt = dtTable.DataTable({
        ajax: {
            url: API_URL,
            data: function(data) {
                data.role = $('.filter-role').val();
                data.status = $('.filter-status').val();
            }
        }, // JSON file to add data
        columns: [
            // columns according to JSON
            { data: 'id' },
            { data: 'name' },
            { data: 'username' },
            { data: 'email' },
            { data: 'roles' },
            { data: 'status' },
            { data: '' }
        ],
        columnDefs: [{
                // For Responsive
                className: 'control',
                orderable: false,
                responsivePriority: 2,
                targets: 0,
                render: function() {
                    return '';
                }
            },
            {
                targets: 4,
                render: function(data, type, row) {
                    var $elArray = [];
                    $.each(row.roles, function(index, role) {
                        $elArray.push(`<span class="badge badge-info">${role}</span>`);
                    });

                    return $elArray.join();
                }
            },
            {
                targets: 5,
                render: function(data, type, row) {
                    if (row.status == 'active')
                        return `<span class="badge badge-success">Active</span>`;
                    else
                        return `<span class="badge badge-danger">Inactive</span>`;
                }
            },
            {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return (
                        `
                        <div class="btn-group">
                            <a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">${feather.icons['more-vertical'].toSvg({ class: 'font-small-4' })}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="/employees/details/${full.id}" class="dropdown-item">${feather.icons['user'].toSvg({ class: 'font-small-4 mr-50' })} Details</a>
                                <a href="javascript:;" class="dropdown-item delete-record">${feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' })} Delete</a>
                            </div>
                        </div>
                        `
                    );
                }
            }
        ],
        order: [
            [2, 'desc']
        ],
        dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            '<"col-lg-12 col-xl-6" l>' +
            '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            '>t' +
            '<"d-flex justify-content-between mx-2 row mb-1"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        language: {
            sLengthMenu: 'Show _MENU_',
            search: 'Search',
            searchPlaceholder: 'Search..'
        },
        // Buttons with Dropdown
        buttons: [{
            text: "Add Employee",
            className: "btn btn-primary btn-add-record ml-2",
            action: function(e, dt, button, config) {
                $(new_user_modal).modal("show");
            },
        }],
        // For responsive popup
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data();
                        return 'Details of ' + data['full_name'];
                    }
                }),
                type: 'column',
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table',
                    columnDefs: [{
                            targets: 2,
                            visible: false
                        },
                        {
                            targets: 3,
                            visible: false
                        }
                    ]
                })
            }
        },
        language: {
            paginate: {
                // remove previous & next text from pagination
                previous: '&nbsp;',
                next: '&nbsp;'
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


    filters.on('change', function() {
        dt.ajax.reload();
    });

    $(new_user_modal).on("submit", "form", function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(new_user_modal).modal("hide");
                    $(form)[0].reset();

                    toastr["success"](resp.msg, "Success!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });

                    dt.ajax.reload();
                }
            },
        });
    });

    $(document).on("click", ".delete-record", function() {
        let id = $(this).data("id");
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
                const deleteData = await $.get(`${URL}/${id}/delete`);
                if (deleteData.success) {
                    toastr["success"](deleteData.msg, "Deleted!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                    dtUser.ajax.reload();
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
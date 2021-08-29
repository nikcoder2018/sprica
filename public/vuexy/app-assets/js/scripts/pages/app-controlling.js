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

    var dtControllingTable = $('.controlling-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/controlling/data',
        URL = '/controlling',
        API_TOKEN = $('[name=api-token]').attr('content'),
        filters = $('.filters'),
        datePickr = $('.flatpickr-date');

    var dtControlling = dtControllingTable.DataTable({
        ajax: {
            url: API_URL,
            data: function(data) {
                data.user_id = $('.filter-employee').val();
                data.date_from = $('.filter-date-from').val();
                data.date_to = $('.filter-date-to').val();
                data.confirmation = $('.filter-confirmation').val();
            }
        }, // JSON file to add data
        columns: [
            // columns according to JSON
            { data: 'id' },
            { data: 'user' },
            { data: 'date' },
            { data: 'duration' },
            { data: 'project' },
            { data: 'expenses' },
            { data: 'confirmation' },
            { data: 'logged_from' },
            { data: '' }
        ],
        columnDefs: [{
                // For Responsive
                className: 'control',
                orderable: false,
                responsivePriority: 2,
                targets: 0
            },
            {
                targets: 6,
                render: function(data, type, row) {
                    if (row.confirmation == 1)
                        return `<span>Yes</span>`;
                    else
                        return `<span>No</span>`;
                }
            },
            {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return (
                        '<div class="btn-group">' +
                        '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                        feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                        '</a>' +
                        '<div class="dropdown-menu dropdown-menu-right">' +
                        '<a href="javascript:;" class="dropdown-item delete-record">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                        'Delete</a></div>' +
                        '</div>' +
                        '</div>'
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
        buttons: [],
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
        dtControlling.ajax.reload();
    });

    // Date & TIme
    if (datePickr.length) {
        datePickr.flatpickr({
            enableTime: false
        });
    }

});
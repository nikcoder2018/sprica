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

    var dtPayrollTable = $('.payroll-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/payroll-total/data',
        URL = '/payroll-total',
        API_TOKEN = $('[name=api-token]').attr('content'),
        filters = $('.filters'),
        datePickr = $('.flatpickr-date'),
        profile_name = $('#profile-name'),
        profile_number = $('#profile-number'),
        profile_department = $('#profile-department'),
        profile_hourfee = $('#profile-hourfee'),
        profile_tax = $('#profile-tax'),
        profile_dateregistered = $('#profile-dateregistered'),
        vacation_dayoff = $('#vacation-dayoff'),
        vacation_currentmonth = $('#vacation-currentmonth'),
        vacation_remainingdayoff = $('#vacation-remainingdayoff'),
        illness_currentmonth = $('#illness-currentmonth'),
        illness_currentyear = $('#illness-currentyear'),
        paidhours_currentmonth = $('#paidhours-currentmonth'),
        paidhours_paidout = $('#paidhours-paidout'),
        paidhours_totalhours = $('#paidhours-totalhours'),
        kug_currentmonth = $('#kug-currentmonth');

    var dtPayroll = dtPayrollTable.DataTable({
        ajax: {
            url: API_URL,
            data: function(data) {
                data.user_id = $('.filter-employee').val();
                data.year = $('.filter-year').val();
                data.month = $('.filter-month').val();
            }
        }, // JSON file to add data
        columns: [
            // columns according to JSON
            { data: 'id' },
            { data: 'name' },
            { data: 'number' },
            { data: 'tax_status' },
            { data: 'hour_fee' },
            { data: 'date_registered' },
            { data: 'total_hours' },
            { data: 'holiday' },
            { data: 'illness' },
            { data: 'vacation' },
            { data: 'kug' },
            { data: 'working_hours' },
            { data: 'overtime' },
            { data: 'night_work' },
            { data: 'sunday' },
            { data: 'expenses' },
            { data: 'release' },
            { data: 'advance' },
            { data: 'travel' },
            { data: 'completed' }
        ],
        columnDefs: [{
                // For Responsive
                className: 'control',
                orderable: false,
                responsivePriority: 2,
                targets: 0
            },
            {
                targets: 1,
                width: "200px"
            },
            {
                targets: 8,
                render: function(data, type, row) {
                    if (row.confirmation == 1)
                        return `<span>Yes</span>`;
                    else
                        return `<span>No</span>`;
                }
            },
        ],
        ordering: false,
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
        dtPayroll.ajax.reload();
        $('.payroll-data').removeClass('d-none');

        $.ajax({
            url: '/payroll/profile',
            type: 'GET',
            data: {
                user_id: $('.filter-employee').val(),
                year: $('.filter-year').val(),
                month: $('.filter-month').val(),
            },
            success: function(data) {
                profile_name.text(data.profile.name);
                profile_number.text(data.profile.number);
                profile_department.text(data.profile.department);
                profile_hourfee.text(data.profile.hour_fee);
                profile_tax.text(data.profile.tax_status);
                profile_dateregistered.text(data.profile.dateRegistered);
                vacation_dayoff.text(data.vacation.day_off);
                vacation_currentmonth.text(data.vacation.current_month);
                vacation_remainingdayoff.text(data.vacation.remaining);
                illness_currentmonth.text(data.illness.current_month);
                illness_currentyear.text(data.illness.curreny_year);
                paidhours_currentmonth.text(data.paidhours.current_month);
                paidhours_paidout.text(data.paidhours.paid_out);
                paidhours_totalhours.text(data.paidhours.total_hours);
                kug_currentmonth.text(data.kug.current_month);
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
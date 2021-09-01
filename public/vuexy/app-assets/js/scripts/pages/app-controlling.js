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
        datePickr = $('.flatpickr-date'),
        startDatePickr = $("input[name=start_date]"),
        startTimePickr = $("input[name=start_time]"),
        endDatePickr = $("input[name=end_date]"),
        endTimePickr = $("input[name=end_time]"),
        new_timelog_modal = "#new-timelog-modal",
        edit_timelog_modal = "#edit-timelog-modal";

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
        buttons: [{
            text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Record Time',
            className: 'new-record btn btn-primary',
            attr: {
                'data-toggle': 'modal',
                'data-target': '#modals-slide-in'
            },
            init: function(api, node, config) {
                $(node).removeClass('btn-secondary');
            },
            action: function(e, dt, button, config) {
                $(new_timelog_modal).modal("show");
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
        dtControlling.ajax.reload();
    });

    // Date & TIme
    if (datePickr.length) {
        datePickr.flatpickr({
            enableTime: false
        });
    }

    $(new_timelog_modal).on("submit", "form", function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(new_timelog_modal).modal("hide");
                    $(form)[0].reset();

                    toastr["success"](resp.msg, "Success!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });

                    dtControlling.ajax.reload();
                }
            },
        });
    });

    $(edit_timelog_modal).on("submit", "form", function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(edit_timelog_modal).modal("hide");
                    $(form)[0].reset();

                    toastr["success"](resp.msg, "Success!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });

                    dtTimelog.ajax.reload();
                }
            },
        });
    });

    const initStartDatePickr = (defaultDate) => {
        if (startDatePickr.length) {
            const config = {
                disableMobile: true,
                enableTime: true,
                time_24hr: true,
                defaultDate: ((dayjs) => {
                    dayjs = dayjs.hour(userDefaultStartTime[0]);
                    dayjs = dayjs.minute(userDefaultStartTime[1]);

                    return dayjs.toDate();
                })(dayjs(new Date())),
                onChange: (selectedDates, dateStr, instanc) => {
                    if ($(new_timelog_modal).hasClass("show")) {
                        var end_date = $(new_timelog_modal)
                            .find("input[name=end_date]")
                            .val();

                        if (
                            end_date === undefined &&
                            $(new_timelog_modal).find("input[name=end_time]")
                            .length > 0
                        ) {
                            end_date = dayjs(
                                $(new_timelog_modal)
                                .find("input[name=end_time]")
                                .val(),
                                "HH:mm"
                            );
                        } else {
                            end_date = dayjs(end_date || new Date());
                        }

                        const hours = end_date.hour() - dayjs(dateStr).hour();

                        $(new_timelog_modal)
                            .find("input[name=duration]")
                            .val(Math.floor(hours));
                        fetchHours();
                    }
                    if ($(edit_timelog_modal).hasClass("show")) {
                        var end_date = $(edit_timelog_modal)
                            .find("input[name=end_date]")
                            .val();

                        if (
                            end_date === undefined &&
                            $(edit_timelog_modal).find("input[name=end_time]")
                            .length > 0
                        ) {
                            end_date = dayjs(
                                $(edit_timelog_modal)
                                .find("input[name=end_time]")
                                .val(),
                                "HH:mm"
                            );
                        } else {
                            end_date = dayjs(end_date || new Date());
                        }

                        const hours = end_date.hour() - dayjs(dateStr).hour();

                        $(edit_timelog_modal)
                            .find("input[name=duration]")
                            .val(Math.floor(hours));
                        fetchHours();
                    }
                },
            };

            if (defaultDate) {
                config.defaultDate = defaultDate;
            }

            startDatePickr.flatpickr(config);
        }
    };

    initStartDatePickr();

    var startTimeClickCount = 0,
        startTime = 0;
    if (startTimePickr.length) {
        startTimePickr.each(function() {
            $(this).flatpickr({
                disableMobile: true,
                enableTime: true,
                noCalendar: true,
                defaultHour: 7,
                time_24hr: true,
                onChange: (selectedDates, timeStr, instance) => {
                    startTimeClickCount++;
                    if (startTimeClickCount == 1) startTime = 7;
                    else startTime = timeStr;
                    if ($(new_timelog_modal).hasClass("show")) {
                        var start_date = $(new_timelog_modal)
                            .find("input[name=start_date]")
                            .val();
                        var end_time = $(new_timelog_modal)
                            .find("input[name=end_time]")
                            .val();

                        var start = moment(start_date + " " + startTime);
                        var end;
                        if (typeof end_date != "undefined") {
                            end = moment(end_date + " " + end_time);
                        } else {
                            end = moment(start_date + " " + end_time);
                        }

                        var duration = moment.duration(end.diff(start));

                        var hours = duration.asHours();
                        $(new_timelog_modal)
                            .find("input[name=duration]")
                            .val(hours);
                    }
                    if ($(edit_timelog_modal).hasClass("show")) {
                        var start_date = $(edit_timelog_modal)
                            .find("input[name=start_date]")
                            .val();
                        var end_time = $(edit_timelog_modal)
                            .find("input[name=end_time]")
                            .val();

                        var start = moment(start_date + " " + startTime);
                        var end;
                        if (typeof end_date != "undefined") {
                            end = moment(end_date + " " + end_time);
                        } else {
                            end = moment(start_date + " " + end_time);
                        }
                        var duration = moment.duration(end.diff(start));

                        var hours = duration.asHours();
                        $(edit_timelog_modal)
                            .find("input[name=duration]")
                            .val(hours);
                    }
                },
            });
        });
    }

    const initEndDatePickr = (defaultDate) => {
        if (endDatePickr.length) {
            const config = {
                disableMobile: true,
                enableTime: true,
                time_24hr: true,
                onChange: (selectedDates, dateStr, instanc) => {
                    if ($(new_timelog_modal).hasClass("show")) {
                        var start_date = $(new_timelog_modal)
                            .find("input[name=start_date]")
                            .val();

                        var start = moment(start_date);
                        var end = moment(dateStr);

                        var duration = moment.duration(end.diff(start));

                        var hours = duration.asHours();
                        $(new_timelog_modal)
                            .find("input[name=duration]")
                            .val(Math.floor(hours));
                        fetchHours();
                    }
                    if ($(edit_timelog_modal).hasClass("show")) {
                        var start_date = $(edit_timelog_modal)
                            .find("input[name=start_date]")
                            .val();

                        var start = moment(start_date);
                        var end = moment(dateStr);

                        var duration = moment.duration(end.diff(start));

                        var hours = duration.asHours();
                        $(edit_timelog_modal)
                            .find("input[name=duration]")
                            .val(Math.floor(hours));
                        fetchHours();
                    }
                },
            };

            if (defaultDate) {
                config.defaultDate = defaultDate;
            }

            endDatePickr.flatpickr(config);
        }
    };

    initEndDatePickr();

    var endTimeClickCount = 0,
        endTime = 0;

    const initEndTimePickr = (defaultHour = 22, defaultMinute = 0) => {
        if (endTimePickr.length) {
            endTimePickr.each(function() {
                $(this).flatpickr({
                    disableMobile: true,
                    enableTime: true,
                    noCalendar: true,
                    defaultHour,
                    defaultMinute,
                    time_24hr: true,
                    onChange: (selectedDates, timeStr, instance) => {
                        endTimeClickCount++;
                        if (endTimeClickCount == 1) {
                            endTime = 22;
                        } else {
                            const fragments = timeStr.split(":");
                            endTime = fragments[0];
                        }

                        if ($(new_timelog_modal).hasClass("show")) {
                            var start_date = $(new_timelog_modal)
                                .find("input[name=start_date]")
                                .val();

                            const hours = Math.ceil(
                                Number(endTime) -
                                Number(dayjs(start_date).hour())
                            );

                            $(new_timelog_modal)
                                .find("input[name=duration]")
                                .val(hours);
                            fetchHours();
                        }
                        if ($(edit_timelog_modal).hasClass("show")) {
                            var start_date = $(edit_timelog_modal)
                                .find("input[name=start_date]")
                                .val();

                            const fragments = timeStr.split(":");

                            const hours = Math.ceil(
                                Number(fragments[0]) -
                                Number(dayjs(start_date).hour())
                            );

                            $(edit_timelog_modal)
                                .find("input[name=duration]")
                                .val(hours);
                            fetchHours();
                        }
                    },
                });
            });
        }
    };

    initEndTimePickr();

    $(new_timelog_modal)
        .find("input[name=duration]")
        .on("keyup", function() {
            var duration = $(this).val();
            var start = $(new_timelog_modal)
                .find("input[name=start_date]")
                .val();
            var end = moment(start)
                .add(duration, "hours")
                .format(moment.HTML5_FMT.TIME);
            $(new_timelog_modal).find("input[name=end_time]").val(end);
        });
    $(edit_timelog_modal)
        .find("input[name=duration]")
        .on("keyup", function() {
            var duration = $(this).val();
            var start = $(edit_timelog_modal)
                .find("input[name=start_date]")
                .val();
            var end = moment(start)
                .add(duration, "hours")
                .format(moment.HTML5_FMT.TIME);
            $(edit_timelog_modal).find("input[name=end_time]").val(end);
        });
});
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
    "use strict";

    var dtTimelogTable = $(".timelog-list-table"),
        isRtl = $("html").attr("data-textdirection") === "rtl",
        API_URL = "/timesheet/logs",
        URL = "/timesheet",
        assetPath = '../vuexy/app-assets/',
        API_TOKEN = $("[name=api-token]").attr("content"),
        startDatePickr = $("input[name=start_date]"),
        startTimePickr = $("input[name=start_time]"),
        endDatePickr = $("input[name=end_date]"),
        endTimePickr = $("input[name=end_time]"),
        new_timelog_modal = "#new-timelog-modal",
        edit_timelog_modal = "#edit-timelog-modal";

    // datatable
    if (dtTimelogTable.length) {
        var dtTimelog = dtTimelogTable.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL,
                type: "GET",
                data: {
                    api_token: API_TOKEN,
                },
            }, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: "responsive_id" },
                { data: "id" },
                { data: "id" },
                { data: "date" },
                { data: "duration" },
                { data: "start" },
                { data: "end" },
                { data: "break" },
                { data: "project" },
                { data: "" },
            ],
            columnDefs: [{
                    // For Responsive
                    className: "control",
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    // For Checkboxes
                    targets: 1,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return (
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                            data +
                            '" /><label class="custom-control-label" for="checkbox' +
                            data +
                            '"></label></div>'
                        );
                    },
                    checkboxes: {
                        selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                    }
                },
                {
                    targets: 2,
                    visible: false
                },
                {
                    targets: 3,
                    responsivePriority: 2,
                },
                {
                    targets: 8,
                    responsivePriority: 3,
                },
                // {
                //     // Avatar image/badge, Name and post
                //     targets: 3,
                //     responsivePriority: 3,
                //     render: function(data, type, row, meta) {
                //         var $user_img = row.employee.avatar,
                //             $name = row.employee.name,
                //             $role = row.employee.role;
                //         if ($user_img) {
                //             // For Avatar image
                //             var $output =
                //                 '<img src="' + $user_img + '" alt="Avatar" width="32" height="32">';
                //         } else {
                //             // For Avatar badge
                //             var stateNum = row.employee.status;
                //             var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                //             var $state = states[stateNum],
                //                 $name = row.employee.name,
                //                 $initials = $name.match(/\b\w/g) || [];
                //             $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                //             $output = '<span class="avatar-content">' + $initials + '</span>';
                //         }

                //         var colorClass = $user_img === '' ? ' bg-light-' + $state + ' ' : '';
                //         // Creates full output for row
                //         var $row_output =
                //             '<div class="d-flex justify-content-left align-items-center">' +
                //             '<div class="avatar ' +
                //             colorClass +
                //             ' mr-1">' +
                //             $output +
                //             '</div>' +
                //             '<div class="d-flex flex-column">' +
                //             '<span class="emp_name text-truncate font-weight-bold">' +
                //             $name +
                //             '</span>' +
                //             '<small class="emp_post text-truncate text-muted">' +
                //             $role +
                //             '</small>' +
                //             '</div>' +
                //             '</div>';
                //         return $row_output;
                //     }
                // },
                {
                    targets: 5,
                    render: function(data, type, row) {
                        return `<span>${row.duration} Hours</span>`;
                    },
                },
                {
                    targets: 8,
                    render: function(data, type, row) {
                        if (row.break != null)
                            return `<span>${row.break} Hours</span>`;
                        else return "";
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    responsivePriority: 4,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return (
                            `<div class="d-inline-flex">
                                <a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">
                                    ${feather.icons['more-vertical'].toSvg({ class: 'font-small-4' })}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:;" class="dropdown-item">${feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' })}Details</a>
                                    <a href="javascript:;" class="dropdown-item btn-delete btn-responsive-delete" data-id="${full.id}">${feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' })}Delete</a>
                                </div>
                            </div>
                            <a href="javascript:;" class="item-edit btn-edit btn-responsive-edit" data-id="${full.id}">${feather.icons['edit'].toSvg({ class: 'font-small-4' })}</a>`
                        );
                    }
                }
            ],
            order: [
                [2, "desc"]
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
                text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add Time',
                className: 'create-new btn btn-primary',
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
            //responsive: true,
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
            },
        });
    }

    $(dtTimelogTable).on("click", ".btn-edit", async function() {
        var id = $(this).data("id");
        let form = $(edit_timelog_modal).find("form");
        $(edit_timelog_modal).modal("show");

        const timelog = await $.get("/timesheet/edit/" + id);

        const end_time = moment(
            timelog.end_time ?
            dayjs(timelog.end_time, "HH:mm:ss").toDate() :
            timelog.end_date ?
            dayjs(timelog.end_date).toDate() :
            new Date()
        ).format(moment.HTML5_FMT.TIME);

        form.find("input[name=id]").val(timelog.id);
        form.find("input[name=start_date]").val(timelog.start_date);
        form.find("input[name=end_date]").val(timelog.end_date);
        form.find("input[name=end_time]").val(end_time);
        form.find("input[name=duration]").val(timelog.duration);
        form.find("input[name=break]").val(timelog.break);
        form.find("select[name=project_id]").val(timelog.project_id);
        form.find("select[name=expenses_id]").val(timelog.expenses_id);

        var tags = [];
        $.each(timelog.tags, function(index, tag) {
            tags.push(tag.id);
        });
        if (tags.length != 0) {
            form.find(".tags-input").select2("val", tags);
        } else {
            form.find(".tags-input").val("");
        }

        $(".select2").trigger("change");
    });

    $(document).on("click", ".btn-responsive-edit", async function() {
        var id = $(this).data("id");
        let form = $(edit_timelog_modal).find("form");
        $(".dtr-bs-modal").modal("hide");
        $(edit_timelog_modal).modal("show");

        const timelog = await $.get("/timesheet/edit/" + id);

        const end_time = dayjs(
            timelog.end_time ?
            dayjs(timelog.end_time, "HH:mm:ss").toDate() :
            timelog.end_date
        ).toDate();

        form.find("input[name=id]").val(timelog.id);
        form.find("input[name=start_date]").flatpickr({
            disableMobile: true,
            enableTime: true,
            time_24hr: true,
            defaultDate: dayjs(timelog.start_date + ' ' + timelog.start_time).toDate(),
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
        });
        form.find("input[name=end_date]").flatpickr({
            disableMobile: true,
            enableTime: true,
            defaultDate: dayjs(timelog.end_date).toDate(),
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
        });
        form.find("input[name=end_time]").flatpickr({
            disableMobile: true,
            enableTime: true,
            noCalendar: true,
            defaultDate: end_time,
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
                        Number(endTime) - Number(dayjs(start_date).hour())
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
                        Number(fragments[0]) - Number(dayjs(start_date).hour())
                    );

                    $(edit_timelog_modal)
                        .find("input[name=duration]")
                        .val(hours);
                    fetchHours();
                }
            },
        });
        form.find("input[name=duration]").val(timelog.duration);
        form.find("input[name=break]").val(timelog.break);
        form.find("select[name=project_id]").val(timelog.project_id);
        form.find("select[name=expenses_id]").val(timelog.expenses_id);

        var tags = [];
        $.each(timelog.tags, function(index, tag) {
            tags.push(tag.id);
        });
        if (tags.length != 0) {
            form.find(".tags-input").select2("val", tags);
        } else {
            form.find(".tags-input").val("");
        }

        $(".select2").trigger("change");
    });
    $(document).on("click", ".btn-responsive-delete", async function() {
        let id = $(this).data("id");
        $(".dtr-bs-modal").modal("hide");
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
                const deleteData = await $.get(`/timesheet/${id}/delete`);
                if (deleteData.success) {
                    toastr["success"](deleteData.msg, "Deleted!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                    dtTimelog.ajax.reload();
                }
            }
        });
    });

    $(dtTimelogTable).on("click", ".btn-delete", async function() {
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
                const deleteData = await $.get(`/timesheet/${id}/delete`);
                if (deleteData.success) {
                    toastr["success"](deleteData.msg, "Deleted!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                    dtTimelog.ajax.reload();
                }
            }
        });
    });

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

                    dtTimelog.ajax.reload();
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
    $(".select2").each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: "100%",
            dropdownParent: $this.parent(),
        });
    });
});
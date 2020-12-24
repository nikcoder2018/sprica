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

    var dtTimelogTable = $('.timelog-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/timesheet/logs',
        URL = '/timesheet',
        API_TOKEN = $('[name=api-token]').attr('content'),
        dateTimePickr = $('.flatpickr-date-time'),
        timePickr = $('.flatpickr-time'),
        new_timelog_modal = '#new-timelog-modal',
        edit_timelog_modal = '#edit-timelog-modal';

    // datatable
    if (dtTimelogTable.length) {
        var dtTimelog = dtTimelogTable.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL,
                type: "GET",
                data: {
                    api_token: API_TOKEN
                }
            }, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'date' },
                { data: 'begin' },
                { data: 'end' },
                { data: 'duration' },
                { data: 'project' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        return `<span>${row.duration} Hours</span>`;
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
                              <a class="mr-1 btn-delete" href="javascript:void(0);" data-id="${full.id}" data-toggle="tooltip" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>
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
                searchPlaceholder: 'Search',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'Add Time',
                className: 'btn btn-primary btn-add-record ml-2',
                action: function(e, dt, button, config) {
                    $(new_timelog_modal).modal('show');
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

    $(dtTimelogTable).on('click', '.btn-edit', async function() {
        var id = $(this).data('id');
        let form = $(edit_timelog_modal).find('form');
        $(edit_timelog_modal).modal('show');

        const timelog = await $.get('/timesheet/edit/' + id);
        const end_time = moment(moment(timelog.date_start).format(moment.HTML5_FMT.DATE) + ' ' + timelog.end_time).format(moment.HTML5_FMT.TIME);
        form.find('input[name=id]').val(timelog.id);
        form.find('input[name=start_date]').val(timelog.dateStart);
        form.find('input[name=end_time]').val(end_time);
        form.find('input[name=duration]').val(timelog.duration);
        form.find('input[name=break]').val(timelog.break);
        form.find('select[name=project_id]').val(timelog.project_id);
        form.find('select[name=expenses_id]').val(timelog.expenses_id);

        var tags = [];
        $.each(timelog.tags, function(index, tag) {
            tags.push(tag.id);
        });
        if (tags.length != 0) {
            form.find('.tags-input').select2('val', tags);
        } else {
            form.find('.tags-input').val('');
        }

        $('.select2').trigger('change');
        //form.find('select[name=project_id]').val(timelog.project_id);
    });

    $(dtTimelogTable).on('click', '.btn-delete', async function() {
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
                const deleteData = await $.get(`/timesheet/${id}/delete`);
                if (deleteData.success) {
                    toastr['success'](deleteData.msg, 'Deleted!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dtTimelog.ajax.reload();
                }
            }
        });
    });
    $(new_timelog_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(new_timelog_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dtTimelog.ajax.reload();
                }
            }
        });
    });

    $(edit_timelog_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(edit_timelog_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dtTimelog.ajax.reload();
                }
            }
        });
    });


    // Date & TIme
    if (dateTimePickr.length) {
        dateTimePickr.flatpickr({
            enableTime: true,
            defaultHour: 7,
            onChange: function(selectedDates, dateStr, instanc) {
                if ($(new_timelog_modal).hasClass('show')) {
                    var end_time = $(new_timelog_modal).find('input[name=end_time]').val();

                    if (end_time == '') return;

                    var start = moment(dateStr);
                    var end = moment(moment(start).format(moment.HTML5_FMT.DATE) + ' ' + end_time);

                    var duration = moment.duration(end.diff(start));

                    var hours = duration.asHours();
                    $(new_timelog_modal).find('input[name=duration]').val(hours);
                }
                if ($(edit_timelog_modal).hasClass('show')) {
                    var end_time = $(edit_timelog_modal).find('input[name=end_time]').val();

                    if (end_time == '') return;

                    var start = moment(dateStr);
                    var end = moment(moment(start).format(moment.HTML5_FMT.DATE) + ' ' + end_time);

                    var duration = moment.duration(end.diff(start));

                    var hours = duration.asHours();
                    $(edit_timelog_modal).find('input[name=duration]').val(hours);
                }
            }
        });
    }
    var clickCount = 0,
        time = 0;
    if (timePickr.length) {
        timePickr.flatpickr({
            enableTime: true,
            noCalendar: true,
            defaultHour: 22,
            onChange: function(selectedDates, dateStr, instanc) {
                clickCount++;
                if (clickCount == 1) time = 22
                else time = dateStr;
                if ($(new_timelog_modal).hasClass('show')) {
                    var start = moment($(new_timelog_modal).find('input[name=start_date]').val());
                    var end = moment(moment(start).format(moment.HTML5_FMT.DATE) + ' ' + time);

                    var duration = moment.duration(end.diff(start));

                    var hours = duration.asHours();
                    $(new_timelog_modal).find('input[name=duration]').val(hours);

                }
                if ($(edit_timelog_modal).hasClass('show')) {
                    var start = moment($(edit_timelog_modal).find('input[name=start_date]').val());
                    var end = moment(moment(start).format(moment.HTML5_FMT.DATE) + ' ' + time);

                    var duration = moment.duration(end.diff(start));

                    var hours = duration.asHours();
                    $(edit_timelog_modal).find('input[name=duration]').val(hours);

                }

            }
        });
    }

    $(new_timelog_modal).find('input[name=duration]').on('keyup', function() {
        var duration = $(this).val();
        var start = $(new_timelog_modal).find('input[name=start_date]').val();
        var end = moment(start).add(duration, 'hours').format(moment.HTML5_FMT.TIME);
        $(new_timelog_modal).find('input[name=end_time]').val(end);
    });
    $(edit_timelog_modal).find('input[name=duration]').on('keyup', function() {
        var duration = $(this).val();
        var start = $(edit_timelog_modal).find('input[name=start_date]').val();
        var end = moment(start).add(duration, 'hours').format(moment.HTML5_FMT.TIME);
        $(edit_timelog_modal).find('input[name=end_time]').val(end);
    });
    $('.select2').each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent()
        });
    });
});
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

    $(new_timelog_modal).on('change', 'input[name=end_date]', function() {
        var start = moment($(new_timelog_modal).find('input[name=start_date]').val());
        var end = moment($(new_timelog_modal).find('input[name=end_date]').val());
        var duration = moment.duration(end.diff(start));
        var hours = duration.asHours();
        $(new_timelog_modal).find('input[name=duration]').val(hours);
    });
    $(new_timelog_modal).on('change', 'input[name=start_date]', function() {
        if ($(new_timelog_modal).find('input[name=end_date]').val() != '') {
            var start = moment($(new_timelog_modal).find('input[name=start_date]').val());
            var end = moment($(new_timelog_modal).find('input[name=end_date]').val());
            var duration = moment.duration(end.diff(start));
            var hours = duration.asHours();
            $(new_timelog_modal).find('input[name=duration]').val(hours);
        }
    });
    // Date & TIme
    if (dateTimePickr.length) {
        dateTimePickr.flatpickr({
            enableTime: true
        });
    }

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
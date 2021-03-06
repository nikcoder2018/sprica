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

    var dtAdvanceTable = $('.advances-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/advances/all',
        URL = '/advances',
        API_TOKEN = $('[name=api-token]').attr('content'),
        datePickr = $('.flatpickr-date'),
        new_advance_modal = '#new-advance-modal',
        edit_advance_modal = '#edit-advance-modal';

    // datatable
    if (dtAdvanceTable.length) {
        var dtAdvance = dtAdvanceTable.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL,
                type: "GET",
            }, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'received_at' },
                { data: 'debit_at' },
                { data: 'amount' },
                { data: 'employee' },
                { data: 'paid_by' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return (
                            `<div class="btn-group">
                                <a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">${feather.icons['more-vertical'].toSvg({ class: 'font-small-4' })}</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="mr-1 dropdown-item btn-edit" href="javascript:void(0);" data-id="${full.id}" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit-2'].toSvg({ class: 'font-medium-2' })} Edit</a>
                                    <a class="mr-1 dropdown-item btn-delete" href="javascript:void(0);" data-id="${full.id}" data-toggle="tooltip" data-placement="top" title="Delete">${feather.icons['trash'].toSvg({ class: 'font-medium-2' })} Delete</a>
                                </div>
                            </div>`
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
                text: 'Add',
                className: 'btn btn-primary btn-add-record ml-2',
                action: function(e, dt, button, config) {
                    $(new_advance_modal).modal('show');
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

    dtAdvanceTable.on('click', '.btn-edit', async function() {
        const id = $(this).data('id');
        const advance = await $.get('/advances/' + id + '/edit');
        let form = $(edit_advance_modal).find('form');
        form.find('input[name=id]').val(advance.id);
        form.find('select[name=user_id]').val(advance.user_id);
        form.find('input[name=received_at]').val(advance.received_at);
        form.find('input[name=debit_at]').val(advance.debit_at);
        form.find('input[name=amount]').val(advance.amount);
        form.find('select[name=paid_by]').val(advance.paid_by);

        form.find('select[name=user_id]').trigger('change');
        $(edit_advance_modal).modal('show');
    });

    dtAdvanceTable.on('click', '.btn-delete', async function() {
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
                const deleteData = await $.get(`/advances/${id}/delete`);
                if (deleteData.success) {
                    toastr['success'](deleteData.msg, 'Deleted!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dtAdvance.ajax.reload();
                }
            }
        });
    });

    $(new_advance_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(new_advance_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dtAdvance.ajax.reload();
                }
            }
        });
    });
    $(edit_advance_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(edit_advance_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dtAdvance.ajax.reload();
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
$(function() {
    "use strict";

    var dtTable = $(".leave-list-table"),
        isRtl = $("html").attr("data-textdirection") === "rtl",
        API_TOKEN = $("[name=api-token]").attr("content"),
        API_URL = "/api/leaves/all";

    if (dtTable.length) {
        var dt = dtTable.DataTable({
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
                { data: "employee" },
                { data: "date" },
                { data: "status" },
                { data: "type" },
                { data: "" },
            ],
            columnDefs: [{
                    // For Responsive
                    className: "control",
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    targets: 1,
                    visible: false
                },
                {
                    targets: 2,
                    render: function(data, type, row) {
                        if (row.employee != null) {
                            if (row.employee.avatar != '') {
                                // For Avatar image
                                var $name = row.employee.name;
                                var $output = `<img src="${row.employee.avatar}" alt="Avatar" width="32" height="32">`;
                            } else {
                                // For Avatar badge
                                var stateNum = row.employee.status;
                                var states = ['danger', 'success', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                var $state = states[stateNum],
                                    $name = row.employee.name,
                                    $initials = $name.match(/\b\w/g) || [];
                                $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                                $output = '<span class="avatar-content">' + $initials + '</span>';
                            }

                            var colorClass = row.employee.avatar === '' ? ' bg-light-' + $state + ' ' : '';
                            // Creates full output for row
                            var $row_output =
                                `<div class="d-flex justify-content-left align-items-center">
                                    <div class="avatar ${colorClass} mr-1" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" data-original-title="${row.employee.name}">
                                        ${$output}
                                    </div>
                                    <span class="emp_name text-truncate font-weight-bold">
                                        ${$name}
                                    </span>
                                </div>`;
                            return $row_output;

                        } else {
                            return '';
                        }
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        switch (row.status) {
                            case 'Pending':
                                return `<span class="badge badge-light-warning">${row.status}</span>`;
                                break;
                            case 'Approved':
                                return `<span class="badge badge-light-success">${row.status}</span>`;
                                break;
                            case 'Rejected':
                                return `<span class="badge badge-light-danger">${row.status}</span>`;
                                break;
                        }

                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row) {
                        return `<span class="badge badge-light-${row.type.color}">${row.type.name}</span>`;
                    }
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
            buttons: [],
            // For responsive popup
            //responsive: true,
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data.employee;
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
});
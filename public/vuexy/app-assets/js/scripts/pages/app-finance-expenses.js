$(() => {
    $("#date").flatpickr({
        enableTime: true,
    });

    const table = $("#expenses-table");
    let datatable;

    if (table.length) {
        datatable = table.DataTable({
            ajax: "/api/finance/expenses",
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "name" },
                { data: "cost" },
                { data: "date" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    responsivePriority: 2,
                    targets: 0,
                },
                {
                    targets: 3,
                    render: function (data, type, row, meta) {
                        return dayjs(data).format("MMMM DD, YYYY");
                    },
                },
                {
                    // Actions
                    targets: -1,
                    width: "80px",
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return `<div class="d-flex align-items-center col-actions">
                            <a class="mr-1 btn-view" href="javascript:void(0);" data-id="${
                                full.id
                            }" data-toggle="tooltip" data-placement="top" title="View">${feather.icons[
                            "eye"
                        ].toSvg({ class: "font-medium-2" })}</a>
                              <a class="mr-1 btn-edit" href="javascript:void(0);" data-id="${
                                  full.id
                              }" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons[
                            "edit-2"
                        ].toSvg({ class: "font-medium-2" })}</a>
                              <a class="mr-1 btn-delete" href="javascript:void(0);" data-id="${
                                  full.id
                              }" data-toggle="tooltip" data-placement="top" title="Delete">${feather.icons[
                            "delete"
                        ].toSvg({ class: "font-medium-2" })}</a>
                            </div>
                            `;
                    },
                },
            ],
            order: [[1, "desc"]],
            dom:
                '<"row d-flex justify-content-between align-items-center m-1"' +
                '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
                '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
                ">t" +
                '<"d-flex justify-content-between m-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search Expenses",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Add Expense",
                    className: "btn btn-primary btn-add-record ml-2",
                    action: function (e, dt, button, config) {
                        const modal = $("#add-expense-modal");
                        const form = $("#add-expense-form");
                        form.attr("action", "/api/finance/expenses");
                        form.attr("method", "POST");
                        modal.find(".modal-title").text("Add Expense");
                        modal.find("form")[0].reset();
                        modal.modal("show");
                    },
                },
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.DataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data.name;
                        },
                    }),
                    type: "column",
                    renderer: $.fn.DataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 1,
                                visible: false,
                            },
                            {
                                targets: 2,
                                visible: false,
                            },
                        ],
                    }),
                },
            },
            initComplete: function () {
                $(document).find('[data-toggle="tooltip"]').tooltip();
                // Adding role filter once table initialized
            },
            drawCallback: function () {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            },
        });
    }

    const viewModal = $("#view-expense-modal");
    const deleteModal = $("#delete-expense-modal");
    const form = $("#add-expense-form");

    viewModal.on("hidden.bs.modal", () => {
        viewModal.find("#view-expense-name").html("");
        viewModal.find("#view-expense-cost").html("");
        viewModal.find("#view-expense-description").html("");
        viewModal.find("#view-expense-date").html("");
    });

    deleteModal.on("click", "#confirm-button", async () => {
        const button = deleteModal.find("#confirm-button");
        const id = Number(button.attr("data-id"));
        if (id > 0) {
            try {
                await axios.delete(`/api/finance/expenses/${id}`);
                toastr.success("Expense deleted successfully.");
            } catch (error) {
                toastr.error("Expense does not exist.");
            } finally {
                datatable.ajax.reload();
            }
        }
    });

    deleteModal.on("hidden.bs.modal", () => {
        deleteModal.find("#confirm-button").attr("data-id", "-1");
    });

    form.on("submit", async function (e) {
        const modal = $("#add-expense-modal");
        e.preventDefault();

        const button = form.find('button[type="submit"]');
        button.addClass("disabled");
        button.attr("disabled", true);
        button.html('<i class="fas fa-circle-notch fa-spin"></i>');
        try {
            const form = $(this);
            const url = form.attr("action");
            const data = form.serialize();
            const method = form.attr("method").toLowerCase();

            await axios[method](url, data);
            modal.modal("hide");
            toastr.success("Expense saved successfully.");
            form[0].reset();
        } catch (error) {
            toastr.error("Unable to save expense.");
        } finally {
            button.removeClass("disabled");
            button.attr("disabled", false);
            button.html("Save");
            datatable.ajax.reload();
        }
    });

    table.on("click", ".btn-view", async function (e) {
        try {
            e.preventDefault();
            const button = $(this);
            const id = button.attr("data-id");
            const { data } = await axios.get(`/api/finance/expenses/${id}`);
            viewModal.find("#view-expense-name").html(data.name);
            viewModal.find("#view-expense-cost").html(data.cost);
            viewModal.find("#view-expense-description").html(data.description);
            viewModal
                .find("#view-expense-date")
                .html(dayjs(data.date).format("MMMM DD, YYYY"));
            viewModal.modal("show");
        } catch (error) {
            toastr.error("Expense does not exist.");
        }
    });

    table.on("click", ".btn-edit", async function (e) {
        try {
            e.preventDefault();
            const button = $(this);
            const id = button.attr("data-id");
            const { data } = await axios.get(`/api/finance/expenses/${id}`);
            form.find("#name").val(data.name);
            form.find("#description").val(data.description);
            form.find("#cost").val(data.cost);
            form.find("#date").flatpickr({
                defaultDate: dayjs(data.date).toDate(),
                enableTime: true,
            });
            form.attr("action", `/api/finance/expenses/${id}`);
            form.attr("method", "PUT");
            const modal = $("#add-expense-modal");
            modal.find(".modal-title").text("Edit Expense");
            modal.modal("show");
        } catch (error) {
            toastr.error("Expense does not exist.");
        }
    });

    table.on("click", ".btn-delete", async function (e) {
        try {
            e.preventDefault();
            const button = $(this);
            const id = button.attr("data-id");
            await axios.get(`/api/finance/expenses/${id}`);
            deleteModal.find("#confirm-button").attr("data-id", id);
            deleteModal.modal("show");
        } catch (error) {
            toastr.error("Expense does not exist.");
        }
    });
});

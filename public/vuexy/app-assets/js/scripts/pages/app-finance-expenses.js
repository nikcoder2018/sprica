$(() => {
    $("#purchase_date").flatpickr({
        enableTime: false,
    });

    const table = $("#expenses-table");

    let datatable;

    const addExpenseModal = $("#add-expense-modal");
    const addExpenseForm = $("#add-expense-form");

    const refreshCategories = async () => {
        try {
            const { data } = await axios.get(
                "/api/finance/expenses/categories"
            );
            const select = addExpenseForm.find("#category_id");
            select.html("");
            data.forEach((category) => {
                const option = $(document.createElement("option"));
                option.val(category.id);
                option.text(category.name);
                select.append(option);
            });
        } catch (_) {
            toastr.error("Unable to fetch categories.");
        }
    };

    if (table.length) {
        datatable = table.DataTable({
            ajax: "/api/finance/expenses",
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "name" },
                { data: "price" },
                { data: "user" },
                { data: "purchased_from" },
                { data: "purchased_date" },
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
                    targets: 2,
                    render: function (data, type, full, meta) {
                        let locale;
                        if (window.navigator.languages) {
                            locale = window.navigator.languages[0];
                        } else {
                            locale =
                                window.navigator.userLanguage ||
                                window.navigator.language;
                        }

                        const formatter = new Intl.NumberFormat(locale, {
                            style: "currency",
                            currency: full.currency.toUpperCase(),
                        });

                        return formatter
                            .format(data)
                            .replace(/\D00(?=\D*$)/, "");
                    },
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return data.name;
                    },
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
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
                        refreshCategories();
                        addExpenseForm.attr("action", "/api/finance/expenses");
                        addExpenseForm.attr("method", "POST");
                        addExpenseModal
                            .find(".modal-title")
                            .text("Add Expense");
                        addExpenseModal.find("form")[0].reset();
                        addExpenseModal.modal("show");
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
            },
            drawCallback: function () {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            },
        });
    }

    const viewModal = $("#view-expense-modal");
    const deleteModal = $("#delete-expense-modal");
    const addCategoryModal = $("#add-category-modal");
    const addCategoryForm = $("#add-category-form");
    const addCategoryButton = $("#add-category-button");

    addCategoryButton.on("click", () => {
        addExpenseModal.modal("hide");
        addCategoryModal.modal("show");
    });

    addCategoryForm.on("submit", async (e) => {
        e.preventDefault();
        try {
            const url = addCategoryForm.attr("action");
            const data = addCategoryForm.serialize();
            await axios.post(url, data);
            toastr.info("Category saved successfully.", "Notice");
            refreshCategories();
            addCategoryModal.modal("hide");
        } catch (_) {
            toastr.error("Unable to save category.");
        }
    });

    addCategoryModal.on("hidden.bs.modal", () => {
        addExpenseModal.modal("show");
    });

    viewModal.on("hidden.bs.modal", () => {
        viewModal.find("#view-expense-name").text("");
        viewModal.find("#view-expense-price").text("");
        viewModal.find("#view-expense-employee").text("");
        viewModal.find("#view-expense-purchased-from").text("");
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

    addExpenseForm.on("submit", async (e) => {
        e.preventDefault();

        const button = addExpenseForm.find('button[type="submit"]');
        button.addClass("disabled");
        button.attr("disabled", true);
        button.html('<i class="fas fa-circle-notch fa-spin"></i>');
        try {
            const url = addExpenseForm.attr("action");
            const form = addExpenseForm[0];
            const data = new FormData(form);
            const method = addExpenseForm.attr("method").toUpperCase();
            data.append("_method", method);
            await axios.post(url, data);
            addExpenseModal.modal("hide");
            toastr.success("Expense saved successfully.");
            form.reset();
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

            let locale;
            if (window.navigator.languages) {
                locale = window.navigator.languages[0];
            } else {
                locale =
                    window.navigator.userLanguage || window.navigator.language;
            }

            const formatter = new Intl.NumberFormat(locale, {
                style: "currency",
                currency: data.currency.toUpperCase(),
            });

            viewModal.find("#view-expense-name").text(data.name);
            viewModal
                .find("#view-expense-price")
                .text(formatter.format(data.price).replace(/\D00(?=\D*$)/, ""));
            viewModal.find("#view-expense-employee").text(data.user.name);
            viewModal.find("#view-expense-project").text(data.project.title);
            viewModal.find("#view-expense-category").text(data.category.name);
            viewModal
                .find("#view-expense-purchased-from")
                .text(data.purchased_from);
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
            await refreshCategories();
            addExpenseForm.attr("action", `/api/finance/expenses/${id}`);
            addExpenseForm.attr("method", "PUT");

            addExpenseForm.find("#user_id").val(data.user_id);
            addExpenseForm.find("#project_id").val(data.project_id);
            addExpenseForm.find("#name").val(data.name);
            addExpenseForm.find("#purchased_from").val(data.purchased_from);
            addExpenseForm.find("#purchase_date").flatpickr({
                defaultDate: dayjs(data.purchase_date).toDate(),
                enableTime: false,
            });
            addExpenseForm.find("#category_id").val(data.category_id);
            addExpenseForm.find("#price").val(data.price);
            addExpenseForm.find("#currency").val(data.currency);

            addExpenseModal.find(".modal-title").text("Edit Expense");
            addExpenseModal.modal("show");
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

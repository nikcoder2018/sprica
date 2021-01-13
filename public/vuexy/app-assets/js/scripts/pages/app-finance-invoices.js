$(() => {
    $("#date_of_issue").flatpickr({
        enableTime: false,
    });

    $("#due_date").flatpickr({
        enableTime: false,
    });

    const table = $("#invoices-table");
    let datatable;

    if (table.length) {
        datatable = table.DataTable({
            ajax: "/api/finance/invoices",
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "project" },
                { data: "address" },
                { data: "invoice_number" },
                { data: "date_of_issue" },
                { data: "date_due" },
                { data: "status" },
                { data: "total" },
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
                    targets: 1,
                    render: function (data, type, row, meta) {
                        return data.title;
                    },
                },
                {
                    targets: 4,
                    render: function (data, type, row, meta) {
                        return dayjs(data).format("MMMM DD, YYYY");
                    },
                },
                {
                    targets: 5,
                    render: function (data, type, row, meta) {
                        return dayjs(data).format("MMMM DD, YYYY");
                    },
                },
                {
                    targets: 6,
                    render: function (data, type, row, meta) {
                        const badges = {
                            Unpaid: "danger",
                            Paid: "success",
                            "Partially Paid": "warning",
                        };
                        return `<span class="badge badge-${badges[data]}">${data}</span>`;
                    },
                },
                {
                    targets: 7,
                    render: function (data, type, row, meta) {
                        return `$ ${data}`;
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
                searchPlaceholder: "Search Invoices",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Add Invoice",
                    className: "btn btn-primary btn-add-record ml-2",
                    action: async function (e, dt, button, config) {
                        const modal = $("#add-invoice-modal");
                        const form = $("#add-invoice-form");
                        form.attr("action", "/api/finance/invoices");
                        form.attr("method", "POST");
                        modal.find(".modal-title").text("Add Invoice");
                        $("#invoice-form-items").html(`
                        <div class="invoice-form-item">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger btn-sm invoice-form-item-remove-button">Remove Item</button>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="items[0][name]" placeholder="Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="items[0][description]" placeholder="Description" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Cost</label>
                                <input type="number" name="items[0][cost]" placeholder="Cost" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="items[0][quantity]" placeholder="Quantity" class="form-control">
                            </div>
                        </div>`);
                        modal.find("form")[0].reset();
                        const invoiceNumberInput = form.find("#invoice_number");
                        try {
                            const { data } = await axios.get(
                                "/api/finance/invoices/generate"
                            );
                            invoiceNumberInput.val(data);
                            invoiceNumberInput.attr("readonly", true);
                            invoiceNumberInput.addClass("disabled");
                        } catch (_) {
                            toastr.info(
                                "Unable to generate Invoice Number.",
                                "Notice"
                            );
                            invoiceNumberInput.attr("readonly", false);
                            invoiceNumberInput.removeClass("disabled");
                        }
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

    const viewModal = $("#view-invoice-modal");
    const deleteModal = $("#delete-invoice-modal");
    const form = $("#add-invoice-form");

    viewModal.on("hidden.bs.modal", () => {
        viewModal.find("#view-invoice-project").html("");
        viewModal.find("#view-invoice-address").html("");
        viewModal.find("#view-invoice-number").html("");
        viewModal.find("#view-invoice-date-of-issue").html("");
        viewModal.find("#view-invoice-due-date").html("");
        viewModal.find("#view-invoice-items").html("");
        viewModal.find("#view-invoice-status").html("");
        viewModal.find("#view-invoice-total").html("");
    });

    deleteModal.on("click", "#confirm-button", async () => {
        const button = deleteModal.find("#confirm-button");
        const id = Number(button.attr("data-id"));
        if (id > 0) {
            try {
                await axios.delete(`/api/finance/invoices/${id}`);
                toastr.success("Invoice deleted successfully.");
            } catch (error) {
                toastr.error("Invoice does not exist.");
            } finally {
                datatable.ajax.reload();
            }
        }
    });

    deleteModal.on("hidden.bs.modal", () => {
        deleteModal.find("#confirm-button").attr("data-id", "-1");
    });

    form.on("submit", async function (e) {
        e.preventDefault();
        const modal = $("#add-invoice-modal");

        const button = form.find('button[type="submit"]');
        button.addClass("disabled");
        button.attr("disabled", true);
        button.html('<i class="fas fa-circle-notch fa-spin"></i>');
        try {
            const form = $(this);
            const url = form.attr("action");
            const data = $(this).serialize();
            const method = form.attr("method").toLowerCase();

            await axios[method](url, data);
            modal.modal("hide");
            toastr.success("Invoice saved successfully.");
            form[0].reset();
            $("#invoice-form-items").html(`
            <div class="invoice-form-item">
                <div class="form-group">
                    <button type="button" class="btn btn-danger btn-sm invoice-form-item-remove-button">Remove Item</button>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="items[0][name]" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="items[0][description]" placeholder="Description" class="form-control" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Cost</label>
                    <input type="number" name="items[0][cost]" placeholder="Cost" class="form-control">
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="items[0][quantity]" placeholder="Quantity" class="form-control">
                </div>
            </div>`);
        } catch (error) {
            toastr.error("Unable to save invoice.");
        } finally {
            button.removeClass("disabled");
            button.attr("disabled", false);
            button.html("Save");
            datatable.ajax.reload();
        }
    });

    const wrap = (element) => {
        const div = document.createElement("div");
        div.classList.add("form-group");
        div.appendChild(element);
        return div;
    };

    const makeInput = (title, element, type = "text", value = "") => {
        const label = document.createElement("label");
        label.innerHTML = title;
        const lowercase = title.toLowerCase();

        const input = document.createElement(element);
        if (element === "input") {
            input.setAttribute("type", type);
        } else {
            input.setAttribute("cols", "30");
            input.setAttribute("rows", "3");
        }
        input.classList.add("form-control");
        $(input).val(value);
        input.setAttribute(
            "name",
            `items[${$("#invoice-form-items").children().length}][${lowercase}]`
        );
        input.setAttribute("placeholder", title);
        const div = wrap(label);
        div.append(input);
        return div;
    };

    form.on("click", "#add-invoice-item-button", (e) => {
        e.preventDefault();
        const wrapper = document.createElement("div");
        wrapper.classList.add("invoice-form-item");

        const removeButton = document.createElement("button");
        removeButton.classList.add("btn");
        removeButton.classList.add("btn-danger");
        removeButton.classList.add("btn-sm");
        removeButton.classList.add("invoice-form-item-remove-button");
        removeButton.innerHTML = "Remove Item";

        wrapper.append(wrap(removeButton));
        wrapper.append(makeInput("Name", "input"));
        wrapper.append(makeInput("Description", "textarea"));
        wrapper.append(makeInput("Cost", "input", "number"));
        wrapper.append(makeInput("Quantity", "input", "number"));

        wrapper.style.display = "none";

        $("#invoice-form-items").append(wrapper);

        $(wrapper).fadeIn(800);
    });

    form.on("click", ".invoice-form-item-remove-button", function (e) {
        e.preventDefault();
        const button = $(this);
        const item = button.parent().parent(".invoice-form-item");
        item.fadeOut({
            complete: () => item.remove(),
        });
    });

    $(".btn-print").on("click", async function () {
        const html = viewModal.find(".card").html();
        const printWindow = window.open("", "PRINT");

        const promises = [];

        document.querySelectorAll("link").forEach((link) => {
            if (link.href.includes(".css")) {
                promises.push(axios.get(link.href));
            }
        });

        const css = await Promise.all(promises);

        printWindow.document.write(`<html><head><title>Invoice</title>`);
        printWindow.document.write(
            css
                .map((css) => {
                    return `<style>${css.data}</style>`;
                })
                .join("")
        );

        const card = document.createElement("div");

        card.classList.add("card");
        card.innerHTML = html;

        printWindow.document.write("</head><body>");
        printWindow.document.write(card.outerHTML);
        printWindow.document.write("</body></html>");

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    });

    table.on("click", ".btn-view", async function (e) {
        try {
            e.preventDefault();
            const button = $(this);
            const id = button.attr("data-id");
            const { data } = await axios.get(`/api/finance/invoices/${id}`);
            $("#view-invoice-project").html(data.project.title);
            $("#view-invoice-address").html(data.address);
            const number = document.createElement("b");
            number.innerHTML = data.invoice_number;
            $("#view-invoice-number").html(`Invoice Number: `);
            $("#view-invoice-number").append(number);
            $("#view-invoice-status").html(`Status: <b>${data.status}</b>`);
            $("#view-invoice-date-of-issue").html(
                `Invoice Date: <b>${dayjs(data.date_of_issue).format(
                    "MMMM D, YYYY"
                )}</b>`
            );
            $("#view-invoice-due-date").html(
                `Due Date: <b>${dayjs(data.due_date).format(
                    "MMMM D, YYYY"
                )}</b>`
            );
            viewModal.modal("show");
            const tbody = $("#view-invoice-items");
            tbody.html("");
            data.items.forEach((item, index) => {
                const row = document.createElement("tr");
                row.style.display = "none";

                const wrap = (data) => {
                    const column = document.createElement("td");
                    column.innerHTML = data;
                    column.classList.add("text-center");
                    return column;
                };

                row.appendChild(wrap(item.name));
                row.appendChild(wrap(item.description));
                row.appendChild(wrap(`$ ${item.cost}`));
                row.appendChild(wrap(item.quantity));
                row.appendChild(wrap(`$ ${item.cost * item.quantity}`));

                tbody.append(row);
                $(row).fadeIn(500 * (index + 1));
            });
            const total = document.createElement("b");
            total.innerHTML = `$ ${data.items
                .map((item) => item.cost * item.quantity)
                .reduce((i, x) => i + x)}`;
            total.style.display = "none";
            $("#view-invoice-total").html(total);
            $(total).fadeIn(500);
        } catch (error) {
            toastr.error("Invoice does not exist.");
        }
    });

    table.on("click", ".btn-edit", async function (e) {
        try {
            e.preventDefault();
            const button = $(this);
            const id = button.attr("data-id");
            const { data } = await axios.get(`/api/finance/invoices/${id}`);

            form.find("#project_id").val(data.project_id);
            form.find("#address").val(data.address);
            form.find("#invoice_number").val(data.invoice_number);
            form.find("#status").val(data.status);
            $("#date_of_issue").flatpickr({
                defaultDate: dayjs(data.date_of_issue).toDate(),
                enableTime: false,
            });
            $("#due_date").flatpickr({
                defaultDate: dayjs(data.due_date).toDate(),
                enableTime: false,
            });

            form.attr("action", `/api/finance/invoices/${id}`);
            form.attr("method", "PUT");
            const modal = $("#add-invoice-modal");
            modal.find(".modal-title").text("Edit Invoice");
            modal.modal("show");
            $("#invoice-form-items").html("");
            data.items.forEach((item) => {
                const wrapper = document.createElement("div");
                wrapper.classList.add("invoice-form-item");

                const removeButton = document.createElement("button");
                removeButton.classList.add("btn");
                removeButton.classList.add("btn-danger");
                removeButton.classList.add("btn-sm");
                removeButton.classList.add("invoice-form-item-remove-button");
                removeButton.innerHTML = "Remove Item";

                wrapper.append(wrap(removeButton));
                wrapper.append(makeInput("Name", "input", "text", item.name));
                wrapper.append(
                    makeInput(
                        "Description",
                        "textarea",
                        "text",
                        item.description
                    )
                );
                wrapper.append(makeInput("Cost", "input", "number", item.cost));
                wrapper.append(
                    makeInput("Quantity", "input", "number", item.quantity)
                );

                wrapper.style.display = "none";

                $("#invoice-form-items").append(wrapper);

                $(wrapper).fadeIn(800);
            });
        } catch (error) {
            toastr.error("Invoice does not exist.");
        }
    });

    table.on("click", ".btn-delete", async function (e) {
        try {
            e.preventDefault();
            const button = $(this);
            const id = button.attr("data-id");
            await axios.get(`/api/finance/invoices/${id}`);
            deleteModal.find("#confirm-button").attr("data-id", id);
            deleteModal.modal("show");
        } catch (error) {
            toastr.error("Invoice does not exist.");
        }
    });
});

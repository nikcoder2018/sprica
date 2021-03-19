$(() => {
    $("#valid_until").flatpickr({
        enableTime: false,
    });

    // Get users current locale
    let locale;
    if (window.navigator.languages) {
        locale = window.navigator.languages[0];
    } else {
        locale = window.navigator.userLanguage || window.navigator.language;
    }

    // built-in js formatter for currency
    const formatter = new Intl.NumberFormat(locale, {
        style: "currency",
        currency: "USD",
    });

    const format = (value) => {
        return formatter.format(value).replace(/\D00(?=\D*$)/, "");
    };

    const table = $("#estimates-table");
    let datatable;

    if (table.length) {
        datatable = table.DataTable({
            ajax: "/api/finance/estimates",
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "estimate_number" },
                { data: "valid_until" },
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
                    targets: 2,
                    render: function (data, type, row, meta) {
                        return dayjs(data).format("MMMM DD, YYYY");
                    },
                },
                {
                    targets: 3,
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
                '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"estimate_status ml-sm-2">>' +
                ">t" +
                '<"d-flex justify-content-between m-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search Estimates",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Add Estimate",
                    className: "btn btn-primary btn-add-record ml-2",
                    action: async function (e, dt, button, config) {
                        const modal = $("#add-estimate-modal");
                        const form = $("#add-estimate-form");
                        form.attr("action", "/api/finance/estimates");
                        form.attr("method", "POST");
                        modal.find(".modal-title").text("Add Estimate");
                        $("#estimate-form-items").html(`
                            <div class="estimate-form-item">
                                <div class="form-group form-group-button">
                                    <button type="button" class="btn btn-danger btn-sm estimate-form-item-remove-button">Remove Item</button>
                                </div>
                                <div class="form-group form-group-name">
                                    <label>Name</label>
                                    <input type="text" name="items[0][name]" placeholder="Name" class="form-control form-name">
                                </div>
                                <div class="form-group form-group-cost">
                                    <label>Cost</label>
                                    <input type="number" name="items[0][cost]" placeholder="Cost" class="form-control form-cost">
                                </div>
                                <div class="form-group form-group-quantity">
                                    <label>Quantity</label>
                                    <input type="number" name="items[0][quantity]" placeholder="Quantity" class="form-control form-quantity">
                                </div>
                                <div class="form-group form-group-description">
                                    <label>Description</label>
                                    <textarea name="items[0][description]" placeholder="Description" class="form-control form-description" cols="30" rows="3"></textarea>
                                </div>
                                <div class="form-group form-group-amount">
                                    <label>Amount</label>
                                    <input type="text" name="items[0][amount]" placeholder="Amount" disabled class="form-control form-amount disabled" value="$ 0">
                                </div>
                            </div>`);
                        modal.find("form")[0].reset();
                        try {
                            const { data } = await axios.get(
                                `/api/finance/estimates/generate`
                            );
                            form.find("input#estimate_number").val(data);
                        } catch (_) {
                            toastr.info(
                                "Unable to generate Estimate Number.",
                                "Notice"
                            );
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

    const viewModal = $("#view-estimate-modal");
    const deleteModal = $("#delete-estimate-modal");
    const form = $("#add-estimate-form");

    const calculateTotals = () => {
        const data = [];
        form.find(".form-cost").each(function () {
            const cost = Number($(this).val()) || 0;
            const parent = $(this).parents(".estimate-form-item");
            const quantityInput = parent.find(".form-quantity");
            const amountInput = parent.find(".form-amount");
            const quantity = Number(quantityInput.val()) || 0;
            const amount = cost * quantity;
            amountInput.val(format(amount));
            data.push(amount);
        });
        form.find("#total").val(format(data.reduce((i, x) => i + x, 0)));
    };

    form.on("keyup", ".form-cost", () => calculateTotals());
    form.on("keyup", ".form-quantity", () => calculateTotals());

    viewModal.on("hidden.bs.modal", () => {
        viewModal.find("#view-estimate-number").html("");
        viewModal.find("#view-estimate-valid-until").html("");
        viewModal.find("#view-estimate-items").html("");
    });

    deleteModal.on("click", "#confirm-button", async () => {
        const button = deleteModal.find("#confirm-button");
        const id = Number(button.attr("data-id"));
        if (id > 0) {
            try {
                await axios.delete(`/api/finance/estimates/${id}`);
                toastr.success("Estimate deleted successfully.");
            } catch (error) {
                toastr.error("Estimate does not exist.");
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
        const modal = $("#add-estimate-modal");

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
            toastr.success("Estimate saved successfully.");
            form[0].reset();
            $("#estimate-form-items").html(`
            <div class="estimate-form-item">
                <div class="form-group form-group-button">
                    <button type="button" class="btn btn-danger btn-sm estimate-form-item-remove-button">Remove Item</button>
                </div>
                <div class="form-group form-group-name">
                    <label>Name</label>
                    <input type="text" name="items[0][name]" placeholder="Name" class="form-control form-name">
                </div>
                <div class="form-group form-group-cost">
                    <label>Cost</label>
                    <input type="number" name="items[0][cost]" placeholder="Cost" class="form-control form-cost">
                </div>
                <div class="form-group form-group-quantity">
                    <label>Quantity</label>
                    <input type="number" name="items[0][quantity]" placeholder="Quantity" class="form-control form-quantity">
                </div>
                <div class="form-group form-group-description">
                    <label>Description</label>
                    <textarea name="items[0][description]" placeholder="Description" class="form-control form-description" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group form-group-amount">
                    <label>Amount</label>
                    <input type="text" name="items[0][amount]" placeholder="Amount" disabled class="form-control form-amount disabled" value="$ 0">
                </div>
            </div>`);
        } catch (error) {
            toastr.error("Unable to save estimate.");
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
        input.classList.add(`form-${lowercase}`);
        $(input).val(value);
        input.setAttribute(
            "name",
            `items[${
                $("#estimate-form-items").children().length
            }][${lowercase}]`
        );
        input.setAttribute("placeholder", title);
        const div = wrap(label);
        div.classList.add(`form-group-${lowercase}`);
        div.append(input);
        return div;
    };

    form.on("click", "#add-estimate-item-button", (e) => {
        e.preventDefault();
        const wrapper = document.createElement("div");
        wrapper.classList.add("estimate-form-item");

        const removeButton = document.createElement("button");
        removeButton.classList.add("btn");
        removeButton.classList.add("btn-danger");
        removeButton.classList.add("btn-sm");
        removeButton.classList.add("estimate-form-item-remove-button");
        removeButton.innerHTML = "Remove Item";

        wrapper.append(
            ((button) => {
                button.classList.add("form-group-button");
                return button;
            })(wrap(removeButton))
        );
        wrapper.append(makeInput("Name", "input"));
        wrapper.append(makeInput("Cost", "input", "number"));
        wrapper.append(makeInput("Quantity", "input", "number"));
        wrapper.append(makeInput("Description", "textarea"));

        const amount = makeInput("Amount", "input", "text", "$ 0");
        $(amount)
            .find(".form-amount")
            .attr("disabled", "true")
            .addClass("disabled");
        wrapper.append(amount);

        wrapper.style.display = "none";

        $("#estimate-form-items").append(wrapper);

        $(wrapper).fadeIn(800);
    });

    form.on("click", ".estimate-form-item-remove-button", function (e) {
        e.preventDefault();
        const button = $(this);
        const item = button.parent().parent(".estimate-form-item");
        item.fadeOut({
            complete: () => {
                item.remove();
                calculateTotals();
            },
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

        printWindow.document.write(`<html><head><title>Estimate</title>`);
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
            const { data } = await axios.get(`/api/finance/estimates/${id}`);
            const number = document.createElement("b");
            number.innerHTML = data.estimate_number;
            $("#view-estimate-number").html(`Estimate Number: `);
            $("#view-estimate-number").append(number);
            $("#view-estimate-valid-until").html(
                dayjs(data.valid_until).format("MMMM D, YYYY")
            );
            viewModal.modal("show");
            const tbody = $("#view-estimate-items");
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
                row.appendChild(wrap(format(item.cost)));
                row.appendChild(wrap(item.quantity));
                row.appendChild(wrap(format(item.cost * item.quantity)));

                tbody.append(row);
                $(row).fadeIn(500 * (index + 1));
            });
            const total = document.createElement("b");
            total.innerHTML = format(
                data.items
                    .map((item) => item.cost * item.quantity)
                    .reduce((i, x) => i + x, 0)
            );
            total.style.display = "none";
            $("#view-estimate-total").html(total);
            $(total).fadeIn(500);
        } catch (error) {
            toastr.error("Estimate does not exist.");
        }
    });

    table.on("click", ".btn-edit", async function (e) {
        try {
            e.preventDefault();
            const button = $(this);
            const id = button.attr("data-id");
            const { data } = await axios.get(`/api/finance/estimates/${id}`);

            form.find("#estimate_number").val(data.estimate_number);
            $("#valid_until").flatpickr({
                defaultDate: dayjs(data.valid_until).toDate(),
                enableTime: false,
            });

            form.attr("action", `/api/finance/estimates/${id}`);
            form.attr("method", "PUT");
            const modal = $("#add-estimate-modal");
            modal.find(".modal-title").text("Edit Estimate");
            modal.modal("show");
            $("#estimate-form-items").html("");
            data.items.forEach((item) => {
                const wrapper = document.createElement("div");
                wrapper.classList.add("estimate-form-item");

                const removeButton = document.createElement("button");
                removeButton.classList.add("btn");
                removeButton.classList.add("btn-danger");
                removeButton.classList.add("btn-sm");
                removeButton.classList.add("estimate-form-item-remove-button");
                removeButton.innerHTML = "Remove Item";

                wrapper.append(
                    ((button) => {
                        button.classList.add("form-group-button");
                        return button;
                    })(wrap(removeButton))
                );
                wrapper.append(makeInput("Name", "input", "text", item.name));
                wrapper.append(makeInput("Cost", "input", "number", item.cost));
                wrapper.append(
                    makeInput("Quantity", "input", "number", item.quantity)
                );
                wrapper.append(
                    makeInput(
                        "Description",
                        "textarea",
                        "text",
                        item.description
                    )
                );

                const amount = makeInput(
                    "Amount",
                    "input",
                    "text",
                    format(item.cost * item.quantity)
                );
                $(amount)
                    .find(".form-amount")
                    .attr("disabled", "true")
                    .addClass("disabled");
                wrapper.append(amount);

                wrapper.style.display = "none";

                $("#estimate-form-items").append(wrapper);

                $(wrapper).fadeIn(800);
                calculateTotals();
            });
        } catch (error) {
            toastr.error("Estimate does not exist.");
        }
    });

    table.on("click", ".btn-delete", async function (e) {
        try {
            e.preventDefault();
            const button = $(this);
            const id = button.attr("data-id");
            await axios.get(`/api/finance/estimates/${id}`);
            deleteModal.find("#confirm-button").attr("data-id", id);
            deleteModal.modal("show");
        } catch (error) {
            toastr.error("Estimate does not exist.");
        }
    });
});

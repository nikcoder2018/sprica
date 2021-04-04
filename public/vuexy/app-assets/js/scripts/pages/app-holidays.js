/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 **/

'use-strict';

// RTL Support
var direction = 'ltr',
    colorOption = $('.holiday-color-options li');

if ($('html').data('textdirection') == 'rtl') {
    direction = 'rtl';
}

var isRtl = direction;

if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
}

$(document).on('click', '.fc-sidebarToggle-button', function(e) {
    $('.app-calendar-sidebar, .body-content-overlay').addClass('show');
});

$(document).on('click', '.body-content-overlay', function(e) {
    $('.app-calendar-sidebar, .body-content-overlay').removeClass('show');
});

if (colorOption.length) {
    colorOption.on('click', function() {
        const color = $(this).attr('color');
        colorOption.parent().siblings('input[name=color]').val(color);
        $(this).addClass('selected').siblings().removeClass('selected');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar'),
        addHolidayModal = $('#add-new-modal'),
        dateInput = $('input[name=date]'),
        selectAll = $('.select-all'),
        calEventFilter = $('.calendar-events-filter'),
        filterInput = $('.input-filter');

    // Date Picker
    if (dateInput.length) {
        var date = dateInput.flatpickr({
            enableTime: false,
            altFormat: 'Y-m-dTH:i:S',
            onReady: function(selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr('step', null);
                }
            }
        });
    }

    // --------------------------------------------------------------------------------------------------
    // AXIOS: fetchEvents
    // * This will be called by fullCalendar to fetch events. Also this can be used to refetch events.
    // --------------------------------------------------------------------------------------------------
    async function fetchEvents() {
        // Fetch Events from API endpoint reference
        const results = await $.get('/hr/holidays/events');
        return results.events
    }

    // Calendar plugins
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: fetchEvents,
        editable: true,
        dragScroll: true,
        dayMaxEvents: 2,
        eventResizableFromStart: true,
        customButtons: {
            sidebarToggle: {
                text: 'Sidebar'
            }
        },
        headerToolbar: {
            start: 'sidebarToggle, prev,next, title',
            end: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        direction: direction,
        initialDate: new Date(),
        navLinks: true, // can click day/week names to navigate views
        eventClassNames: function({ event: calendarEvent }) {
            return [
                // Background Color
                'bg-light-' + calendarEvent._def.extendedProps.color
            ];
        }
    });

    // Render calendar

    setTimeout(function() {
        calendar.render();
    }, 3000);

    addHolidayModal.on('submit', 'form', function(e) {
        e.preventDefault();
        let form = $(this);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                addHolidayModal.modal("hide");
                form[0].reset();
                calendar.refetchEvents();
                toastr["success"](resp.msg, "Success!", {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl,
                });
            }
        })
    });


    // Select all & filter functionality
    if (selectAll.length) {
        selectAll.on('change', function() {
            var $this = $(this);

            if ($this.prop('checked')) {
                calEventFilter.find('input').prop('checked', true);
            } else {
                calEventFilter.find('input').prop('checked', false);
            }
            calendar.refetchEvents();
        });
    }

    if (filterInput.length) {
        filterInput.on('change', function() {
            $('.input-filter:checked').length < calEventFilter.find('input').length ?
                selectAll.prop('checked', false) :
                selectAll.prop('checked', true);
            calendar.refetchEvents();
        });
    }
});
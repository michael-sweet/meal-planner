require('@fullcalendar/core');
require('@fullcalendar/list');

import { Calendar } from '@fullcalendar/core';
import listPlugin from '@fullcalendar/list';
import bootstrap from '@fullcalendar/bootstrap';
import luxonPlugin from '@fullcalendar/luxon3';
import { toLuxonDateTime } from '@fullcalendar/luxon3';

let calendarEl = document.getElementById('calendar');
if (calendarEl) {
    let calendar = new Calendar(calendarEl, {
        events: window.calendar.events,
        eventContent: (args) => {
            var title = document.createElement('div');
            title.innerHTML = '<i class="fa-regular fa-eye me-2"></i>' + args.event.title;
            return { domNodes: [ title ]};
        },
        plugins: [luxonPlugin, listPlugin, bootstrap],
        themeSystem: 'bootstrap',
        initialView: 'listWeek',
        noEventsContent: 'No meals selected for this week',
        headerToolbar: {
            left: 'title',
            right: 'today prev,next'
        },
        eventClick: (info) => {
            window.location.href = window.Laravel.routes.viewMeal.replace(':selected_meal_id', info.event.extendedProps.meal_selection_id);
        },
        listDayFormat: false,
        listDaySideFormat: false,
        datesSet: updateButtons,
        height: 'auto',
        firstDay: 1
    });
    calendar.render();

    if (window.calendar.calendar_start) {
        calendar.gotoDate(window.calendar.calendar_start);
    }

    function getCurrentYear() {
        var luxonDate = toLuxonDateTime(calendar.view.currentStart, calendar)
        return luxonDate.weekYear;
    }

    function getCurrentWeek() {
        var luxonDate = toLuxonDateTime(calendar.view.currentStart, calendar)
        return luxonDate.weekNumber;
    }

    function updateButtons() {
        var eventsThisWeek = calendar.getEvents().filter(function(event) {
            return event.start >= calendar.view.currentStart && event.start <= calendar.view.currentStart;
        });
        if ($.isEmptyObject(eventsThisWeek)) {
            $('#view_ingredients').hide();
            $('#edit_meal_selections').addClass('btn-primary').removeClass('btn-secondary');
        } else {
            $('#view_ingredients').show();
            $('#edit_meal_selections').addClass('btn-secondary').removeClass('btn-primary');
        }
    }

    $('#view_ingredients').click(() => {
        window.location.href = window.Laravel.routes.viewCollatedIngredients.replace(':year', getCurrentYear()).replace(':week', getCurrentWeek());
        return false;
    })

    $('#edit_meal_selections').click(() => {
        window.location.href = window.Laravel.routes.editSelection.replace(':year', getCurrentYear()).replace(':week', getCurrentWeek());
        return false;
    })
}

require('@fullcalendar/core');
require('@fullcalendar/list');

import { Calendar } from '@fullcalendar/core';
import listPlugin from '@fullcalendar/list';

let calendarEl = document.getElementById('calendar');
if (calendarEl) {
    let calendar = new Calendar(calendarEl, {
        events: window.calendar.events,
        plugins: [listPlugin],
        initialView: 'listWeek',
        noEventsContent: 'No meals selected for this week',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'editMealSelections'
        },
        eventClick: (info) => {
            window.location.href = window.Laravel.routes.viewMeal.replace(':selected_meal_id', info.event.extendedProps.meal_selection_id);
        },
        listDayFormat: false,
        listDaySideFormat: false,
        height: 'auto',
        customButtons: {
            editMealSelections: {
                'text': 'Choose meals for week',
                click: () => {
                    window.location.href = window.Laravel.routes.editSelection.replace(':year', getCurrentYear()).replace(':week', getCurrentWeek());
                }
            }
        }
    });
    calendar.render();

    if (window.calendar.calendar_start) {
        calendar.gotoDate(window.calendar.calendar_start);
    }

    let getCurrentYear = () => {
        return calendar.formatDate(calendar.view.currentStart, { year: 'numeric' });
    }
    let getCurrentWeek = () => {
        return calendar.formatDate(calendar.view.currentStart, { week: 'numeric' });
    }

    $('#view_ingredients').click(() => {
        window.location.href = window.Laravel.routes.viewCollatedIngredients.replace(':year', getCurrentYear()).replace(':week', getCurrentWeek());
        return false;
    })
}

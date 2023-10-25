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

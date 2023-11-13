<x-layout>
    @section('container_class', 'container__main--sm')
    <div id='calendar'></div>
    <a href="" id="edit_meal_selections" class="btn btn-primary mt-3 icon-link"><i class="fa-regular fa-calendar"></i>Select meals</a>
    <a href="" id="view_ingredients" class="btn btn-primary mt-3 icon-link"><i class="fa-regular fa-eye"></i>View ingredients</a>
    <script>
        window.Laravel = {
            routes: {
                editSelection: "{{ route('selections.edit', ['year' => ':year', 'week' => ':week']) }}",
                viewCollatedIngredients: "{{ route('selections.view_ingredients', ['year' => ':year', 'week' => ':week']) }}",
                viewMeal: "{{ route('selections.meals.view', ['selected_meal_id' => ':selected_meal_id']) }}"
            }
        };

        window.calendar.events = @json($events);
        window.calendar.calendar_start = @json($calendar_start);
    </script>
</x-layout>


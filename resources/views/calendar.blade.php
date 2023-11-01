<x-layout>
    <div id='calendar'></div>
    <a href="" id="view_ingredients" class="btn btn-primary mt-3">View Ingredients</a>

    <x-slot name="scripts_before">
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
    </x-slot>
</x-layout>


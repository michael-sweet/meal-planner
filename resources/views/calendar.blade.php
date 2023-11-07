<x-layout>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div id='calendar'></div>
            <a href="" id="view_ingredients" class="btn btn-primary mt-3">View ingredients</a>
            <a href="" id="edit_meal_selections" class="btn btn-primary mt-3">Select meals</a>

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
        </div>
    </div>
</x-layout>


<x-layout>
    <div id='calendar'></div>
    <a href="" id="view_ingredients" class="btn btn-primary mt-3">View Ingredients</a>

    <div class="modal fade" id="mealModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="mealModal__title"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ingredient name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="mealModal__ingredients">
                        @foreach ($events[0]['meal_ingredients'] as $meal_ingredient)
                        <tr>
                            <td>{{ $meal_ingredient['ingredient']['name'] }}</td>
                            <td>{{ $meal_ingredient['amount'] }} {{ $meal_ingredient['ingredient']['unit'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary my-3" id="mealModal__toggle-cooked"></button>
                <img src="/storage/{{ $events[0]['meal']['image_path'] }}" class="img-fluid" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts_before">
        <script>
            window.Laravel = {
                routes: {
                    editSelection: "{{ route('edit_selections', ['year' => ':year', 'week' => ':week']) }}",
                    viewCollatedIngredients: "{{ route('view_collated_ingredients', ['year' => ':year', 'week' => ':week']) }}",
                    viewMeal: "{{ route('view_selected_meal', ['selected_meal_id' => ':selected_meal_id']) }}"
                }
            };

            window.calendar.events = @json($events);
            window.calendar.calendar_start = @json($calendar_start);
        </script>
    </x-slot>
</x-layout>


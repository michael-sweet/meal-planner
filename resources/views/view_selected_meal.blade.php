<x-meal_layout :meal="$meal">
    <a href="{{ route('selections.calendar', [$meal_selection->year, $meal_selection->week]) }}" class="btn btn-primary mb-3">Back to calendar</a>
    <div class="row">
        <div class="col-12 col-lg-6">
            <h1>{{ $meal->name }}</h1>
            <img src="{{ asset('storage/' . $meal->image_path) }}" class="img-fluid mt-3" />
        </div>
        <div class="col-12 col-lg-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ingredient</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meal_ingredients as $meal_ingredient)
                        <tr>
                            <td>{{ $meal_ingredient->ingredient->name }}</td>
                            <td>{{ $meal_ingredient->amount }} {{ $meal_ingredient->ingredient->unit }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-meal_layout>

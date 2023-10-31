<x-meal_layout :meal="$meal">
    <div class="row">
        <div class="col-12 col-lg-6">
            <h1>{{ $meal->name }}</h1>
            <a href="{{ url('edit_meal', [$meal->id]) }}" class="btn btn-primary my-3"><i class="fa-solid fa-pen-to-square"></i> Edit Details</a>
            <img src="{{ asset('storage/' . $meal->image_path) }}" class="img-fluid mt-3" />
        </div>
        <div class="col-12 col-lg-6">
            <a href="{{ url('add_meal_ingredient', [$meal->id]) }}" class="btn btn-primary my-3"><i class="fa-solid fa-plus"></i> Add ingredient</a>
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
            <a href="{{ url('edit_meal_ingredients', [$meal->id]) }}" class="btn btn-secondary my-3"><i class="fa-solid fa-pen-to-square"></i> Edit amounts</a>
        </div>
    </div>
</x-meal_layout>

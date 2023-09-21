<x-meal_layout :meal="$meal">
    <a class="btn btn-secondary mb-3" href="{{ route('view_meals') }}"><i class="fa-solid fa-angle-left"></i> All meals</a>
    <div class="row">
        <div class="col-12 col-lg-6">
            <h1>{{ $meal->name }}</h1>
            <a href="{{ url('edit_meal', [$meal->id]) }}" class="btn btn-primary my-3"><i class="fa-solid fa-pen-to-square"></i> Edit Details</a>
            <img src="{{ asset('storage/' . $meal->image_path) }}" class="img-fluid mt-3" />
        </div>
        <div class="col-12 col-lg-6">
            <h2>Ingredients</h2>
            <a href="{{ url('edit_meal_ingredients', [$meal->id]) }}" class="btn btn-primary my-3"><i class="fa-solid fa-pen-to-square"></i> Edit Ingredients</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meal_ingredients as $meal_ingredient)
                        <tr>
                            <td>{{ $meal_ingredient->ingredient->name }}</td>
                            <td>{{ $meal_ingredient->amount }}{{ $meal_ingredient->ingredient->amount_type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-meal_layout>

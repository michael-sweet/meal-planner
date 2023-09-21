<x-meal_layout :meal="$meal">
    <h1>{{ $meal->name }}</h1>
    <h2>Ingredients</h2>
    <form method="post">
        @csrf
        <input type="hidden" name="submitted" value="save_amounts" />
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meal_ingredients as $meal_ingredient)
                    <tr>
                        <td>{{ $meal_ingredient->ingredient->name }}</td>
                        <td>
                            <input
                                type="text"
                                name="meal_ingredients[{{ $meal_ingredient->id }}]"
                                value="{{ $meal_ingredient->amount }}"
                                class="form-control" />
                        </td>
                        <td>{{ $meal_ingredient->ingredient->amount_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-meal_layout>

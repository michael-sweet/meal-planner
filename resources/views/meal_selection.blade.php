<x-layout>
    <h1>This week's Meals</h1>
    <table>
        <tbody>
            @foreach ($meals as $meal)
                <tr>
                    <td>{{ $meal->name }}</td>
                    <td>
                        @foreach ($meal->mealIngredients as $meal_ingredient)
                            {{ $meal_ingredient->ingredient->name }}: {{ $meal_ingredient->amount }}<br />
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr />

    <h2>Ingredient List</h2>
    @foreach ($ingredients as $ingredient_name => $amount)
        {{ $ingredient_name }}: {{ $amount }}<br />
    @endforeach
</x-layout>

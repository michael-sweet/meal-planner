<x-layout>
    <h1 class="mb-3">
        {{ $meal->name }}
        <a href="{{ url('edit_meal', [$meal->id]) }}" class="ms-2"><i class="fa-solid fa-pen-to-square"></i></a>
    </h1>

    <table>
        <tbody>
            @foreach ($meal_ingredients as $meal_ingredient)
                <tr>
                    <td>{{ $meal_ingredient->ingredient->name }}</td>
                    <td>{{ $meal_ingredient->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>

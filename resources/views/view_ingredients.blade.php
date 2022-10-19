<x-layout>
    <h1>Ingredients</h1>
    <a href="{{ url('edit_ingredient', [0]) }}">Add Ingredient</a>
    <table class="table">
        <tbody>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <td><a href="{{ url('edit_ingredient', [$ingredient->id]) }}">edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>

<x-layout>
    <h1 class="mb-3">
        Ingredients
        <a href="{{ url('edit_ingredient', [0]) }}" class="ms-2"><i class="fa-solid fa-circle-plus"></i></a>
    </h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Unit</th>
                <th>Meal count</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->unit }}</td>
                    <td>{{ $ingredient->meals->count() }}</td>
                    <td><a href="{{ url('edit_ingredient', [$ingredient->id]) }}">edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>

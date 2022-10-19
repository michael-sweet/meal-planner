<x-layout>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" value="{{ $meal->name }}" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <br />
    <br />
    <a href="{{ url('edit_meal_ingredient', [$meal->id, 0]) }}">Add Meal Ingredient</a>
    <table>
        <tbody>
            @foreach ($meal_ingredients as $meal_ingredient)
                <tr>
                    <td>{{ $meal_ingredient->ingredient->name }}</td>
                    <td>{{ $meal_ingredient->amount }}</td>
                    <td><a href="{{ url('edit_meal_ingredient', [$meal->id, $meal_ingredient->id]) }}">edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>

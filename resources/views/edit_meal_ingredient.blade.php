Meal: {{ $meal->name }}
<form method="post">
    @csrf
    <div>
        <label>Ingredient<label>
        <select name="ingredient">
            <option value="">- please select -</option>
            @foreach ($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Amount<label>
        <input type="text" name="amount" value="{{ $meal_ingredient->amount }}" />
    </div>
    <button type="submit">Save</button>
</form>

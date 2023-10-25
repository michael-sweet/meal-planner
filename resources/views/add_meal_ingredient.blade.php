<x-meal_layout :meal="$meal">
    <h1>{{ $meal->name }}</h1>
    <h2>Add ingredient</h2>
    <form method="post">
        @csrf
        <input type="hidden" name="submitted" value="add_ingredient" />
        <div class="mb-3">
            <select name="ingredient_id" class="form-select">
                <option value=""> - select ingredient -</option>
                @foreach ($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">
                        {{ $ingredient->name }}
                        @isset($ingredient->unit)
                            ({{ $ingredient->unit }})
                        @endisset
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" name="amount" class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-meal_layout>

<x-meal_layout :meal="$meal">
    @section('container_class', 'container__main--sm')

    <form method="post" class="m-0">
        @csrf
        <div class="mb-3">
            <label for="ingredient_id" class="form-label">Ingredient</label>
            <select name="ingredient_id" class="form-select js-select2">
                <option value=""> - select ingredient -</option>
                @foreach ($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}" @if($ingredient->id == old('ingredient_id', $meal_ingredient->ingredient_id)) selected @endif>
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
            <input type="text" name="amount" class="form-control" value="{{ old('amount', $meal_ingredient->amount) }}" />
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary icon-link"><i class="fa-solid fa-floppy-disk"></i>Save</button>
            <a href="{{ route('meals.view', [$meal->id]) }}" class="btn btn-secondary icon-link"><i class="fa-solid fa-xmark"></i>Cancel</a>
        </div>
    </form>
</x-meal_layout>

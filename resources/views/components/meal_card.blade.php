<div class="card-meal selection position-relative rounded">
    @isset($selectable)
    <input
        class="form-check-input d-none js-meal-checkbox"
        type="checkbox"
        name="meal_selections[]"
        value="{{ $meal->id }}"
        id="meal_{{ $meal->id }}"
        @if ($selections->contains($meal->id))
            checked
        @endif
    />
    <label class="form-check-label" for="meal_{{ $meal->id }}">
    @endisset
    <div class="card-meal__img" style="background-image: url('{{ asset('storage/' . $meal->image_path) }}')"></div>
    <div class="card-meal__body p-2">
        @isset($selectable)
            <span class="icon-link">
                <i class="fa-regular fa-square icon-unchecked me-1"></i><i class="fa-regular fa-square-check icon-checked me-1"></i>{{ $meal->name }}
            </span>
        @else
            <a href="{{ route('meals.view', [$meal->id]) }}" class="stretched-link icon-link">
                <i class="fa-regular fa-eye"></i>{{ $meal->name }}
            </a>
        @endif
    </div>
    @isset($selectable)
    </label>
    @endisset
</div>

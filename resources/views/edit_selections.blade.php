<x-layout>
    <form method="post">
        @csrf
        <input type="hidden" name="submitted" value="save_selections" />

        @foreach ($meals as $meal)
            <div class="selection form-check d-flex align-items-center p-3 rounded">
                <input class="form-check-input ms-0 me-3"
                    type="checkbox"
                    name="meal_selections[]"
                    value="{{ $meal->id }}"
                    id="meal_{{ $meal->id }}"
                    @if ($selections->contains($meal->id))
                        checked
                    @endif
                />
                <label class="form-check-label" for="meal_{{ $meal->id }}">
                    <div class="d-flex align-items-center">
                        <div class="selection__img-container rounded">
                            <img src="{{ asset('storage/' . $meal->image_path) }}" class="img-fluid" />
                        </div>
                        <div class="ms-3">
                            <div><strong>{{ $meal->name }}</strong></div>
                            <div>
                                @foreach ($meal->ingredients as $ingredient)
                                {{ $ingredient->name }}@if (!$loop->last), @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-5">Save</button>
    </form>
</x-layout>

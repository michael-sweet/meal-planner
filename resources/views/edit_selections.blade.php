<x-layout>
    <form method="post">
        @csrf
        <input type="hidden" name="submitted" value="save_selections" />

        <div class="row row-cols-auto g-3">
            @foreach ($meals as $meal)
            <div class="col">
                <div class="selection">
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
                    <label class="form-check-label d-inline-block p-3 rounded" for="meal_{{ $meal->id }}">
                        <strong class="d-block text-center lh-1 mb-3">{{ $meal->name }}</strong>
                        <div class="selection__img-container rounded">
                            <img src="{{ asset('storage/' . $meal->image_path) }}" class="img-fluid" />
                        </div>
                    </label>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex align-items-center mt-5">
            <button type="submit" class="btn btn-primary">Save</button>
            <div class="ms-3">
                <span class="js-selection-count">0</span> meals selected.
                <a href="" class="js-select-all-meals">Select all</a> |
                <a href="" class="js-select-no-meals">Select none</a>
            </div>
        </div>
    </form>

    <x-slot name='scripts'>
        <script>
            function updateSelectionCounts() {
                $('.js-selection-count').text($('.js-meal-checkbox:checked').length);
            }

            $('.js-meal-checkbox').change(function () {
                updateSelectionCounts();
            });

            $('.js-select-all-meals').click(function (e) {
                e.preventDefault();
                $('.js-meal-checkbox').prop('checked', true);
                updateSelectionCounts();
            });

            $('.js-select-no-meals').click(function (e) {
                e.preventDefault();
                $('.js-meal-checkbox').prop('checked', false);
                updateSelectionCounts();
            });

            $(function () {
                updateSelectionCounts();
            });
        </script>
    </x-slot>
</x-layout>

<x-layout>
    <h1 class="mb-4">{{ $heading }}</h1>
    <form method="post">
        @csrf

        <div class="d-flex flex-wrap flex-column flex-sm-row gap-3">
            @foreach ($meals as $meal)
                <x-meal_card :meal=$meal :selections=$selections :selectable=true></x-meal_card>
            @endforeach
        </div>

        <div class="d-flex flex-wrap align-items-center mt-5 gap-2">
            <button type="submit" class="btn btn-primary icon-link"><i class="fa-solid fa-floppy-disk"></i>Save</button>
            <a href="{{ route('selections.calendar', [$year, $week]) }}" class="btn btn-secondary icon-link"><i class="fa-solid fa-xmark"></i>Cancel</a>
        </div>
        <div class="d-flex flex-wrap align-items-center mt-3 gap-2">
            <div><span class="js-selection-count">0</span> meal(s) selected.</div>
            <a href="" class="js-select-all-meals">Select all</a>
            <a href="" class="js-select-no-meals">Select none</a>
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

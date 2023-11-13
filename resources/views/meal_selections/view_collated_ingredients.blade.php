<x-layout>
    @section('container_class', 'container__main--sm')

    <h1 class="mb-3">{{ $heading }}</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ingredient</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $totals[$ingredient->id] }} {{ $ingredient->unit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        @foreach ($ingredients as $ingredient)
        {{ $ingredient->name }}@if (!$loop->last), @endif
        @endforeach
    </div>

    <a href="{{ route('selections.calendar', [$year, $week]) }}" class="btn btn-primary mt-4 icon-link">
        <i class="fa-solid fa-arrow-left"></i>Back to calendar
    </a>
</x-layout>

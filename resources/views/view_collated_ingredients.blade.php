<x-layout>
    <h1 class="mb-4">
        <a href="{{ route('selections.calendar', [$year, $week]) }}" class="mb-3">
            <i class="fa-solid fa-arrow-left"></i>{{ $heading }}
        </a>
    </h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
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

    <div class="mt-5">
        @foreach ($ingredients as $ingredient)
        {{ $ingredient->name }}@if (!$loop->last), @endif
        @endforeach
    </div>
</x-layout>

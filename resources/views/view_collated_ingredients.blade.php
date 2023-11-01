<x-layout>
    <a href="{{ route('selections.calendar', [$year, $week]) }}" class="btn btn-primary mb-3">Back to calendar</a>
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

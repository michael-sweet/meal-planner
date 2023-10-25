<x-layout>
    @foreach ($ingredients as $ingredient)
        <div>{{ $ingredient->name }}: {{ $totals[$ingredient->id] }}</div>
    @endforeach
</x-layout>

<x-layout>
    <a href="{{ route('meals.edit', [0]) }}" class="btn btn-primary mb-4"><i class="fa-solid fa-plus me-2"></i>Add meal</a>
    <div class="d-flex flex-wrap flex-column flex-sm-row gap-3">
        @forelse ($meals as $meal)
            <x-meal_card :meal=$meal></x-meal_card>
        @empty
            <p>No meals</p>
        @endforelse
    </div>
</x-layout>

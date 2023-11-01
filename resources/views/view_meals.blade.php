<x-layout>
    <h1 class="mb-3">
        Meals
        <a href="{{ route('meals.edit', [0]) }}" class="ms-2"><i class="fa-solid fa-circle-plus"></i></a>
    </h1>
    <div class="d-flex flex-wrap card-meal-container">
        @foreach ($meals as $meal)
            <div class="card-meal position-relative">
                <div class="card-meal__img-wrap">
                    <img src="{{ asset('storage/' . $meal->image_path) }}" class="card-meal__img" />
                </div>
                <div class="card-meal__body d-flex justify-content-between">
                    <a href="{{ route('meals.view', [$meal->id]) }}" class="stretched-link">
                        <h5 class="card-title">{{ $meal->name }}</h5>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>

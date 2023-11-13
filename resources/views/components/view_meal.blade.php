<x-meal_layout :meal="$meal">
    <h1>{{ $meal->name }}</h1>
    @yield('meal_buttons')
    <p>{{ $meal->description }}</p>
    <h2 class="mt-4">Ingredients</h2>
    @yield('ingredient_buttons')
    @if ($meal_ingredients->isEmpty())
        <p>No ingredients</p>
    @else
    <div class="table-responsive">
        <table class="table table-striped m-0">
            <thead>
                <tr>
                    <th>Ingredient</th>
                    <th>Amount</th>
                    @hasSection('ingredient_actions')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($meal_ingredients as $meal_ingredient)
                <tr>
                    <td>{{ $meal_ingredient->ingredient->name }}</td>
                    <td>{{ $meal_ingredient->amount }} {{ $meal_ingredient->ingredient->unit }}</td>
                    @hasSection('ingredient_actions')
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item icon-link" href="{{ route('meals.ingredients.edit', [$meal->id, $meal_ingredient->id]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <form method="post" action="{{ route('meals.ingredients.delete', [$meal->id, $meal_ingredient->id]) }}" class="m-0">
                                        @csrf
                                        <button class="dropdown-item icon-link js-modal-confirm"
                                            data-modal-title="{{ $meal_ingredient->ingredient->name }}"
                                            data-modal-body="<p><strong>Are you sure you want to delete?</strong></p>"
                                            data-modal-action="Delete"
                                            data-modal-action-class="btn-danger">
                                            <i class="fa-solid fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @yield('bottom_buttons')

    @section('right_container')
        @isset($meal->image_path)
        <img src="{{ asset('storage/' . $meal->image_path) }}" class="img-fluid mt-3 mt-md-0 rounded" />
        @endisset
    @endsection
</x-meal_layout>

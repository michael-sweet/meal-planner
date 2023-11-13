@extends('components.view_meal')

@section('meal_buttons')
    <a href="{{ route('meals.edit', [$meal->id]) }}" class="btn btn-primary my-3 icon-link"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
    <form method="post" action="{{ route('meals.delete', [$meal->id]) }}" class="my-3 d-inline-block">
        @csrf
        <button class="btn btn-secondary icon-link js-modal-confirm"
            data-modal-title="{{ $meal->name }}"
            data-modal-body="<p><strong>Are you sure you want to delete?</strong></p>"
            data-modal-action="Delete"
            data-modal-action-class="btn-danger">
            <i class="fa-solid fa-trash"></i>Delete
        </button>
    </form>
@endsection

@section('ingredient_buttons')
    <a href="{{ route('meals.ingredients.edit', [$meal->id, 0]) }}" class="btn btn-primary my-3 icon-link"><i class="fa-solid fa-plus"></i>Add</a>
@endsection

@section('ingredient_actions', true)

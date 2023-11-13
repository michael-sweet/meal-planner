@extends('components.view_meal')

@section('meal_buttons')
    <form method="post" class="my-3">
        @csrf
        @if ($meal_selection->cooked)
            <button type="submit" class="btn btn-secondary icon-link" name="submitted" value="mark_uncooked"><i class="fa-solid fa-utensils"></i>Mark uncooked</button>
        @else
            <button type="submit" class="btn btn-primary icon-link" name="submitted" value="mark_cooked"><i class="fa-solid fa-utensils"></i>Mark cooked</button>
        @endif
    </form>
@endsection

@section('bottom_buttons')
    <a href="{{ route('selections.calendar', [$meal_selection->year, $meal_selection->week]) }}" class="btn btn-primary mt-4 icon-link">
        <i class="fa-solid fa-arrow-left"></i>Back to calendar
    </a>
@endsection

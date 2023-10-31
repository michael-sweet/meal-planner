<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Models\MealSelection;
use Illuminate\Support\Facades\Auth;

class MealSelections extends Controller
{
    public function calendar(int $year = null, int $week = null)
    {
        $events = [];
        foreach (MealSelection::userSelections() as $selection) {
            $events[] = [
                'title' => $selection->meal->name,
                'start' => Carbon::create($selection->year)->setISODate($selection->year, $selection->week)->toDateString(),
                'meal' => $selection->meal->toArray(),
                'meal_selection_id' => $selection->id,
                'meal_ingredients' => $selection->meal->mealIngredients->load('ingredient')->toArray()
            ];
        }

        $calendar_start = '';
        if ($year && $week) {
            $calendar_start = Carbon::create($year)->setISODate($year, $week)->toDateString();
        }

        return view('calendar', [
            'events' => $events,
            'calendar_start' => $calendar_start
        ]);
    }

    public function viewSelectedMeal(int $selected_meal_id)
    {
        $meal_selection = MealSelection::findOrFail($selected_meal_id);

        return view('view_selected_meal', [
            'meal' => $meal_selection->meal,
            'meal_selection' => $meal_selection,
            'meal_ingredients' => $meal_selection->meal->mealIngredients->load('ingredient')
        ]);
    }

    public function editSelections(int $year, int $week)
    {
        return view('edit_selections', [
            'meals' => Meal::getUserMeals(),
            'selections' => MealSelection::userWeekSelections($year, $week)->pluck('meal_id')
        ]);
    }

    public function editSelectionsAction(int $year, int $week, Request $request)
    {
        switch ($request->submitted) {
            case 'save_selections':
                MealSelection::wipe($year, $week);
                foreach ($request->meal_selections as $selected_meal_id) {
                    $selection = new MealSelection();
                    $selection->year = $year;
                    $selection->week = $week;
                    $selection->meal_id = $selected_meal_id;
                    $selection->user_id = Auth::user()->id;
                    $selection->save();
                }
                return redirect()->route('calendar')->with('success', 'Meal selections saved!');
        }
    }

    public function viewCollatedIngredients(int $year, int $week)
    {
        $week_selections = MealSelection::userWeekSelections($year, $week);
        $ingredients = $week_selections->pluck('meal.ingredients')->flatten()->unique('id');
        $collated_ingredients = Meal::collateIngredients($week_selections->pluck('meal'));
        return view('view_collated_ingredients', [
            'ingredients' => $ingredients,
            'totals' => $collated_ingredients,
            'year' => $year,
            'week' => $week
        ]);
    }
}

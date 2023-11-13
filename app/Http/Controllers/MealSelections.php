<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Models\MealSelection;
use App\Helpers\DateFormatter;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\MealSelectionsMiddleware;

class MealSelections extends Controller
{
    public function __construct()
    {
        $this->middleware(MealSelectionsMiddleware::class);
        view()->share('current_nav', 'meal_selections');
    }

    public function calendar(int $year = null, int $week = null)
    {
        $events = [];
        foreach (MealSelection::userSelections() as $selection) {
            $events[] = [
                'title' => $selection->meal->name,
                'start' => Carbon::create($selection->year)->setISODate($selection->year, $selection->week)->toDateString(),
                'meal' => $selection->meal->toArray(),
                'meal_selection_id' => $selection->id,
                'className' => $selection->cooked ? 'text-decoration-line-through' : 'fw-bold',
                'meal_ingredients' => $selection->meal->getMealIngredients()
            ];
        }

        $calendar_start = '';
        if ($year && $week) {
            $calendar_start = Carbon::create($year)->setISODate($year, $week)->toDateString();
        }

        return view('meal_selections/calendar', [
            'events' => $events,
            'calendar_start' => $calendar_start
        ]);
    }

    public function viewSelectedMeal(int $selected_meal_id)
    {
        $meal_selection = MealSelection::findOrFail($selected_meal_id);

        view()->share('breadcrumbs', [
            ['title' => 'Calendar', 'link' => route('selections.calendar', [$meal_selection->year, $meal_selection->week])],
            ['title' => 'View meal']
        ]);
        return view('meal_selections/view_selected_meal', [
            'meal' => $meal_selection->meal,
            'meal_selection' => $meal_selection,
            'meal_ingredients' => $meal_selection->meal->getMealIngredients()
        ]);
    }

    public function viewSelectedMealAction(Request $request, int $selected_meal_id)
    {
        $meal_selection = MealSelection::findOrFail($selected_meal_id);

        switch ($request->submitted) {
            case 'mark_cooked':
                $meal_selection->cooked = true;
                $meal_selection->save();
                return redirect()->route('selections.meals.view', [$selected_meal_id])->with('success', 'Marked as cooked!');
            case 'mark_uncooked':
                $meal_selection->cooked = false;
                $meal_selection->save();
                return redirect()->route('selections.meals.view', [$selected_meal_id])->with('success', 'Marked as uncooked!');
        }
    }

    public function editSelections(int $year, int $week)
    {
        view()->share('breadcrumbs', [
            ['title' => 'Calendar', 'link' => route('selections.calendar', [$year, $week])],
            ['title' => 'Edit meal selections']
        ]);
        return view('meal_selections/edit_selections', [
            'meals' => Meal::getUserMeals(),
            'selections' => MealSelection::userWeekSelections($year, $week)->pluck('meal_id'),
            'year' => $year,
            'week' => $week,
            'heading' => DateFormatter::formatWeekRange($year, $week)
        ]);
    }

    public function editSelectionsAction(int $year, int $week, Request $request)
    {
        MealSelection::wipe($year, $week);
        foreach ($request->meal_selections ?: [] as $selected_meal_id) {
            $selection = new MealSelection();
            $selection->year = $year;
            $selection->week = $week;
            $selection->meal_id = $selected_meal_id;
            $selection->user_id = Auth::user()->id;
            $selection->save();
        }
        return redirect()->route('selections.calendar', [$year, $week])->with('success', 'Meal selections saved!');
    }

    public function viewCollatedIngredients(int $year, int $week)
    {
        $week_selections = MealSelection::userWeekSelections($year, $week);
        $ingredients = $week_selections->pluck('meal.ingredients')->flatten()->unique('id')->sortBy('name');
        $collated_ingredients = Meal::collateIngredients($week_selections->pluck('meal'));

        view()->share('breadcrumbs', [
            ['title' => 'Calendar', 'link' => route('selections.calendar', [$year, $week])],
            ['title' => 'Ingredients']
        ]);
        return view('meal_selections/view_collated_ingredients', [
            'ingredients' => $ingredients,
            'totals' => $collated_ingredients,
            'year' => $year,
            'week' => $week,
            'heading' => DateFormatter::formatWeekRange($year, $week)
        ]);
    }
}

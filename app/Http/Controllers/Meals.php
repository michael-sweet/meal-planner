<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\MealIngredient;

class Meals extends Controller
{
    public function viewMeals()
    {
        return view('view_meals', [
            'meals' => Meal::paginate(12)
        ]);
    }

    public function viewMeal($id)
    {
        $meal = Meal::findOrNew($id);

        return view('view_meal', [
            'meal' => $meal,
            'meal_ingredients' => $meal->mealIngredients->load('ingredient')
        ]);
    }

    public function editMeal($id)
    {
        $meal = Meal::findOrNew($id);

        return view('edit_meal', [
            'meal' => $meal
        ]);
    }

    public function editMealAction($id, Request $request)
    {
        $meal = Meal::findOrNew($id);

        switch ($request->submitted) {
            case 'edit_meal':
                $meal->name = $request->name;
                if ($request->file('image')) {
                    $meal->image_path = $request->file('image')->storePublicly('meal_images', 'public');
                }
                $meal->save();
                return redirect()->route('view_meal', $meal->id);
        }

        return back();
    }

    public function editMealIngredients($id)
    {
        $meal = Meal::findOrNew($id);

        return view('edit_meal_ingredients', [
            'meal' => $meal,
            'meal_ingredients' => $meal->mealIngredients->load('ingredient'),
            'ingredients' => Ingredient::all()
        ]);
    }

    public function editMealIngredientsAction($id, Request $request)
    {
        $meal = Meal::findOrNew($id);

        switch ($request->submitted) {
                case 'add_ingredient':
                    $ingredient = Ingredient::findOrFail($request->ingredient);

                    $meal_ingredient = new MealIngredient();
                    $meal_ingredient->amount = $request->amount;
                    $meal_ingredient->save();

                    $meal->mealIngredients()->save($meal_ingredient);
                    $ingredient->mealIngredients()->save($meal_ingredient);

                    return redirect()->route('edit_meal_ingredients', $meal->id);

                case 'save_amounts':
                    $meal_ingredients = MealIngredient::findOrFail(array_keys($request->meal_ingredients));
                    foreach ($meal_ingredients as $meal_ingredient) {
                        $meal_ingredient->amount = $request->meal_ingredients[$meal_ingredient->id];
                        $meal_ingredient->save();
                    }
                    return redirect()->route('view_meal', $meal->id);
        }
    }

    public function randomSelection()
    {
        $meals = Meal::getRandomWeek();
        return view('meal_selection', [
            'meals' => $meals,
            'ingredients' => Meal::collateIngredients($meals)
        ]);
    }
}

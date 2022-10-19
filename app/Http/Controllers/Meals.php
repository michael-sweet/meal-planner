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
            'meal' => $meal,
            'meal_ingredients' => $meal->mealIngredients->load('ingredient')
        ]);
    }

    public function editMealAction($id, Request $request)
    {

        $meal = Meal::findOrNew($id);
        $meal->name = $request->name;
        if ($request->file('image')) {
            $meal->image_path = $request->file('image')->storePublicly('meal_images', 'public');
        }
        $meal->save();

        return back();
    }

    public function editMealIngredient($meal_id, $id)
    {
        return view('edit_meal_ingredient', [
            'meal' => Meal::findOrFail($meal_id),
            'meal_ingredient' => MealIngredient::findOrNew($id),
            'ingredients' => Ingredient::all()
        ]);
    }

    public function editMealIngredientAction($meal_id, $id, Request $request)
    {
        $meal = Meal::findOrFail($meal_id);
        $ingredient = Ingredient::findOrFail($request->ingredient);

        $meal_ingredient = MealIngredient::findOrNew($id);
        $meal_ingredient->amount = $request->amount;
        $meal_ingredient->save();

        $meal->mealIngredients()->save($meal_ingredient);
        $ingredient->mealIngredients()->save($meal_ingredient);

        return back();
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

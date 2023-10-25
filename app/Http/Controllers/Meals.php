<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\MealIngredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Meals extends Controller
{
    public function viewMeals()
    {
        return view('view_meals', [
            'meals' => Meal::getUserMeals()
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
                return redirect()->route('view_meal', $meal->id)->with('success', 'Meal saved!');
        }

        return back();
    }

    public function addMealIngredient($meal_id)
    {
        $meal = Meal::findOrFail($meal_id);
        return view('add_meal_ingredient', [
            'meal' => $meal,
            'ingredients' => Ingredient::all()
        ]);
    }

    public function addMealIngredientAction($meal_id, Request $request)
    {
        $meal = Meal::findOrFail($meal_id);
        switch ($request->submitted) {
            case 'add_ingredient':
                $ingredient = Ingredient::findOrFail($request->ingredient_id);

                $meal_ingredient = new MealIngredient();
                $meal_ingredient->amount = $request->amount;
                $meal_ingredient->save();

                $meal->mealIngredients()->save($meal_ingredient);
                $ingredient->mealIngredients()->save($meal_ingredient);

                return redirect()->route('view_meal', $meal->id)->with('success', 'Ingredient added!');

        }
    }

    public function editMealIngredients($id)
    {
        $meal = Meal::findOrFail($id);

        return view('edit_meal_ingredients', [
            'meal' => $meal,
            'meal_ingredients' => $meal->mealIngredients->load('ingredient'),
            'ingredients' => Ingredient::all()
        ]);
    }

    public function editMealIngredientsAction($id, Request $request)
    {
        $meal = Meal::findOrFail($id);

        switch ($request->submitted) {
                case 'save_amounts':
                    $meal_ingredients = MealIngredient::findOrFail(array_keys($request->meal_ingredients));
                    foreach ($meal_ingredients as $meal_ingredient) {
                        $meal_ingredient->amount = $request->meal_ingredients[$meal_ingredient->id];
                        $meal_ingredient->save();
                    }
                    return redirect()->route('view_meal', $meal->id)->with('success', 'Amounts saved!');
        }

        return back();
    }
}

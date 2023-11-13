<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\MealIngredient;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\MealsMiddleware;

class Meals extends Controller
{
    public function __construct()
    {
        $this->middleware(MealsMiddleware::class);
        view()->share('current_nav', 'meals');
    }

    public function viewMeals()
    {
        return view('meals/view_meals', [
            'meals' => Meal::getUserMeals()
        ]);
    }

    public function viewMeal($meal_id)
    {
        $meal = Meal::findOrFail($meal_id);

        view()->share('breadcrumbs', [
            ['title' => 'Meals', 'link' => route('meals', [$meal->id])],
            ['title' => $meal->name]
        ]);
        return view('meals/view_meal', [
            'meal' => $meal,
            'meal_ingredients' => $meal->getMealIngredients()
        ]);
    }

    public function editMeal($meal_id)
    {
        $meal = Meal::findOrNew($meal_id);

        $breadcrumbs = [['title' => 'Meals', 'link' => route('meals')]];
        if ($meal->id) {
            $breadcrumbs[] = ['title' => $meal->name, 'link' => route('meals.view', [$meal->id])];
            $breadcrumbs[] = ['title' => 'Edit meal'];
            $cancel_link = route('meals.view', [$meal->id]);
        } else {
            $breadcrumbs[] = ['title' => 'Add meal'];
            $cancel_link = route('meals');
        }
        view()->share('breadcrumbs', $breadcrumbs);
        return view('meals/edit_meal', [
            'meal' => $meal,
            'cancel_link' => $cancel_link
        ]);
    }

    public function editMealAction($meal_id, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Please enter a name'
        ]);

        $meal = Meal::findOrNew($meal_id);
        $meal->name = $request->name;
        $meal->description = $request->description;
        $meal->user_id = Auth::user()->id;
        if ($request->file('image')) {
            $meal->image_path = $request->file('image')->storePublicly('meal_images/' . Auth::user()->id, 'public');
        }
        $meal->save();
        return redirect()->route('meals.view', $meal->id)->with('success', 'Meal saved!');
    }

    public function editMealIngredient($meal_id, $meal_ingredient_id)
    {
        $meal = Meal::findOrFail($meal_id);
        $meal_ingredient = MealIngredient::findOrNew($meal_ingredient_id);

        view()->share('breadcrumbs', [
            ['title' => 'Meals', 'link' => route('meals', [$meal->id])],
            ['title' => $meal->name, 'link' => route('meals.view', [$meal->id])],
            ['title' => $meal_ingredient->id ? 'Edit meal ingredient' : 'Add meal ingredient']
        ]);
        return view('meals/edit_meal_ingredient', [
            'meal' => $meal,
            'meal_ingredient' => $meal_ingredient,
            'ingredients' => Ingredient::where('user_id', Auth::user()->id)->get()
        ]);
    }

    public function editMealIngredientAction($meal_id, $meal_ingredient_id, Request $request)
    {
        $request->validate([
            'ingredient_id' => 'required',
            'amount' => 'required|integer'
        ], [
            'ingredient_id.required' => 'Please select an ingredient',
            'amount.required' => 'Please enter an amount',
            'amount.integer' => 'Amount must be a number'
        ]);

        $meal = Meal::findOrFail($meal_id);
        $meal_ingredient = MealIngredient::findOrNew($meal_ingredient_id);
        $ingredient = Ingredient::findOrFail($request->ingredient_id);

        $meal_ingredient->amount = $request->amount;
        $meal_ingredient->save();

        $meal->mealIngredients()->save($meal_ingredient);
        $ingredient->mealIngredients()->save($meal_ingredient);

        return redirect()->route('meals.view', $meal->id)->with('success', 'Meal ingredient saved!');
    }

    public function deleteMealAction($meal_id, Request $request)
    {
        $meal = Meal::findOrFail($meal_id);
        $meal->delete();

        return redirect()->route('meals')->with('success', 'Meal deleted!');
    }

    public function deleteMealIngredientAction($meal_id, $meal_ingredient_id, Request $request)
    {
        $meal = Meal::findOrFail($meal_id);
        $meal_ingredient = MealIngredient::findOrFail($meal_ingredient_id);
        $meal_ingredient->delete();

        return redirect()->route('meals.view', [$meal->id])->with('success', 'Meal ingredient deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IngredientsMiddleware;

class Ingredients extends Controller
{
    public function __construct()
    {
        $this->middleware(IngredientsMiddleware::class);
        view()->share('current_nav', 'ingredients');
    }

    public function viewIngredients()
    {
        return view('ingredients/view_ingredients', [
            'ingredients' => Ingredient::where(['user_id' => Auth::user()->id])
                ->with('meals')
                ->orderBy('name')
                ->get()
        ]);
    }

    public function editIngredient($ingredient_id)
    {
        $ingredient = Ingredient::findOrNew($ingredient_id);

        view()->share('breadcrumbs', [
            ['title' => 'Ingredients', 'link' => route('ingredients')],
            ['title' => $ingredient->id ? 'Edit ingredient' : 'Add ingredient']
        ]);
        return view('ingredients/edit_ingredient', [
            'ingredient' => $ingredient
        ]);
    }

    public function editIngredientAction($ingredient_id, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Please enter a name'
        ]);

        $ingredient = Ingredient::findOrNew($ingredient_id);
        $ingredient->name = $request->name;
        $ingredient->unit = $request->unit;
        $ingredient->user_id = Auth::user()->id;
        $ingredient->save();

        return redirect()->route('ingredients')->with('success', 'Ingredient saved!');
    }

    public function deleteIngredientAction($ingredient_id, Request $request)
    {
        $ingredient = Ingredient::findOrFail($ingredient_id);
        $ingredient->delete();

        return redirect()->route('ingredients')->with('success', 'Ingredient deleted!');
    }
}

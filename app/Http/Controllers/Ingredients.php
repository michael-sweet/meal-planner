<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ingredients extends Controller
{
    public function viewIngredients()
    {
        return view('view_ingredients', [
            'ingredients' => Ingredient::where(['user_id' => Auth::user()->id])->with('meals')->get()
        ]);
    }

    public function editIndredient($id)
    {
        return view('edit_ingredient', [
            'ingredient' => Ingredient::findOrNew($id)
        ]);
    }

    public function editIndredientAction($id, Request $request)
    {
        $ingredient = Ingredient::findOrNew($id);
        $ingredient->name = $request->name;
        $ingredient->unit = $request->unit;
        $ingredient->save();

        return redirect()->route('view_ingredients')->with('success', 'Ingredient saved!');
    }
}

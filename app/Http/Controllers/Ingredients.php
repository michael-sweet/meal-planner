<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class Ingredients extends Controller
{
    public function viewIngredients()
    {
        return view('view_ingredients', [
            'ingredients' => Ingredient::all()
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
        $meal = Ingredient::findOrNew($id);
        $meal->name = $request->name;
        $meal->save();

        return back();
    }
}

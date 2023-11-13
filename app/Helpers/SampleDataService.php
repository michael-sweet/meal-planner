<?php

namespace App\Helpers;

use App\Models\Meal;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\MealIngredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SampleDataService
{
    public static function generate($count, User $user)
    {
        $meals = collect(json_decode(Storage::disk('local')->get('sample_meals.json'), true));
        $meals = $meals->random(min($count, $meals->count()));

        $ingredients_added = [];
        foreach ($meals as $meal_array) {
            $meal = new Meal();
            $meal->name = $meal_array['name'];
            $meal->description = $meal_array['description'];
            $meal->image_path = $meal_array['image_path'];
            $meal->user_id = $user->id;
            $meal->save();

            foreach ($meal_array['ingredients'] as $ingredient_array) {
                if (!isset($ingredients_added[$ingredient_array['name']])) {
                    $ingredient = new Ingredient();
                    $ingredient->name = $ingredient_array['name'];
                    $ingredient->unit = $ingredient_array['unit'];
                    $ingredient->user_id = $user->id;
                    $ingredient->save();
                    $ingredients_added[$ingredient->name] = $ingredient->id;
                }
                $meal_ingredient = new MealIngredient();
                $meal_ingredient->amount = $ingredient_array['amount'];
                $meal_ingredient->meal_id = $meal->id;
                $meal_ingredient->ingredient_id = $ingredients_added[$ingredient_array['name']];
                $meal_ingredient->save();
            }
        }
    }
}

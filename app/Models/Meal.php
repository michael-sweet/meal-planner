<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function mealIngredients()
    {
        return $this->hasMany(MealIngredient::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'meal_ingredients');
    }

    public static function getRandomWeek()
    {
        $meals = self::all();
        $now = now();
        srand($now->format('W') * $now->format('Y'));
        return $meals->random(min(7, $meals->count()))->load('mealIngredients.ingredient');
    }

    public static function collateIngredients($meals)
    {
        $ingredients = [];
        foreach ($meals as $meal) {
            foreach ($meal->mealIngredients as $meal_ingredient) {
                if (!isset($ingredients[$meal_ingredient->ingredient->name])) {
                    $ingredients[$meal_ingredient->ingredient->name] = 0;
                }
                $ingredients[$meal_ingredient->ingredient->name] += $meal_ingredient->amount;
            }
        }

        return $ingredients;
    }
}

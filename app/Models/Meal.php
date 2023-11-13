<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meal extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;

    public function mealIngredients()
    {
        return $this->hasMany(MealIngredient::class);
    }

    public function mealSelections()
    {
        return $this->hasMany(MealSelection::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'meal_ingredients');
    }

    public static function getUserMeals(User $user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }

        return Meal::where(['user_id' => $user->id])
            ->with('ingredients')
            ->orderBy('name')
            ->get();
    }

    public function getMealIngredients()
    {
        return $this->mealIngredients->load('ingredient')->filter(function ($meal_ingredient) {
            return $meal_ingredient->ingredient;
        })->sortBy('ingredient.name');
    }

    public static function collateIngredients($meals)
    {
        $ingredients = [];
        foreach ($meals as $meal) {
            foreach ($meal->getMealIngredients() as $meal_ingredient) {
                if (!isset($ingredients[$meal_ingredient->ingredient->id])) {
                    $ingredients[$meal_ingredient->ingredient->id] = 0;
                }
                $ingredients[$meal_ingredient->ingredient->id] += $meal_ingredient->amount;
            }
        }

        return $ingredients;
    }
}

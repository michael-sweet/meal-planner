<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function mealIngredients()
    {
        return $this->hasMany(MealIngredient::class);
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_ingredients');
    }

    public function mealSelections()
    {
        return $this->hasManyThrough(MealSelection::class, Meal::class);
    }
}

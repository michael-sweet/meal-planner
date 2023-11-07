<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;
    use SoftDeletes;
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

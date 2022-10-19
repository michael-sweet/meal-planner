<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\MealIngredient;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = Ingredient::factory()->count(50)->create();
        $meals = Meal::factory()->count(30)->create();
        MealIngredient::factory()
            ->count(100)
            ->create()
            ->each(function ($meal_ingredient) use ($meals, $ingredients) {
                $meals->random()->mealIngredients()->save($meal_ingredient);
                $ingredients->random()->mealIngredients()->save($meal_ingredient);
            });
    }
}

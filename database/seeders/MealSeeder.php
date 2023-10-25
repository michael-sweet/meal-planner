<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\MealIngredient;
use App\Models\User;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = User::latest()->first();
        $ingredients = Ingredient::factory()->count(50)->create(['user_id' => $user_id]);
        $meals = Meal::factory()->count(30)->create(['user_id' => $user_id]);
        MealIngredient::factory()
            ->count(100)
            ->create()
            ->each(function ($meal_ingredient) use ($meals, $ingredients) {
                $meals->random()->mealIngredients()->save($meal_ingredient);
                $ingredients->random()->mealIngredients()->save($meal_ingredient);
            });
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealIngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => random_int(1, 200)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $units = ['g', 'ml', 'teaspoons', 'tablespoons', 'cups', null];

        return [
            'name' => $this->faker->words(3, true),
            'unit' => $units[array_rand($units)]
        ];
    }
}

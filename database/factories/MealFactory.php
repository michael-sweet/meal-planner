<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = Storage::disk('public')->allFiles('meal_images/');
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->text(rand(200, 800)),
            'image_path' => $images[array_rand($images)]
        ];
    }
}

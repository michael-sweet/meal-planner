<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\MealIngredient;
use Illuminate\Support\Facades\Auth;

class Demos extends Controller
{
    public function login()
    {
        return view('demo_login');
    }

    public function loginAction(Request $request)
    {
        switch ($request->submitted) {
            case 'log_in':
                $user = User::factory()->demo()->create();
                if ($request->sample_data) {
                    $ingredients = Ingredient::factory()->count(30)->create(['user_id' => $user->id]);
                    $meals = Meal::factory()->count(15)->create(['user_id' => $user->id]);
                    foreach ($meals as $meal) {
                        MealIngredient::factory()
                            ->count(rand(3, 7))
                            ->create()
                            ->each(function ($meal_ingredient) use ($meal, $ingredients) {
                                $meal->MealIngredients()->save($meal_ingredient);
                                $ingredients->random()->mealIngredients()->save($meal_ingredient);
                            });
                    }
                }
                Auth::login($user);

                return redirect()->route('selections.calendar')->with('success', 'Welcome, ' . $user->name . '!');
        }
    }

    public function logoutAction(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

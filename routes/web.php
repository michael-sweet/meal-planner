<?php

use App\Http\Controllers\Meals;
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Auth\Demos;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Ingredients;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealSelections;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (App::environment('demo')) {
    Route::get('/login', [Demos::class, 'login'])->name('login');
    Route::post('/login', [Demos::class, 'loginAction']);
    Route::post('/logout', [Demos::class, 'logoutAction'])->name('logout');
} else {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
        'confirm' => false
    ]);
}

Route::middleware(['auth'])->group(function () {

    Route::get('/', [MealSelections::class, 'calendar']);
    Route::get('/selections/calendar/{year?}/{week?}', [MealSelections::class, 'calendar'])->name('selections.calendar');
    Route::get('/selections/edit/{year}/{week}', [MealSelections::class, 'editSelections'])->name('selections.edit');
    Route::post('/selections/edit/{year}/{week}', [MealSelections::class, 'editSelectionsAction']);
    Route::get('/selections/view_ingredients/{year}/{week}', [MealSelections::class, 'viewCollatedIngredients'])->name('selections.view_ingredients');
    Route::get('/selections/meals/view/{selected_meal_id}', [MealSelections::class, 'viewSelectedMeal'])->name('selections.meals.view');
    Route::post('/selections/meals/view/{selected_meal_id}', [MealSelections::class, 'viewSelectedMealAction']);

    Route::get('/meals', [Meals::class, 'viewMeals'])->name('meals');
    Route::get('/meals/view/{meal_id}', [Meals::class, 'viewMeal'])->name('meals.view');
    Route::get('/meals/edit/{meal_id}', [Meals::class, 'editMeal'])->name('meals.edit');
    Route::post('/meals/edit/{meal_id}', [Meals::class, 'editMealAction']);
    Route::post('/meals/delete/{meal_id}', [Meals::class, 'deleteMealAction'])->name('meals.delete');
    Route::get('/meals/ingredients/edit/{meal_id}/{meal_ingredient_id}', [Meals::class, 'editMealIngredient'])->name('meals.ingredients.edit');
    Route::post('/meals/ingredients/edit/{meal_id}/{meal_ingredient_id}', [Meals::class, 'editMealIngredientAction']);
    Route::post('/meals/ingredients/delete/{meal_id}/{meal_ingredient_id}', [Meals::class, 'deleteMealIngredientAction'])->name('meals.ingredients.delete');

    Route::get('/ingredients', [Ingredients::class, 'viewIngredients'])->name('ingredients');
    Route::get('/ingredients/edit/{ingredient_id}', [Ingredients::class, 'editIngredient'])->name('ingredients.edit');
    Route::post('/ingredients/edit/{ingredient_id}', [Ingredients::class, 'editIngredientAction']);
    Route::post('/ingredients/delete/{ingredient_id}', [Ingredients::class, 'deleteIngredientAction'])->name('ingredients.delete');

    Route::get('/users/edit', [Users::class, 'edit'])->name('users.edit');
    Route::post('/users/edit', [Users::class, 'editAction']);
});

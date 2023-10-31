<?php

use App\Http\Controllers\Demos;
use App\Http\Controllers\Meals;
use Illuminate\Support\Facades\App;
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
    Route::get('/login/', [Demos::class, 'login'])->name('login');
    Route::post('/login/', [Demos::class, 'loginAction']);
    Route::post('/logout/', [Demos::class, 'logoutAction'])->name('logout');
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
    Route::get('/calendar/{year?}/{week?}', [MealSelections::class, 'calendar'])->name('calendar');
    Route::get('/edit_selections/{year}/{week}/', [MealSelections::class, 'editSelections'])->name('edit_selections');
    Route::post('/edit_selections/{year}/{week}/', [MealSelections::class, 'editSelectionsAction']);
    Route::get('/view_collated_ingredients/{year}/{week}/', [MealSelections::class, 'viewCollatedIngredients'])->name('view_collated_ingredients');
    Route::get('/view_selected_meal/{selected_meal_id}/', [MealSelections::class, 'viewSelectedMeal'])->name('view_selected_meal');

    Route::get('/meals', [Meals::class, 'viewMeals'])->name('view_meals');
    Route::get('/view_meal/{id}/', [Meals::class, 'viewMeal'])->name('view_meal');
    Route::get('/edit_meal/{id}/', [Meals::class, 'editMeal'])->name('edit_meal');
    Route::post('/edit_meal/{id}/', [Meals::class, 'editMealAction']);
    Route::get('/edit_meal_ingredients/{id}/', [Meals::class, 'editMealIngredients'])->name('edit_meal_ingredients');
    Route::post('/edit_meal_ingredients/{id}/', [Meals::class, 'editMealIngredientsAction']);
    Route::get('/add_meal_ingredient/{id}/', [Meals::class, 'AddMealIngredient'])->name('add_meal_ingredient');
    Route::post('/add_meal_ingredient/{id}/', [Meals::class, 'AddMealIngredientAction']);

    Route::get('/ingredients/', [Ingredients::class, 'viewIngredients'])->name('view_ingredients');
    Route::get('/edit_ingredient/{id}/', [Ingredients::class, 'editIndredient'])->name('edit_ingredient');
    Route::post('/edit_ingredient/{id}/', [Ingredients::class, 'editIndredientAction']);

});

<?php

use App\Http\Controllers\Ingredients;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Meals;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/meals/', [Meals::class, 'viewMeals'])->name('view_meals');
Route::get('/view_meal/{id}/', [Meals::class, 'viewMeal'])->name('view_meal');
Route::get('/edit_meal/{id}/', [Meals::class, 'editMeal'])->name('edit_meal');
Route::post('/edit_meal/{id}/', [Meals::class, 'editMealAction']);
Route::get('/edit_meal_ingredients/{id}/', [Meals::class, 'editMealIngredients'])->name('edit_meal_ingredients');
Route::post('/edit_meal_ingredients/{id}/', [Meals::class, 'editMealIngredientsAction']);

Route::get('/ingredients/', [Ingredients::class, 'viewIngredients'])->name('view_ingredients');
Route::get('/edit_ingredient/{id}/', [Ingredients::class, 'editIndredient'])->name('edit_ingredient');
Route::post('/edit_ingredient/{id}/', [Ingredients::class, 'editIndredientAction']);

Route::get('/random_selection/', [Meals::class, 'randomSelection']);

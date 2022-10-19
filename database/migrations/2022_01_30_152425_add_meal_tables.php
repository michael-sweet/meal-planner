<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Meal;
use App\Models\Ingredient;

class AddMealTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('meal_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Meal::class)->default(0);
            $table->foreignIdFor(Ingredient::class)->default(0);
            $table->integer('amount');
        });
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meals');
        Schema::drop('meal_ingredients');
        Schema::drop('ingredients');
    }
}

<?php

use App\Models\Meal;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMealSelectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_selections', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('week');
            $table->foreignIdFor(Meal::class)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_selections');
    }
}

<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->default(0);
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->default(0);
        });
        Schema::table('meal_selections', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('meal_selections', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletedColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('meals', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('meals', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}

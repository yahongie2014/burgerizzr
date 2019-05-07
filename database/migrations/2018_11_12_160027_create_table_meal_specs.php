<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMealSpecs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mealspecs_relation', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meal_id');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->unsignedInteger('specs_id');
            $table->foreign('specs_id')->references('id')->on('meals_specs')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MealSpecs');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTablePotatoesMeal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PotatoesMeal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('potatoes_id');
            $table->foreign('potatoes_id')->references('id')->on('potatoes')->onDelete('cascade');
            $table->unsignedInteger('meal_type');
            $table->unsignedInteger('meal_price_id');
            $table->foreign('meal_price_id')->references('id')->on('meal_price')->onDelete('cascade');
            $table->foreign('meal_type')->references('id')->on('meal_price')->onDelete('cascade');
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
        Schema::dropIfExists('PotatoesMeal');
    }
}

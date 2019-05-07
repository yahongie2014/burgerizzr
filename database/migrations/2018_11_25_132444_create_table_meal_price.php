<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMealPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_price', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('size',array(["s","m","l","xl"]))->index();
            $table->string('image');
            $table->unsignedInteger('meal_id');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->float('price',13,2);
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
        Schema::dropIfExists('meal_price');
    }
}

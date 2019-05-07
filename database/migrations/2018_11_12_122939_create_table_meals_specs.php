<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMealsSpecs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals_specs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cover_img');
            $table->enum('size',array(["s","m","l","xl"]))->index();
            $table->float('calories',13,2);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('meals_specs');
    }
}

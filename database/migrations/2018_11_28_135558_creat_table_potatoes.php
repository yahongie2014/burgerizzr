<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTablePotatoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potatoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cover_img');
            $table->enum('size',array(["s","m","l","xl"]))->index();
            $table->enum('type',array(["n","s"]))->index();
            $table->float('calories', 13, 2);
            $table->float('price', 13, 2);
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
        Schema::dropIfExists('potatoes');
    }
}

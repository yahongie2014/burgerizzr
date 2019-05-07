<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMeals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(1);
            $table->string('type');
            $table->string('cover_img');
            $table->string('main_image');
            $table->float('calories',13,2);
            $table->unsignedInteger('is_drink')->default(0);
            $table->unsignedInteger('menu_type_id');
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
        Schema::dropIfExists('meals');

    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenuType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        Schema::table('meals', function (Blueprint $table) {
            $table->foreign('menu_type_id')->references('id')->on('menu_type')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("menu_type");
    }
}

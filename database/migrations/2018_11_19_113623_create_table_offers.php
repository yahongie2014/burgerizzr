<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('path');
            $table->string('banner');
            $table->enum('type',array(1,2));
            $table->integer('status')->default(1);
            $table->integer('delivery')->default(0);
            $table->integer('takeaway')->default(0);
            $table->integer('restaurant')->default(0);
            $table->dateTime('start_in');
            $table->dateTime('end_in');
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
        Schema::dropIfExists("offers");
    }
}

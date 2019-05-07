<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->double('percentage',13,9);
            $table->string('code');
            $table->dateTime('start_in');
            $table->dateTime('end_in');
            $table->timestamps();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('promo_id')->references('id')->on('promo_codes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
}

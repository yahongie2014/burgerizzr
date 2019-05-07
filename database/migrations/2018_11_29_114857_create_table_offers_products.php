<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOffersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->unsignedInteger('meal_id');
            $table->unsignedInteger('gift_id');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('gift_id')->references('id')->on('meals')->onDelete('cascade');
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
        Schema::dropIfExists('table_offers_products');
    }
}

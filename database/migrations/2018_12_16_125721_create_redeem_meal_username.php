<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemMealUsername extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_meal_username', function (Blueprint $table) {
            $table->increments('id');
            $table->string('buyer_name');
            $table->string('meal_name');
            $table->unsignedInteger('redeem_checkout_id');
            $table->foreign('redeem_checkout_id')->references('id')->on('redeem_checkout')->onDelete('cascade');
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
        Schema::dropIfExists('table_redeem_meal_username');
    }
}

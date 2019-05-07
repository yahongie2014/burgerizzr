<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeliveryFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fixed_price');
            $table->string('offer_price');
            $table->enum('type',array(['fees','free']));
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
        Schema::dropIfExists('delivery_fees');
    }
}

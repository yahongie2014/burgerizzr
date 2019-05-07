<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemCheckout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_checkout', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status',array(1,2,3,4,5,6))->default(1)->comment('1 : ORDER_REQUEST , 2 : ORDER_PAID, 3 : ORDER_ACCEPTED, 4 : ORDER_PERPARED, 5 : ORDER_IN_DELIVERY, 6 : ORDER_DELVERID');
            $table->enum('delivery_type',array(1,2,3))->default(1)->comment('1 : IN_BRANCH , 2 : IN_DELIVERY,3: TAKE_WAY');
            $table->integer('branch_id');
            $table->integer('redeem_number');
            $table->integer('points');
            $table->longText('meal_name_user');
            $table->float('order_long',13,9);
            $table->float('order_lat',13,9);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('table_redeem_checkout');
    }
}

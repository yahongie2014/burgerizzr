<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('card_number');
            $table->string('payment_option');
            $table->string('expiry_date');
            $table->string('customer_ip');
            $table->integer('status');
            $table->integer('payment_status');
            $table->string('fort_id');
            $table->string('signature');
            $table->double('amount',13,2);
            $table->string('order_number');
            $table->string('currency');
            $table->text('authorization_code');
            $table->text('order_description');
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
        Schema::dropIfExists('payments');
    }
}

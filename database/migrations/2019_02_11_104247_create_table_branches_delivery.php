<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBranchesDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches_delivery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fixed_price');
            $table->integer('offer_price');
            $table->string('type');
            $table->unsignedInteger('branches_id');
            $table->dateTime('start_in');
            $table->dateTime('end_in');
            $table->foreign('branches_id')->references('id')->on('branches')->onDelete('cascade');
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
        Schema::dropIfExists('table_branches_delivery');
    }
}

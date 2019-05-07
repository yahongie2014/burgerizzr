<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBranches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('path');
            $table->text('address');
            $table->float('longitude',13,9);
            $table->float('latitudes',13,9);
            $table->unsignedInteger('area_id');
            $table->integer('is_delivery_status')->default(0);
            $table->foreign('area_id')->references('id')->on('area')->onDelete('cascade');
            $table->integer('status')->default(0)->comment('0 : BRANCH_INACTIVE , 1 : BRANCH_ACTIVE');
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
        Schema::dropIfExists('branches');
    }
}

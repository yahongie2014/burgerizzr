<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnRegisterUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('un_register_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blocked')->default(0);
            $table->enum('device_type',array("android","ios"))->default("android");
            $table->string('device_token')->nullable();
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
        Schema::dropIfExists('un_register_user');
    }
}

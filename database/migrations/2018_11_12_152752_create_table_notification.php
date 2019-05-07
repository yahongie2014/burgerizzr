<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status',array(1,2,3,4,5))->default(1)->comment('1 : PENDING_ORDER , 2 : ORDER_RECEIVED, 3 : ORDER_PEPPERED, 4 : ORDER_COMPLETED, 5 : OFFERS');
            $table->unsignedInteger('user_id');
            $table->longText('message');
            $table->integer('is_read')->default(0);
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
        Schema::dropIfExists("notifications");
    }
}

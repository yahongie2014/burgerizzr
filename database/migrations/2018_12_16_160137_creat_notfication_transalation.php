<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatNotficationTransalation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('message');
            $table->unsignedInteger('notification_id');
            $table->enum('locale', array(["en", "ar"]))->index();
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
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
        Schema::dropIfExists('notifications_transalation');
    }
}

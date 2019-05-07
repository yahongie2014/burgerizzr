<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenuTypeTransalation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('menu_type_id');
            $table->enum('locale',array(["en","ar"]))->index();
            $table->foreign('menu_type_id')->references('id')->on('menu_type')->onDelete('cascade');
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
        Schema::dropIfExists('menu_type_translations');
    }
}

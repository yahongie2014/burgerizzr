<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAreaTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('area_id');
            $table->enum('locale',array(["en","ar"]))->index();
            $table->foreign('area_id')->references('id')->on('area')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('area_translation');

    }
}

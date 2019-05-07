<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCitiesTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('city_id');
            $table->enum('locale',array(["en","ar"]))->index();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('cities_translations');
    }
}

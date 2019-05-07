<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMealsSpecsTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals_specs_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('extra_info');
            $table->enum('locale',array(["en","ar"]))->index();
            $table->unsignedInteger('meals_spec_id');
            $table->foreign('meals_spec_id')->references('id')->on('meals_specs')->onDelete('cascade');
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
        Schema::dropIfExists('meals_specs_translation');
    }
}

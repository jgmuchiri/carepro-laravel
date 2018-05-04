<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('child_id');
            $table->foreign('child_id')->references('id')->on('children');
            $table->string('name');
            $table->string('remarks');
            $table->string('preffered_time');
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
        Schema::dropIfExists('food_preferences');
    }
}

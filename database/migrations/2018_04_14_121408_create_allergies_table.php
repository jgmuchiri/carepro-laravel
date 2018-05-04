<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('child_id');
            $table->foreign('child_id')->references('id')->on('children');
            $table->string('name');
            $table->string('remarks');
            $table->string('treatment');
            $table->date('date_first_noted');
            $table->date('last_event_date');
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
        Schema::dropIfExists('allergies');
    }
}

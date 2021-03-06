<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->string('witnesses', 8000)->nullable();
            $table->text('action_taken')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('created_by_user_id')->unsigned();
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->integer('location_id')->unsigned()->nullable();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->tinyInteger('note_type_id')->unsigned();
            $table->foreign('note_type_id')->references('id')->on('note_types');
            $table->integer('incident_type_id')->unsigned()->nullable();
            $table->foreign('incident_type_id')->references('id')->on('incident_types');
            $table->timestamp('incident_time')->nullable();
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
        Schema::drop('notes');
    }
}

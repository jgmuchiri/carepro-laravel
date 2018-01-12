<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesToPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes_to_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('note_id', false, true);
            $table->foreign('note_id')->references('id')->on('notes');
            $table->string('photo_uri');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notes_to_photos');
    }
}

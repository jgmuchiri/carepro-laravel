<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesToChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes_to_children', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('note_id', false, true);
            $table->foreign('note_id')->references('id')->on('notes');
            $table->integer('child_id', false, true);
            $table->foreign('child_id')->references('id')->on('children');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['note_id', 'child_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notes_to_children');
    }
}

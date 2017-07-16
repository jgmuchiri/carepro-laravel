<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenToParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_to_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_id')->unsigned();
            $table->foreign('child_id')->references('id')->on('children');
            $table->integer('parent_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('parents');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['child_id', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('children_to_parents');
    }
}

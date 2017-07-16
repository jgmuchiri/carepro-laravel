<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsToChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_to_children', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id', false, true);
            $table->foreign('group_id')->references('id')->on('groups');
            $table->integer('child_id', false, true);
            $table->foreign('child_id')->references('id')->on('children');
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
        Schema::dropIfExists('groups_to_children');
    }
}

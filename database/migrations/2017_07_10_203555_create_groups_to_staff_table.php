<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsToStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_to_staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id', false, true);
            $table->foreign('group_id')->references('id')->on('groups');
            $table->integer('staff_id', false, true);
            $table->foreign('staff_id')->references('id')->on('staff');
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
        Schema::dropIfExists('groups_to_staff');
    }
}

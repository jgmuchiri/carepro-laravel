<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('check_in_date');
            $table->dateTime('check_out_date')->nullable();
            $table->integer('check_in_pickup_user_id', false, true)->nullable();
            $table->foreign('check_in_pickup_user_id')->references('id')->on('pickup_users');
            $table->integer('check_out_pickup_user_id', false, true)->nullable();
            $table->foreign('check_out_pickup_user_id')->references('id')->on('pickup_users');
            $table->integer('check_in_parent_id', false, true)->nullable();
            $table->foreign('check_in_parent_id')->references('id')->on('parents');
            $table->integer('check_out_parent_id', false, true)->nullable();
            $table->foreign('check_out_parent_id')->references('id')->on('parents');
            $table->integer('child_id', false, true);
            $table->foreign('child_id')->references('id')->on('users');
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
        Schema::drop('attendance');
    }
}

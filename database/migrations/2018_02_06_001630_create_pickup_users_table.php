<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickupUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('child_id');
            $table->foreign('child_id')->references('id')->on('children');
            $table->unsignedInteger('relation_id');
            $table->foreign('relation_id')->references('id')->on('relations');
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('pin', 50);
            $table->string('photo_uri', 2083);
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
        Schema::dropIfExists('pickup_users');
    }
}

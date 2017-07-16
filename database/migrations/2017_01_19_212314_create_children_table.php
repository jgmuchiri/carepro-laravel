<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('nickname', 50);
            $table->string('ssn', 10);
            $table->date('dob');
            $table->tinyInteger('gender_id', false, true);
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->tinyInteger('blood_type_id', false, true);
            $table->foreign('blood_type_id')->references('id')->on('blood_types');
            $table->integer('pin');
            $table->string('photo', 255)->nullable();
            $table->tinyInteger('status_id', false, true);
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('created_by_user_id', false, true);
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->integer('updated_by_user_id', false, true);
            $table->foreign('updated_by_user_id')->references('id')->on('users');
            $table->tinyInteger('religion_id', false, true)->nullable();
            $table->foreign('religion_id')->references('id')->on('religions');
            $table->tinyInteger('ethnicity_id', false, true)->nullable();
            $table->foreign('ethnicity_id')->references('id')->on('ethnicities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('children');
    }
}

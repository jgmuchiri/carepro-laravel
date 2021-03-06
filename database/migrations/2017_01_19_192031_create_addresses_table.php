<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table){
            $table->increments('id');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('phone', 10);
            $table->integer('city_id', false, true);
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('state_id', false, true);
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('zip_code_id', false, true);
            $table->foreign('zip_code_id')->references('id')->on('zip_codes');
            $table->smallInteger('country_id', false, true);
            $table->foreign('country_id')->references('id')->on('countries');
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
        Schema::drop('addresses');
    }
}

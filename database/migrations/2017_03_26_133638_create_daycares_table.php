<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaycaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daycares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('address_id', false, true);
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->string('employee_tax_identifier');
            $table->integer('owner_user_id', false, true);
            $table->foreign('owner_user_id')->references('id')->on('users');
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
        Schema::drop('daycares');
    }
}

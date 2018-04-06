<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('child_id');
            $table->foreign('child_id')->references('id')->on('children');
            $table->unsignedInteger('health_provider_role_id');
            $table->foreign('health_provider_role_id')->references('id')->on('health_provider_roles');
            $table->unsignedInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->string('name');
            $table->string('remarks', 4000);
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
        Schema::dropIfExists('health_providers');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_to_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id', false, true);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->integer('permission_id', false, true);
            $table->foreign('permission_id')->references('id')->on('permissions');
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
        Schema::dropIfExists('roles_to_permissions');
    }
}

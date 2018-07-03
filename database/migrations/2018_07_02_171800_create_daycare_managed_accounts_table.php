<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaycareManagedAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daycare_managed_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('daycare_id', false, true)->unique();
            $table->foreign('daycare_id')->references('id')->on('daycares');
            $table->string('stripe_managed_account_id')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('stripe_publishable_key')->nullable();
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
        Schema::dropIfExists('daycare_managed_accounts');
    }
}

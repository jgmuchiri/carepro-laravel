<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableAddStripeManagedAccountColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_managed_account_id');
            $table->string('stripe_secret_key');
            $table->string('stripe_publishable_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['stripe_managed_account_id', 'stripe_secret_key', 'stripe_publishable_key']);
        });
    }
}

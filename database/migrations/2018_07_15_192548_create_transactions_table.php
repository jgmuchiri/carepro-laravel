<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id')->nullable();
            $table->unsignedInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->string('amount');
            $table->unsignedInteger('transaction_types_id');
            $table->foreign('transaction_types_id')->references('id')->on('transaction_types');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('daycare_id');
            $table->foreign('daycare_id')->references('id')->on('daycares');
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
        Schema::dropIfExists('transactions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlansTableAddEditableFeatureColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->tinyInteger('number_of_children_allowed')->default(10);
            $table->tinyInteger('number_of_staff_allowed')->default(1);
            $table->boolean('has_invoice_due_alert_to_parents')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn(['number_of_children_allowed','number_of_staff_allowed', 'has_invoice_due_alert_to_parents']);
        });
    }
}

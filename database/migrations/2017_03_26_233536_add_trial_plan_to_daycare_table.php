<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrialPlanToDaycareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daycares', function (Blueprint $table) {
            $table->tinyInteger('trial_plan_id', false, true)->after('trial_ends_at')->nullable();
            $table->foreign('trial_plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daycares', function ($table) {
            $table->dropForeign(['trial_plan_id']);
            $table->dropColumn('trial_plan_id');
        });
    }
}

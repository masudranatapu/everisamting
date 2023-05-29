<?php

use Modules\Plan\Entities\Plan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUserPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_plans', function (Blueprint $table) {
            // Recurring payment plan
            $table->enum('subscription_type', ['one_time', 'recurring'])->default('one_time');
            $table->date('expired_date')->nullable();
            $table->foreignIdFor(Plan::class, 'current_plan_id')->nullable()->constrained('plans')->cascadeOnDelete();
            $table->boolean('is_restored_plan_benefits')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_plans', function (Blueprint $table) {
            //
        });
    }
}

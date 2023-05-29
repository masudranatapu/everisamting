<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPushNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('push_notification_status')->default(true);
            $table->string('server_key')->nullable();
            $table->string('api_key')->nullable();
            $table->string('auth_domain')->nullable();
            $table->string('project_id')->nullable();
            $table->string('storage_bucket')->nullable();
            $table->string('messaging_sender_id')->nullable();
            $table->string('app_id')->nullable();
            $table->string('measurement_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileAppConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_app_configs', function (Blueprint $table) {
            $table->id();
            $table->string('android_download_url')->nullable();
            $table->string('ios_download_url')->nullable();
            $table->string('privacy_url')->nullable();
            $table->string('support_url')->nullable();
            $table->string('terms_and_condition_url')->nullable();
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
        Schema::dropIfExists('mobile_app_configs');
    }
}

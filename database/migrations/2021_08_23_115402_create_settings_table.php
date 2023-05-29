<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_image')->nullable();
            $table->string('white_logo')->nullable();
            $table->string('favicon_image')->nullable();
            $table->string('header_css')->nullable();
            $table->string('header_script')->nullable();
            $table->string('body_script')->nullable();
            $table->string('sidebar_color')->nullable();
            $table->string('nav_color')->nullable();
            $table->string('sidebar_txt_color')->nullable();
            $table->string('nav_txt_color')->nullable();
            $table->string('main_color')->nullable();
            $table->string('accent_color')->nullable();
            $table->string('frontend_primary_color')->nullable();
            $table->string('frontend_secondary_color')->nullable();
            $table->boolean('dark_mode')->default(false);
            $table->boolean('default_layout')->default(true);
            $table->boolean('language_changing')->default(true);
            $table->boolean('email_verification')->default(false);
            $table->boolean('watermark_status')->default(false);
            $table->enum('watermark_type', ['text', 'image'])->default('text');
            $table->string('watermark_text')->default('ZakirSoft');
            $table->string('watermark_image')->default('frontend/images/logo.png');
            
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
        Schema::dropIfExists('settings');
    }
}

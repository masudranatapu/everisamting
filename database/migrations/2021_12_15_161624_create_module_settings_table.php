<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('blog')->default(true);
            $table->boolean('newsletter')->default(true);
            $table->boolean('language')->default(true);
            $table->boolean('contact')->default(true);
            $table->boolean('faq')->default(true);
            $table->boolean('testimonial')->default(true);
            $table->boolean('price_plan')->default(true);
            $table->boolean('appearance')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_settings');
    }
}

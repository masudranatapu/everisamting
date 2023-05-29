<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMapToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->enum('default_map', ['google-map', 'map-box'])->default('google-map');
            $table->string('google_map_key')->nullable();
            $table->string('map_box_key')->nullable();
            $table->double('default_long')->default('-100');
            $table->double('default_lat')->default('40');
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

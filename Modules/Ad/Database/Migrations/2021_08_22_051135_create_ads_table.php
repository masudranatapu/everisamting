<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->float('price');
            $table->longText('description');
            $table->string('phone')->nullable();
            $table->boolean('show_phone')->default(true);
            $table->string('phone_2')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['active', 'sold', 'pending', 'declined'])->default('active');
            $table->boolean('featured')->default(false);
            $table->integer('total_reports')->default(0);
            $table->integer('total_views')->default(0);
            $table->boolean('is_blocked')->default(false);
            $table->date('drafted_at')->nullable();
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
        Schema::dropIfExists('ads');
    }
}

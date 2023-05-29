<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('order_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->double('amount', 8, 2)->nullable();
            $table->text('address')->nullable();
            $table->string('status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->integer('plan_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('number', 16)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->enum('payment_status', ['1', '2', '3'])->comment('1=Waiting for payment, 2=Already paid, 3=Expired')->nullable();
            $table->string('snap_token', 36)->nullable();
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
        Schema::dropIfExists('orders');
    }
}

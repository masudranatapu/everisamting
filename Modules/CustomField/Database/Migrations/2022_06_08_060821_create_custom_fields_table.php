<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\CustomField\Entities\CustomFieldGroup;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CustomFieldGroup::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->enum('type', ['text', 'textarea', 'select', 'radio', 'file', 'url', 'number', 'date', 'checkbox', 'checkbox_multiple']);
            $table->boolean('required')->default(false);
            $table->boolean('filterable')->default(false);
            $table->boolean('listable')->default(false);
            $table->string('icon')->default('fas fa-cube');
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('custom_fields');
    }
}

<?php

use Modules\Ad\Entities\Ad;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Entities\CustomFieldGroup;

class CreateProductCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ad::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CustomField::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CustomFieldGroup::class)->constrained()->cascadeOnDelete();
            $table->string('value');
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
        Schema::dropIfExists('product_custom_fields');
    }
}

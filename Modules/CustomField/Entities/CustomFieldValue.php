<?php

namespace Modules\CustomField\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;

class CustomFieldValue extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\CustomField\Database\factories\CustomFieldValueFactory::new();
    }

    public function field()
    {
        return $this->belongsTo(CustomField::class, 'custom_field_id', 'id');
    }
}

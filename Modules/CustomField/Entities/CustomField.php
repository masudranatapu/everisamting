<?php

namespace Modules\CustomField\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CustomField\Entities\CustomFieldGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;

class CustomField extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\CustomField\Database\factories\CustomFieldFactory::new();
    }

    public function values()
    {
        return $this->hasMany(CustomFieldValue::class, 'custom_field_id');
    }

    public function customFieldGroup()
    {
        return $this->belongsTo(CustomFieldGroup::class, 'custom_field_group_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_custom_field')->withPivot('order')->oldest('order');
    }
}

<?php

namespace Modules\CustomField\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Modules\CustomField\Entities\CustomField;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomFieldGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'order'];

    protected static function newFactory()
    {
        return \Modules\CustomField\Database\factories\CustomFieldGroupFactory::new();
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function customFields()
    {
        return $this->hasMany(CustomField::class, 'custom_field_group_id');
    }
}

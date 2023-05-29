<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog',
        'newsletter',
        'language',
        'contact',
        'faq',
        'testimonial',
        'price_plan',
        'appearance',
    ];

    public $timestamps = false;
}

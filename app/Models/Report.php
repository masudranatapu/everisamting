<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_from_id',
        'report_to_id',
        'reason',
    ];

    public function reportFrom()
    {
        return $this->belongsTo(User::class, 'report_from_id');
    }

    public function reportTo()
    {
        return $this->belongsTo(User::class, 'report_to_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessClaim extends Model
{
    use HasFactory;
    protected $table = 'business_claim';

    public function ad()
    {
        return $this->belongsTo(BusinessDirectory::class, 'ad_id');
    }



}

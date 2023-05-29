<?php

namespace Modules\Ad\Entities;

use Modules\Ad\Entities\Ad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdFeature extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Ad\Database\factories\AdFeatureFactory::new();
    }



    /**
     *  Belongs To
     * @return BelongsTo|Collection|Feature[]
     */
    function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }

    public function ads()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}

<?php

namespace Modules\Ad\Actions;

use Modules\Ad\Entities\Ad;

class CreateAd
{
    public static function create($request)
    {
        return Ad::create($request);
    }
}

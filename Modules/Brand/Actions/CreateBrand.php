<?php

namespace Modules\Brand\Actions;

use Modules\Brand\Entities\Brand;

class CreateBrand
{
    public static function create($request)
    {
        return Brand::create($request->all());
    }
}

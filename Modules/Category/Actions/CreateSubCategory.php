<?php

namespace Modules\Category\Actions;

use Modules\Category\Entities\SubCategory;

class CreateSubCategory
{
    public static function create($request)
    {
        return SubCategory::create($request->all());
    }
}

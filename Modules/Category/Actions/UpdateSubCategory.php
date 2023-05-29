<?php

namespace Modules\Category\Actions;

class UpdateSubCategory
{
    public static function update($request, $subcategory)
    {
        return $subcategory->update($request->all());
    }
}

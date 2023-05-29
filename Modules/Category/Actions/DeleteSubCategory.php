<?php

namespace Modules\Category\Actions;

class DeleteSubCategory
{
    public static function delete($subcategory)
    {
        return $subcategory->delete();
    }
}

<?php

namespace Modules\Category\Actions;

class DeleteCategory
{
    public static function delete($category)
    {
        $categoryImage = file_exists($category->image);

        if ($categoryImage) {
            deleteImage($category->image);
        }

        return $category->delete();
    }
}

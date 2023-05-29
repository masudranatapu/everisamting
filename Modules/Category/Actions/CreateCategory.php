<?php

namespace Modules\Category\Actions;

use Modules\Category\Entities\Category;

class CreateCategory
{
    public static function create($request)
    {
        $category = Category::create($request->except(['image']));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = $request->image->move('uploads/category',$request->image->hashName());
            $category->update(['image' => $url]);
        }

        return $category;
    }
}

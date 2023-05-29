<?php

namespace Modules\Category\Actions;

class UpdateCategory
{
    public static function update($request, $category)
    {
        $category->update($request->except('image'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteImage($category->image);
            $url = $request->image->move('uploads/category',$request->image->hashName());
            $category->update(['image' => $url]);
        }

        return $category;
    }
}

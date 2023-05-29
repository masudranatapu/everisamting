<?php

namespace Modules\Blog\Actions;

class UpdatePost
{
    public static function update($request, $post)
    {
        $post->update($request->except(['image']));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteImage($post->image);
            $url = $request->image->move('uploads/post',$request->image->hashName());
            $post->update(['image' => $url]);
        }

        return $post;
    }
}

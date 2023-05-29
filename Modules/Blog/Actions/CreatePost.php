<?php

namespace Modules\Blog\Actions;

use Modules\Blog\Entities\Post;

class CreatePost
{
    public static function create($request)
    {
        $post = Post::create($request->except(['image']));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = $request->image->move('uploads/post',$request->image->hashName());
            $post->update(['image' => $url]);
        }

        return $post;
    }
}

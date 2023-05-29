<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\Entities\Post;
use Illuminate\Routing\Controller;
use Modules\Blog\Actions\CreatePost;
use Modules\Blog\Actions\DeletePost;
use Modules\Blog\Actions\UpdatePost;
use Modules\Blog\Entities\PostCategory;
use Modules\Blog\Http\Requests\PostFormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BlogController extends Controller
{
    use ValidatesRequests;

    public function __construct()
    {
        abort_if(!enableModule('blog'), 404);
    }

    /**
     * Display a listing of the post list.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userCan('post.view')) {
            return abort(403);
        }

        $posts = Post::with('category')->latest()->get();
        return view('blog::index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('post.create')) {
            return abort(403);
        }

        $categories = PostCategory::all();

        if ($categories->count() < 1) {
            flashWarning("You don't have any post category. Please create category first.");
            return redirect()->route('module.postcategory.index');
        }

        return view('blog::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PostFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostFormRequest $request)
    {
        if (!userCan('post.create')) {
            return abort(403);
        }

        $post = CreatePost::create($request);

        if ($post) {
            flashSuccess('Post Created Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified post.
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (!userCan('post.update')) {
            return abort(403);
        }

        $categories = PostCategory::all();

        return view('blog::edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     * @param PostFormRequest $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, Post $post)
    {
        if (!userCan('post.update')) {
            return abort(403);
        }

        $post = UpdatePost::update($request, $post);

        if ($post) {
            flashSuccess('Post Updated Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified post from storage.
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        if (!userCan('post.delete')) {
            return abort(403);
        }

        $post = DeletePost::delete($post);

        if ($post) {
            flashSuccess('Post Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}

<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\PostCategory;
use Illuminate\Contracts\Support\Renderable;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        abort_if(!enableModule('blog'), 404);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($category_slug = null)
    {
        if ($category_slug) {
            if (!userCan('postcategory.update')) {
                return abort(403);
            }

            $cateogory = PostCategory::whereSlug($category_slug)->firstOrFail();
        }

        $categories = PostCategory::paginate(15);

        return view('blog::category.index', [
            'categories' => $categories,
            'edit_category' => $cateogory ?? null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (!userCan('postcategory.create')) {
            return abort(403);
        }

        $request->validate([
            'name' => 'required|unique:post_categories,name|max:255',
            'image' => 'required',
        ]);

        $category = PostCategory::create($request->except(['image']));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = $request->image->move('uploads/post/category', $request->image->hashName());
            $category->update(['image' => $url]);
        }

        flashSuccess('Category Created Successfully');
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, PostCategory $post_category)
    {
        if (!userCan('postcategory.update')) {
            return abort(403);
        }

        $post_category->update($request->except('image'));

        flashSuccess('Category Updated Successfully');
        return redirect()->route('module.postcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(PostCategory $post_category)
    {
        if (!userCan('postcategory.delete')) {
            return abort(403);
        }

        if ($post_category->image) {
            deleteImage($post_category->image);
        }

        $post_category->delete();

        flashSuccess('Category Deleted Successfully');
        return back();
    }
}

<?php

namespace Modules\Category\Repositories;

use Modules\Category\Actions\CreateCategory;
use Modules\Category\Actions\DeleteCategory;
use Modules\Category\Actions\UpdateCategory;
use Modules\Category\Entities\Category;

class CategoryRepositories implements CategoryInterface
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function all()
    {
        return Category::latest('id')->get();
    }
    /**
     * Store a newly created resource in storage.
     * @param CategoryFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        return CreateCategory::create($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(object $data)
    {
        return DeleteCategory::delete($data);
    }
}

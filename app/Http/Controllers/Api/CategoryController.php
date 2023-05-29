<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Transformers\CategoryResource;
use Modules\Category\Transformers\SubCategoryResource;

class CategoryController extends Controller
{
    public function categories(Request $request)
    {

        $discription = [
            "text",
            "select",
            "radio",
            "number",
            "date",
            "checkbox_multiple",
        ];

        $category = Category::with(['customFields' => function ($q) {
            return $q->with('values');
        }])->where('slug', $request->slug)->first();
        return sendResponse(200, "All Category", $category, true, $discription);
    }

    public function categoriesSubcategories(Category $category)
    {
        $subcategory = $category->subcategories()->get();

        return SubCategoryResource::collection($subcategory);
    }
}
